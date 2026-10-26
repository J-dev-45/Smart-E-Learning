<?php

namespace App\Http\Controllers;

use App\Models\PretestSavedCodes;
use App\Models\Questions;
use App\Models\TemporaryPoints;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class CompilerController extends Controller
{
    public function index()
    {
        return view('compiler');
    }

    public function runPretest(Request $request)
    {
        $request->validate([
            'question_id' => ['required', 'uuid'],
            'code' => ['required', 'string', 'max:10000'],
        ]);

        $code = $request->input('code');

        session([
            'pretest_coding_run' => [
                'question_id' => $request->question_id,
                'code_hash' => hash('sha256', $code),
            ],
        ]);

        $question = Questions::with('testCases')
            ->findOrFail($request->question_id);

        if ($question->question_type !== 'coding') {
            return response()->json([
                'success' => false,
                'output' => 'This question is not a coding question.',
            ], 422);
        }

        if ($question->testCases->isEmpty()) {
            return response()->json([
                'success' => false,
                'output' => 'No test cases have been configured for this question.',
            ], 422);
        }

        $results = [];
        $allPassed = true;


        $id = 'pretest_java_' . bin2hex(random_bytes(16));

        $workDir = storage_path("app/compiler/$id");

        File::makeDirectory(
            $workDir,
            0755,
            true
        );


        $validTestCases = [];

        foreach ($question->testCases as $testCase) {
            $scannerInput = trim(
                $testCase->scanner_input ?? ''
            );

            $scannerRequired = $scannerInput !== '';

            if (
                $scannerRequired &&
                !preg_match(
                    '/(?:new\s+(?:java\.util\.)?Scanner\s*\(|(?:java\.util\.)?Scanner\s+\w+)/',
                    $code
                )
            ) {
                $allPassed = false;

                $results[] = [
                    'test_case_id' => $testCase->id,
                    'test_case_order' => $testCase->test_case_order,
                    'passed' => false,
                    'output' => 'Scanner is required for this activity. Please use java.util.Scanner to receive the required input.',
                    'expected_output' => trim($testCase->expected_output),
                    'is_hidden' => $testCase->is_hidden,
                ];

                continue;
            }

            $validTestCases[] = [
                'testCase' => $testCase,
                'scannerInput' => $scannerInput,
                'scannerRequired' => $scannerRequired,
            ];
        }


        if (!empty($validTestCases)) {
            $compilerRequest =
                $id .
                "\n---JOB---\n" .
                $code;

            $requestFile =
                $workDir . '/compiler_request.txt';

            File::put(
                $requestFile,
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
                "/app/" . $relativeWorkDir;

            $containerRequestFile =
                $containerWorkDir .
                '/compiler_request.txt';

            $compileCommand =
                'docker exec smart-elearning-java ' .
                'wget -q -O - ' .
                '--post-file=' .
                escapeshellarg($containerRequestFile) .
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
                'Pretest compiler timing',
                [
                    'question_id' =>
                        $question->id,

                    'compile_time' =>
                        round($compileTime, 3),

                    'compile_exit_code' =>
                        $compileExitCode,

                    'job' =>
                        $id,

                    'test_cases' =>
                        count($validTestCases),
                ]
            );


            if (
                $compileExitCode !== 0 ||
                !str_starts_with(
                    trim($compileResult),
                    'COMPILED'
                )
            ) {
                $allPassed = false;

                $compileError =
                    str_replace(
                        'COMPILE_ERROR',
                        '',
                        $compileResult
                    );

                foreach ($validTestCases as $item) {
                    $testCase = $item['testCase'];

                    $results[] = [
                        'test_case_id' =>
                            $testCase->id,

                        'test_case_order' =>
                            $testCase->test_case_order,

                        'passed' =>
                            false,

                        'output' =>
                            trim($compileError)
                            ?: 'Compilation failed.',

                        'expected_output' =>
                            trim(
                                $testCase->expected_output
                            ),

                        'is_hidden' =>
                            $testCase->is_hidden,
                    ];
                }

                File::deleteDirectory(
                    $workDir
                );


                $passedTestCases =
                    collect($results)
                        ->where('passed', true)
                        ->count();

                $totalTestCases =
                    count($results);

                $partialPoints =
                    $totalTestCases > 0
                        ? floor(
                            ($passedTestCases /
                                $totalTestCases)
                            * $question->points
                        )
                        : 0;

                $temporaryPoints =
                    TemporaryPoints::firstOrNew([
                        'user_id' =>
                            auth()->id(),
                    ]);

                $currentPoints =
                    (int) (
                        $temporaryPoints->points ?? 0
                    );

                $codingRuns =
                    session(
                        'pretest_coding_points',
                        []
                    );

                $previousPoints =
                    (int) (
                        $codingRuns[
                            $question->id
                        ] ?? 0
                    );

                $temporaryPoints->points =
                    max(
                        0,
                        $currentPoints
                        - $previousPoints
                        + $partialPoints
                    );

                $temporaryPoints->save();

                $codingRuns[
                    $question->id
                ] = $partialPoints;

                session([
                    'pretest_coding_points' =>
                        $codingRuns,
                ]);

                return response()->json([
                    'success' =>
                        $allPassed,

                    'results' =>
                        $results,

                    'passed_test_cases' =>
                        $passedTestCases,

                    'total_test_cases' =>
                        $totalTestCases,

                    'partial_points' =>
                        $partialPoints,
                ]);
            }


            if (
                !File::exists(
                    $workDir . '/Main.class'
                )
            ) {
                $allPassed = false;

                foreach ($validTestCases as $item) {
                    $testCase = $item['testCase'];

                    $results[] = [
                        'test_case_id' =>
                            $testCase->id,

                        'test_case_order' =>
                            $testCase->test_case_order,

                        'passed' =>
                            false,

                        'output' =>
                            'Compilation completed, but the compiled Java class was not found.',

                        'expected_output' =>
                            trim(
                                $testCase->expected_output
                            ),

                        'is_hidden' =>
                            $testCase->is_hidden,
                    ];
                }

                File::deleteDirectory(
                    $workDir
                );


                $passedTestCases =
                    collect($results)
                        ->where('passed', true)
                        ->count();

                $totalTestCases =
                    count($results);

                $partialPoints =
                    $totalTestCases > 0
                        ? floor(
                            ($passedTestCases /
                                $totalTestCases)
                            * $question->points
                        )
                        : 0;

                $temporaryPoints =
                    TemporaryPoints::firstOrNew([
                        'user_id' =>
                            auth()->id(),
                    ]);

                $currentPoints =
                    (int) (
                        $temporaryPoints->points ?? 0
                    );

                $codingRuns =
                    session(
                        'pretest_coding_points',
                        []
                    );

                $previousPoints =
                    (int) (
                        $codingRuns[
                            $question->id
                        ] ?? 0
                    );

                $temporaryPoints->points =
                    max(
                        0,
                        $currentPoints
                        - $previousPoints
                        + $partialPoints
                    );

                $temporaryPoints->save();

                $codingRuns[
                    $question->id
                ] = $partialPoints;

                session([
                    'pretest_coding_points' =>
                        $codingRuns,
                ]);

                return response()->json([
                    'success' =>
                        $allPassed,

                    'results' =>
                        $results,

                    'passed_test_cases' =>
                        $passedTestCases,

                    'total_test_cases' =>
                        $totalTestCases,

                    'partial_points' =>
                        $partialPoints,
                ]);
            }


            foreach ($validTestCases as $item) {
                $testCase =
                    $item['testCase'];

                $scannerInput =
                    $item['scannerInput'];

                $scannerRequired =
                    $item['scannerRequired'];


                if ($scannerRequired) {
                    File::put(
                        $workDir . '/input.txt',
                        $scannerInput
                    );
                }



                $dockerWorkDir =
                    str_replace(
                        '\\',
                        '/',
                        $workDir
                    );

                $runJavaCommand =
                    $scannerRequired
                        ? 'timeout 5 java Main < input.txt'
                        : 'timeout 5 java Main';

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
                        $runJavaCommand
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

                $actualOutput =
                    implode("\n", $output);

                Log::info(
                    'Pretest compiler execution timing',
                    [
                        'question_id' =>
                            $question->id,

                        'test_case_id' =>
                            $testCase->id,

                        'run_time' =>
                            round($runTime, 3),

                        'run_exit_code' =>
                            $exitCode,

                        'job' =>
                            $id,
                    ]
                );


                if ($scannerRequired) {
                    $inputLines =
                        preg_split(
                            '/\r\n|\r|\n/',
                            trim($scannerInput)
                        );

                    $inputIndex = 0;

                    if (!empty($inputLines)) {
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
                    }
                }


                $actualOutput =
                    preg_replace(
                        "/\n+/",
                        "\n",
                        trim($actualOutput)
                    );


                if ($exitCode !== 0) {
                    $allPassed = false;

                    $results[] = [
                        'test_case_id' =>
                            $testCase->id,

                        'test_case_order' =>
                            $testCase->test_case_order,

                        'passed' =>
                            false,

                        'output' =>
                            $actualOutput
                            ?: 'Runtime error.',

                        'expected_output' =>
                            trim(
                                $testCase->expected_output
                            ),

                        'is_hidden' =>
                            $testCase->is_hidden,
                    ];

                    continue;
                }


                $expectedOutput =
                    trim(
                        $testCase->expected_output
                    );

                $comparisonExpected =
                    $expectedOutput;

                $comparisonActual =
                    $actualOutput;

                if ($scannerRequired) {
                    $expectedLines =
                        preg_split(
                            '/\r\n|\r|\n/',
                            $comparisonExpected
                        );

                    $actualLines =
                        preg_split(
                            '/\r\n|\r|\n/',
                            $comparisonActual
                        );

                    $inputLines =
                        preg_split(
                            '/\r\n|\r|\n/',
                            $scannerInput
                        );


                    foreach (
                        $inputLines as $inputLine
                    ) {
                        $inputLine =
                            trim($inputLine);

                        if ($inputLine === '') {
                            continue;
                        }

                        foreach (
                            $expectedLines
                            as $index => $line
                        ) {
                            if (
                                preg_match(
                                    '/^(.*:\s*)' .
                                    preg_quote(
                                        $inputLine,
                                        '/'
                                    ) .
                                    '\s*$/',
                                    $line,
                                    $matches
                                )
                            ) {
                                $expectedLines[$index] =
                                    rtrim(
                                        $matches[1]
                                    );

                                break;
                            }
                        }
                    }


                    foreach (
                        $inputLines as $inputLine
                    ) {
                        $inputLine =
                            trim($inputLine);

                        if ($inputLine === '') {
                            continue;
                        }

                        foreach (
                            $actualLines
                            as $index => $line
                        ) {
                            if (
                                preg_match(
                                    '/^(.*:\s*)' .
                                    preg_quote(
                                        $inputLine,
                                        '/'
                                    ) .
                                    '\s*$/',
                                    $line,
                                    $matches
                                )
                            ) {
                                $actualLines[$index] =
                                    rtrim(
                                        $matches[1]
                                    );

                                break;
                            }
                        }
                    }

                    $comparisonExpected =
                        implode(
                            "\n",
                            $expectedLines
                        );

                    $comparisonActual =
                        implode(
                            "\n",
                            $actualLines
                        );
                }

                $comparisonExpected =
                    preg_replace(
                        '/\s+/',
                        ' ',
                        trim($comparisonExpected)
                    );

                $comparisonActual =
                    preg_replace(
                        '/\s+/',
                        ' ',
                        trim($comparisonActual)
                    );


                $passed =
                    $comparisonActual ===
                    $comparisonExpected;

                if (!$passed) {
                    $allPassed = false;
                }

                $results[] = [
                    'test_case_id' =>
                        $testCase->id,

                    'test_case_order' =>
                        $testCase->test_case_order,

                    'passed' =>
                        $passed,

                    'output' =>
                        $passed
                            ? $expectedOutput
                            : $actualOutput,

                    'expected_output' =>
                        $expectedOutput,

                    'is_hidden' =>
                        $testCase->is_hidden,
                ];
            }
        }

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
        | Calculate Points
        |--------------------------------------------------------------------------
        */

        $passedTestCases =
            collect($results)
                ->where('passed', true)
                ->count();

        $totalTestCases =
            count($results);

        $partialPoints =
            $totalTestCases > 0
                ? floor(
                    ($passedTestCases /
                        $totalTestCases)
                    * $question->points
                )
                : 0;

        /*
        |--------------------------------------------------------------------------
        | Temporary Points
        |--------------------------------------------------------------------------
        */

        $temporaryPoints =
            TemporaryPoints::firstOrNew([
                'user_id' =>
                    auth()->id(),
            ]);

        $currentPoints =
            (int) (
                $temporaryPoints->points ?? 0
            );

        $codingRuns =
            session(
                'pretest_coding_points',
                []
            );

        $previousPoints =
            (int) (
                $codingRuns[
                    $question->id
                ] ?? 0
            );

        $temporaryPoints->points =
            max(
                0,
                $currentPoints
                - $previousPoints
                + $partialPoints
            );

        $temporaryPoints->save();

        $codingRuns[
            $question->id
        ] = $partialPoints;

        session([
            'pretest_coding_points' =>
                $codingRuns,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Return Results
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' =>
                $allPassed,

            'results' =>
                $results,

            'passed_test_cases' =>
                $passedTestCases,

            'total_test_cases' =>
                $totalTestCases,

            'partial_points' =>
                $partialPoints,
        ]);
    }

    public function save(Request $request)
    {
        $input = $request->validate([
            'code' =>
                'required|string',
        ]);

        PretestSavedCodes::updateOrCreate(
            [
                'user_id' =>
                    auth()->id(),

                'question_id' =>
                    $request->question_id,
            ],
            [
                'code' =>
                    $input['code'],
            ]
        );

        return response()->json([
            'success' =>
                true,

            'message' =>
                'Code Saved Successfully!',
        ]);
    }
}