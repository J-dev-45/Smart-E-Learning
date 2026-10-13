<?php

namespace App\Http\Controllers;

use App\Models\Choices;
use App\Models\Modules;
use App\Models\Questions;
use App\Models\Topics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Smalot\PdfParser\Parser;
use ZipArchive;

class QuestionImport extends Controller
{
    // =============================================================================================================>>>>> EXTRACT QUESTIONS

    public function extractQuestions(Request $request)
    {
        $request->validate([
            'file' => 'required|file|extensions:docx,pdf|max:10240',
            'module_id' => 'required|uuid|exists:modules,id',
            'topic_id' => 'required|uuid|exists:topics,id',
        ]);

        $topicBelongsToModule = Topics::where('id', $request->topic_id)
            ->where('module_id', $request->module_id)
            ->exists();

        if (!$topicBelongsToModule) {
            return response()->json([
                'success' => false,
                'message' => 'The selected topic does not belong to the selected module.',
            ], 422);
        }

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());

        if ($extension === 'docx') {
            $text = $this->extractDocxText($file->getRealPath());
        } elseif ($extension === 'pdf') {
            $text = $this->extractPdfText($file->getRealPath());
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Only DOCX and PDF files are supported.',
            ], 422);
        }

        $parsed = $this->parseQuestions($text);

        if (!empty($parsed['errors'])) {
            return response()->json([
                'success' => false,
                'message' => 'Some questions contain errors.',
                'questions' => $parsed['questions'],
                'errors' => $parsed['errors'],
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Questions extracted successfully.',
            'questions' => $parsed['questions'],
        ]);
    }

    // =============================================================================================================>>>>> IMPORT QUESTIONS

    public function importQuestions(Request $request)
    {
        $request->validate([
            'module_id' => 'required|uuid|exists:modules,id',
            'topic_id' => 'required|uuid|exists:topics,id',

            'questions' => 'required|array|min:1',

            'questions.*.question' => 'required|string',
            'questions.*.question_type' => 'required|in:TorF,multipleChoice,identification',

            'questions.*.correct_choice' => 'nullable|string',
            'questions.*.correct_answer' => 'nullable|string',
            'questions.*.explanation' => 'required|string',

            'questions.*.choices' => 'nullable|array',
            'questions.*.choices.A' => 'nullable|string',
            'questions.*.choices.B' => 'nullable|string',
            'questions.*.choices.C' => 'nullable|string',
            'questions.*.choices.D' => 'nullable|string',
        ]);

        $moduleId = $request->module_id;
        $topicId = $request->topic_id;
        $questions = $request->questions;
        $errors = [];

        $topicBelongsToModule = Topics::where('id', $topicId)
            ->where('module_id', $moduleId)
            ->exists();

        if (!$topicBelongsToModule) {
            return response()->json([
                'success' => false,
                'message' => 'The selected topic does not belong to the selected module.',
            ], 422);
        }

        foreach ($questions as $index => $question) {
            $number = $index + 1;
            $type = $question['question_type'];

            if (trim($question['question'] ?? '') === '') {
                $errors[] = "QUESTION {$number}: Question text is required.";
            }

            if (trim($question['explanation'] ?? '') === '') {
                $errors[] = "QUESTION {$number}: Explanation is required.";
            }

            if ($type === 'multipleChoice') {
                $choices = $question['choices'] ?? [];

                foreach (['A', 'B', 'C', 'D'] as $letter) {
                    if (trim($choices[$letter] ?? '') === '') {
                        $errors[] = "QUESTION {$number}: Choice {$letter} is required.";
                    }
                }

                $correctChoice = strtoupper(
                    trim($question['correct_choice'] ?? $question['answer'] ?? '')
                );

                if (!in_array($correctChoice, ['A', 'B', 'C', 'D'], true)) {
                    $errors[] = "QUESTION {$number}: Answer must be A, B, C, or D.";
                }
            }

            if ($type === 'TorF') {
                $answer = strtolower(
                    trim($question['correct_answer'] ?? $question['answer'] ?? '')
                );

                if (!in_array($answer, ['true', 'false'], true)) {
                    $errors[] = "QUESTION {$number}: Answer must be True or False.";
                }
            }

            if ($type === 'identification') {
                if (trim($question['correct_answer'] ?? $question['answer'] ?? '') === '') {
                    $errors[] = "QUESTION {$number}: Answer is required.";
                }
            }
        }

        if (!empty($errors)) {
            return response()->json([
                'success' => false,
                'message' => 'Some questions contain errors.',
                'errors' => $errors,
            ], 422);
        }

        try {
            $newQuestions = [];

            DB::transaction(function () use (
                $questions,
                $moduleId,
                $topicId,
                &$newQuestions
            ) {
                foreach ($questions as $question) {
                    $type = $question['question_type'];

                    if ($type === 'multipleChoice') {
                        $correctChoice = strtoupper(
                            trim($question['correct_choice'] ?? $question['answer'])
                        );

                        $answer = trim(
                            $question['choices'][$correctChoice]
                        );

                        $points = 3;

                    } elseif ($type === 'TorF') {
                        $answer = ucfirst(
                            strtolower(
                                trim(
                                    $question['correct_answer']
                                    ?? $question['answer']
                                )
                            )
                        );

                        $points = 3;

                    } else {
                        $answer = trim(
                            $question['correct_answer']
                            ?? $question['answer']
                        );

                        $points = 5;
                    }

                    $newQuestion = Questions::create([
                        'module_id' => $moduleId,
                        'topic_id' => $topicId,
                        'question' => trim($question['question']),
                        'question_type' => $type,
                        'answer' => $answer,
                        'explanation' => trim($question['explanation']),
                        'points' => $points,
                    ]);

                    if ($type === 'multipleChoice') {
                        Choices::create([
                            'question_id' => $newQuestion->id,
                            'choice_A' => trim($question['choices']['A']),
                            'choice_B' => trim($question['choices']['B']),
                            'choice_C' => trim($question['choices']['C']),
                            'choice_D' => trim($question['choices']['D']),
                        ]);
                    }

                    $newQuestions[] = $newQuestion->fresh();
                }

                Modules::where('id', $moduleId)
                    ->update([
                        'has_question_type' => true,
                    ]);
            });

            return response()->json([
                'success' => true,
                'message' => count($newQuestions) . ' questions imported successfully.',
                'count' => count($newQuestions),
                'new_questions' => $newQuestions,
            ]);

        } catch (\Throwable $e) {
            \Log::error('IMPORT QUESTIONS ERROR', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to import questions.',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);
        }
    }

    // =============================================================================================================>>>>> EXTRACT DOCX

    private function extractDocxText($path)
    {
        $zip = new ZipArchive();

        if ($zip->open($path) !== true) {
            return '';
        }

        $documentXml = $zip->getFromName('word/document.xml');
        $zip->close();

        if ($documentXml === false) {
            return '';
        }

        $dom = new \DOMDocument();

        if (!@$dom->loadXML($documentXml)) {
            return '';
        }

        $xpath = new \DOMXPath($dom);

        $xpath->registerNamespace(
            'w',
            'http://schemas.openxmlformats.org/wordprocessingml/2006/main'
        );

        $paragraphs = $xpath->query('//w:body/w:p');
        $text = [];

        foreach ($paragraphs as $paragraph) {
            $parts = [];

            $nodes = $xpath->query(
                './/w:t | .//w:tab | .//w:br',
                $paragraph
            );

            foreach ($nodes as $node) {
                if ($node->localName === 't') {
                    $parts[] = $node->nodeValue;
                } elseif ($node->localName === 'tab') {
                    $parts[] = "\t";
                } elseif ($node->localName === 'br') {
                    $parts[] = "\n";
                }
            }

            $line = trim(implode('', $parts));

            if ($line !== '') {
                $text[] = $line;
            }
        }

        return implode("\n", $text);
    }

    // =============================================================================================================>>>>> EXTRACT PDF

    private function extractPdfText($path)
    {
        $parser = new Parser();
        $pdf = $parser->parseFile($path);

        $text = $pdf->getText();

        $text = str_replace(
            ['Æ', 'Ç'],
            ['∅', '∩'],
            $text
        );

        return trim($text);
    }

    // =============================================================================================================>>>>> PARSE QUESTIONS

    private function parseQuestions($text)
    {
        $text = str_replace(
            ["\r\n", "\r"],
            "\n",
            $text
        );

        $text = str_replace(
            "\xc2\xa0",
            ' ',
            $text
        );

        $lines = preg_split('/\n/', $text);

        $questions = [];
        $errors = [];
        $current = null;
        $activeSection = null;

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === '') {
                continue;
            }

            if (
                preg_match(
                    '/^(\d+)\.\s*(Multiple Choice|True or False|Identification)\s*$/i',
                    $line,
                    $matches
                )
            ) {
                $typeRaw = strtolower($matches[2]);

                if ($current !== null) {
                    $this->validateQuestion($current, $errors);
                    $questions[] = $current;
                }

                $mappedType = 'identification';

                if ($typeRaw === 'multiple choice') {
                    $mappedType = 'multipleChoice';
                } elseif ($typeRaw === 'true or false') {
                    $mappedType = 'TorF';
                }

                $current = [
                    'number' => count($questions) + 1,
                    'question' => '',
                    'question_type' => $mappedType,
                    'choices' => [
                        'A' => null,
                        'B' => null,
                        'C' => null,
                        'D' => null,
                    ],
                    'answer' => '',
                    'explanation' => '',
                ];

                $activeSection = null;

                continue;
            }

            if ($current === null) {
                continue;
            }

            if (
                preg_match(
                    '/^Question:\s*(.*)$/i',
                    $line,
                    $matches
                )
            ) {
                $current['question'] = trim($matches[1]);
                $activeSection = 'question';

                continue;
            }

            if (
                preg_match(
                    '/^([A-D])\.\s*(.*)$/i',
                    $line,
                    $matches
                )
            ) {
                if ($current['question_type'] !== 'multipleChoice') {
                    $errors[] =
                        "QUESTION {$current['number']}: Choice found for a non-multiple-choice question.";

                    continue;
                }

                $letter = strtoupper($matches[1]);

                $current['choices'][$letter] =
                    trim($matches[2]);

                $activeSection = 'choice_' . $letter;

                continue;
            }

            if (
                preg_match(
                    '/^(?:Correct\s+)?Answer:\s*(.*)$/i',
                    $line,
                    $matches
                )
            ) {
                $current['answer'] = trim($matches[1]);
                $activeSection = 'answer';

                continue;
            }

            if (
                preg_match(
                    '/^Explanation:\s*(.*)$/i',
                    $line,
                    $matches
                )
            ) {
                $current['explanation'] =
                    trim($matches[1]);

                $activeSection = 'explanation';

                continue;
            }

            if ($activeSection === 'question') {
                $current['question'] .=
                    ($current['question'] !== '' ? ' ' : '') . $line;

            } elseif ($activeSection === 'explanation') {
                $current['explanation'] .=
                    ($current['explanation'] !== '' ? ' ' : '') . $line;

            } elseif (
                str_starts_with(
                    $activeSection ?? '',
                    'choice_'
                )
            ) {
                $letter = substr(
                    $activeSection,
                    7
                );

                $current['choices'][$letter] .=
                    ($current['choices'][$letter] !== '' ? ' ' : '') . $line;
            }
        }

        if ($current !== null) {
            $this->validateQuestion($current, $errors);
            $questions[] = $current;
        }

        return [
            'questions' => $questions,
            'errors' => $errors,
        ];
    }

    // =============================================================================================================>>>>> VALIDATE QUESTION

    private function validateQuestion(&$question, &$errors)
    {
        $number = $question['number'];

        $question['question'] =
            trim($question['question']);

        $question['answer'] =
            trim($question['answer']);

        $question['explanation'] =
            trim($question['explanation']);

        if ($question['question'] === '') {
            $errors[] =
                "QUESTION {$number}: Question text is required.";
        }

        if ($question['question_type'] === '') {
            $errors[] =
                "QUESTION {$number}: TYPE is required.";
        }

        if ($question['question_type'] === 'multipleChoice') {
            foreach (['A', 'B', 'C', 'D'] as $letter) {
                if (
                    trim(
                        $question['choices'][$letter] ?? ''
                    ) === ''
                ) {
                    $errors[] =
                        "QUESTION {$number}: Choice {$letter} is required.";
                }
            }

            if (
                preg_match(
                    '/^([A-D])(?:\.|\b)/i',
                    trim($question['answer']),
                    $matches
                )
            ) {
                $question['answer'] =
                    strtoupper($matches[1]);
            }

            $answer =
                strtoupper(
                    trim($question['answer'])
                );

            if (
                !in_array(
                    $answer,
                    ['A', 'B', 'C', 'D'],
                    true
                )
            ) {
                $errors[] =
                    "QUESTION {$number}: Answer must be A, B, C, or D.";
            } else {
                $question['answer'] = $answer;
            }
        }

        if ($question['question_type'] === 'TorF') {
            $answer =
                strtolower(
                    trim($question['answer'])
                );

            if ($answer === 'true') {
                $question['answer'] = 'True';
            } elseif ($answer === 'false') {
                $question['answer'] = 'False';
            } else {
                $errors[] =
                    "QUESTION {$number}: Answer must be True or False.";
            }
        }

        if ($question['question_type'] === 'identification') {
            if (
                trim($question['answer']) === ''
            ) {
                $errors[] =
                    "QUESTION {$number}: Answer is required.";
            }
        }

        if (
            trim($question['explanation']) === ''
        ) {
            $errors[] =
                "QUESTION {$number}: Explanation is required.";
        }
    }
}