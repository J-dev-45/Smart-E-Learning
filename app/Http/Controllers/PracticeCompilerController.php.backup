<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PracticeCompilerController extends Controller
{
    public function run(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:10000'],
            'input' => ['nullable', 'string', 'max:6000'],
        ]);

        $id = 'practice_java_' . bin2hex(random_bytes(16));

        $workDir = storage_path("app/compiler/$id");

        File::makeDirectory(
            $workDir,
            0755,
            true
        );

        File::put(
            "$workDir/input.txt",
            $request->input('input') ?? ''
        );

        $compilerRequest =
            $id .
            "\n---JOB---\n" .
            $request->input('code');

        File::put(
            "$workDir/compiler_request.txt",
            $compilerRequest
        );

        $projectPath = str_replace(
            '\\',
            '/',
            base_path()
        );

        $workDirUnix = str_replace(
            '\\',
            '/',
            $workDir
        );

        $relativeWorkDir = str_replace(
            $projectPath . '/',
            '',
            $workDirUnix
        );

        $containerWorkDir =
            "/app/$relativeWorkDir";

        $requestFile =
            $containerWorkDir .
            '/compiler_request.txt';

        /*
        |--------------------------------------------------------------------------
        | Compile Java Code
        |--------------------------------------------------------------------------
        */

        $compileCommand =
            'docker exec smart-elearning-java ' .
            'wget -q -O - ' .
            '--post-file=' .
            escapeshellarg($requestFile) .
            ' http://127.0.0.1:8080/compile';

        $compileOutput = [];

        $compileExitCode = 0;

        $compileStart = microtime(true);

        exec(
            $compileCommand . ' 2>&1',
            $compileOutput,
            $compileExitCode
        );

        $compileTime =
            microtime(true) -
            $compileStart;

        $compileResult =
            implode("\n", $compileOutput);

        Log::info(
            'Compiler service timing',
            [
                'compile_time' =>
                    round($compileTime, 3),
                'compile_exit_code' =>
                    $compileExitCode,
                'job' => $id,
            ]
        );

        if (
            $compileExitCode !== 0 ||
            !str_starts_with(
                $compileResult,
                'COMPILED'
            )
        ) {
            File::deleteDirectory(
                $workDir
            );

            return response()->json([
                'success' => false,
                'output' =>
                    str_replace(
                        'COMPILE_ERROR',
                        '',
                        $compileResult
                    ) ?: 'Compilation failed.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Execute Compiled Java Code
        |--------------------------------------------------------------------------
        |
        | Student code is executed in a separate temporary Docker container.
        | Network access is disabled and CPU/memory/time limits are enforced.
        |
        */

        $dockerWorkDir = str_replace(
            '\\',
            '/',
            $workDir
        );

        $runCommand =
            'docker run --rm ' .
            '--network none ' .
            '--memory 256m ' .
            '--cpus 0.5 ' .
            '-v ' .
            escapeshellarg(
                $dockerWorkDir . ':/app'
            ) .
            ' -w /app ' .
            'smart-elearning-java:21 ' .
            'sh -c ' .
            escapeshellarg(
                'timeout 5 java Main < input.txt'
            );

        $output = [];

        $exitCode = 0;

        $runStart = microtime(true);

        exec(
            $runCommand . ' 2>&1',
            $output,
            $exitCode
        );

        $runTime =
            microtime(true) -
            $runStart;

        Log::info(
            'Compiler execution timing',
            [
                'run_time' =>
                    round($runTime, 3),
                'run_exit_code' =>
                    $exitCode,
                'job' => $id,
            ]
        );

        $actualOutput =
            implode("\n", $output);

        /*
        |--------------------------------------------------------------------------
        | Restore Input Values In Output
        |--------------------------------------------------------------------------
        */

        $inputLines = preg_split(
            '/\r\n|\r|\n/',
            trim(
                $request->input('input') ?? ''
            )
        );

        $inputIndex = 0;

        $actualOutput =
            preg_replace_callback(
                '/([^:\n]+:\s*)/',
                function ($match)
                    use (
                        &$inputLines,
                        &$inputIndex
                    ) {
                        if (
                            $inputIndex <
                            count($inputLines)
                        ) {
                            $value =
                                $inputLines[
                                    $inputIndex++
                                ];

                            return
                                rtrim(
                                    $match[1]
                                ) .
                                ' ' .
                                $value .
                                "\n";
                        }

                        return $match[1];
                    },
                $actualOutput
            );

        $actualOutput =
            preg_replace(
                "/\n+/",
                "\n",
                trim($actualOutput)
            );

        /*
        |--------------------------------------------------------------------------
        | Cleanup
        |--------------------------------------------------------------------------
        */

        File::deleteDirectory(
            $workDir
        );

        /*
        |--------------------------------------------------------------------------
        | Runtime Error
        |--------------------------------------------------------------------------
        */

        if ($exitCode !== 0) {
            return response()->json([
                'success' => false,
                'output' =>
                    $actualOutput
                    ?: 'Runtime error.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,
            'output' =>
                $actualOutput,
        ]);
    }
}