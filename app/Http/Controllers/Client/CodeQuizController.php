<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\CodeRunnerController;
use App\Http\Controllers\Controller;
use App\Models\Questions;
use Illuminate\Http\Request;

class CodeQuizController extends Controller
{
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

        $cache = [];
        $exec = function (?string $stdin) use (&$cache, $code) {
            $stdin = $this->normalizeStdin($stdin);

            return $cache[$stdin] ??= $this->runCode($code, $stdin);
        };

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

    private function normalizeStdin(?string $input): string
    {
        $input = $input === null ? '' : str_replace("\r\n", "\n", $input);

        return ($input !== '' && !str_ends_with($input, "\n")) ? $input . "\n" : $input;
    }

    private function runCode(string $code, ?string $input): array
    {
        $input = $this->normalizeStdin($input);

        try {
            $runRequest = new Request([
                'compiler' => 'openjdk-25',
                'code'     => $code,
                'input'    => $input,
            ]);

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

    private function same(string $actual, string $expected): bool
    {
        $n = fn ($s) => trim(implode("\n", array_map('rtrim', explode("\n", str_replace("\r\n", "\n", $s)))));

        return $n($actual) === $n($expected);
    }
}
