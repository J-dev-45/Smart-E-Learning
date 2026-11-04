<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use Illuminate\Http\Request;

class CodeQuizController extends Controller
{
    // Data for the "Expected Output" panel (hidden test cases are not sent)
    public function show(Questions $question)
    {
        return [
            'id'    => $question->id,
            'tests' => $question->testCases()
                ->where('is_hidden', false)
                ->get(['id', 'scanner_input', 'expected_output']),
            'total' => $question->testCases()->count(),
        ];
    }

    /**
     * Strict check:
     *  1. Re-run the student's code with the lines they typed (shown as "Your output").
     *  2. Run the same code against EVERY saved test case on the server.
     *  The answer is only correct when all test cases pass, so code that just prints a
     *  fixed answer can no longer pass.
     */
    public function check(Request $request, Questions $question)
    {
        $data = $request->validate([
            'code'     => 'required|string|max:10000',
            'inputs'   => 'nullable|array|max:50',
            'inputs.*' => 'nullable|string|max:500',
        ]);

        $code  = $data['code'];
        $tests = $question->testCases;

        if ($tests->isEmpty()) {
            return [
                'status'  => 'ERROR',
                'correct' => false,
                'actual'  => 'This question has no test cases yet.',
                'results' => [],
                'passed'  => 0,
                'total'   => 0,
            ];
        }

        // Same code + same stdin = same output, so never run the same input twice
        $cache = [];
        $exec = function (?string $stdin) use (&$cache, $code) {
            $stdin = $this->normalizeStdin($stdin);

            return $cache[$stdin] ??= $this->runCode($code, $stdin);
        };

        // 1) The student's own run (their typed inputs)
        $inputs = array_values($data['inputs'] ?? []);
        $mine   = $exec($inputs ? implode("\n", $inputs) . "\n" : null);

        if ($mine['error']) {
            return [
                'status'  => 'ERROR',
                'correct' => false,
                'actual'  => $mine['error'],
                'results' => [],
                'passed'  => 0,
                'total'   => $tests->count(),
            ];
        }

        // 2) Every saved test case, run on the server
        $results = [];
        $passed  = 0;

        foreach ($tests as $i => $tc) {
            $run = $exec($tc->scanner_input);

            if ($run['error']) {
                $status = 'ERROR';
            } elseif ($this->same($run['output'], $tc->expected_output)) {
                $status = 'PASS';
                $passed++;
            } else {
                $status = 'FAIL';
            }

            $results[] = [
                'number' => $i + 1,
                'status' => $status,
                'hidden' => (bool) $tc->is_hidden,
                // hidden cases: never leak the input or the actual output
                'input'  => $tc->is_hidden ? null : $tc->scanner_input,
                'actual' => $tc->is_hidden ? null : ($run['error'] ?: $run['output']),
            ];
        }

        $total   = $tests->count();
        $correct = $passed === $total;

        return [
            'status'  => $correct ? 'CORRECT' : 'WRONG',
            'correct' => $correct,
            'actual'  => $mine['output'],
            'results' => $results,
            'passed'  => $passed,
            'total'   => $total,
        ];
    }

    // Make sure stdin ends with a newline so Scanner can read the last value
    private function normalizeStdin(?string $input): string
    {
        $input = $input === null ? '' : str_replace("\r\n", "\n", $input);

        return ($input !== '' && !str_ends_with($input, "\n")) ? $input . "\n" : $input;
    }

    // Runs the code through the same controller the playground's Run button uses
    private function runCode(string $code, ?string $input): array
    {
        $input = $this->normalizeStdin($input);

        try {
            $runRequest = new Request([
                'compiler' => 'openjdk-25',
                'code'     => $code,
                'input'    => $input,
            ]);

            // run() has a second parameter that Laravel normally injects on a real route call.
            // Calling it by hand with one argument fails, so let the container resolve the
            // extra parameter and pass our request as the first one, whatever it is named.
            $controller = app(CodeRunnerController::class);
            $firstParam = (new \ReflectionMethod($controller, 'run'))->getParameters()[0]->getName();

            $response = app()->call([$controller, 'run'], [$firstParam => $runRequest]);

            if (is_array($response)) {
                $data = $response;
            } elseif ($response instanceof \Illuminate\Http\JsonResponse) {
                $data = $response->getData(true);
            } else {
                $data = json_decode($response->getContent(), true) ?? [];
            }
        } catch (\Throwable $e) {
            report($e);

            // In local development, show the real reason so it can be fixed quickly
            $reason = app()->environment('local')
                ? 'Runner error: ' . class_basename($e) . ': ' . $e->getMessage()
                : 'Could not run the code. Please try again.';

            return ['output' => '', 'error' => $reason];
        }

        $output = (string) ($data['output'] ?? $data['stdout'] ?? '');
        $error  = trim((string) ($data['error'] ?? $data['stderr'] ?? ''));

        return [
            'output' => $output,
            'error'  => $error !== '' ? $error : null,
        ];
    }

    // Ignore line-ending and trailing-space differences
    private function same(string $actual, string $expected): bool
    {
        $n = fn ($s) => trim(implode("\n", array_map('rtrim', explode("\n", str_replace("\r\n", "\n", $s)))));

        return $n($actual) === $n($expected);
    }
}