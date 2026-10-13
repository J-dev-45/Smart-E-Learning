<?php

namespace App\Http\Controllers;

use App\Models\Choices;
use App\Models\Modules;
use App\Models\Questions;
use App\Models\RecentActivity;
use App\Models\TestCase;
use App\Models\Topics;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Question extends Controller
{
    // ADD QUESTION
    public function addQuestion(Request $request)
    {
        $input = $request->validate([
            'question' => 'required|string|max:6000',
            'explanation' => 'exclude_if:question_type,coding|nullable|string|max:6000',
            'question_type' => 'required|string|in:multipleChoice,TorF,identification,coding',

            'module_id' => 'required|uuid|exists:modules,id',
            'topic_id' => 'required|uuid|exists:topics,id',

            'choice_A' => 'required_if:question_type,multipleChoice|nullable|string|max:2000',
            'choice_B' => 'required_if:question_type,multipleChoice|nullable|string|max:2000',
            'choice_C' => 'required_if:question_type,multipleChoice|nullable|string|max:2000',
            'choice_D' => 'required_if:question_type,multipleChoice|nullable|string|max:2000',

            'correct_choice' => 'exclude_unless:question_type,multipleChoice|required|string|in:A,B,C,D',
            'correct_answer' => 'exclude_if:question_type,coding|nullable|string|max:6000',

            // Only validate test cases for coding questions
            'test_cases' => 'exclude_unless:question_type,coding|required|array|min:1',
            'test_cases.*.scanner_input' => 'nullable|string|max:6000',
            'test_cases.*.expected_output' => 'required|string|max:6000',
            'test_cases.*.test_case_order' => 'required|integer|min:1',
            'test_cases.*.is_hidden' => 'boolean',
        ]);

        $topicBelongsToModule = Topics::where('id', $input['topic_id'])
            ->where('module_id', $input['module_id'])
            ->exists();

        if (!$topicBelongsToModule) {
            return response()->json([
                'success' => false,
                'message' => 'The selected topic does not belong to the selected module.',
            ], 422);
        }

        try {
            $question = DB::transaction(function () use ($input) {
                $questionType = $input['question_type'];

                if ($questionType === 'multipleChoice') {
                    $correctAnswer = match ($input['correct_choice']) {
                        'A' => $input['choice_A'],
                        'B' => $input['choice_B'],
                        'C' => $input['choice_C'],
                        'D' => $input['choice_D'],
                    };

                    $question = Questions::create([
                        'module_id' => $input['module_id'],
                        'topic_id' => $input['topic_id'],
                        'question' => $input['question'],
                        'question_type' => $questionType,
                        'answer' => $correctAnswer,
                        'explanation' => $input['explanation'] ?? null,
                        'points' => 3,
                    ]);

                    Choices::create([
                        'question_id' => $question->id,
                        'choice_A' => $input['choice_A'],
                        'choice_B' => $input['choice_B'],
                        'choice_C' => $input['choice_C'],
                        'choice_D' => $input['choice_D'],
                    ]);

                    Modules::where('id', $input['module_id'])
                        ->update([
                            'has_question_type' => true,
                        ]);
                } elseif ($questionType === 'TorF') {
                    $question = Questions::create([
                        'module_id' => $input['module_id'],
                        'topic_id' => $input['topic_id'],
                        'question' => $input['question'],
                        'question_type' => $questionType,
                        'answer' => $input['correct_answer'],
                        'explanation' => $input['explanation'] ?? null,
                        'points' => 3,
                    ]);

                    Modules::where('id', $input['module_id'])
                        ->update([
                            'has_question_type' => true,
                        ]);
                } elseif ($questionType === 'identification') {
                    $question = Questions::create([
                        'module_id' => $input['module_id'],
                        'topic_id' => $input['topic_id'],
                        'question' => $input['question'],
                        'question_type' => $questionType,
                        'answer' => $input['correct_answer'],
                        'explanation' => $input['explanation'] ?? null,
                        'points' => 5,
                    ]);

                    Modules::where('id', $input['module_id'])
                        ->update([
                            'has_question_type' => true,
                        ]);
                } else {
                    $question = Questions::create([
                        'module_id' => $input['module_id'],
                        'topic_id' => $input['topic_id'],
                        'question' => $input['question'],
                        'question_type' => $questionType,
                        'answer' => null,
                        'explanation' => null,
                        'points' => 10,
                    ]);

                    foreach ($input['test_cases'] as $testCase) {
                        TestCase::create([
                            'question_id' => $question->id,
                            'scanner_input' => $testCase['scanner_input'] ?? null,
                            'expected_output' => $testCase['expected_output'],
                            'test_case_order' => $testCase['test_case_order'],
                            'is_hidden' => $testCase['is_hidden'] ?? false,
                        ]);
                    }

                    Modules::where('id', $input['module_id'])
                        ->update([
                            'has_coding' => true,
                        ]);
                }

                return $question;
            });

            $question = $question->fresh();

            RecentActivity::create([
                'name' => auth()->user()->name,
                'action' => 'added_question',
                'subject' => $request->subject_name,
                'module' => $request->module_name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Question added successfully!',
                'new_questions' => [$question],
            ]);
        } catch (\Throwable $e) {
            \Log::error('ADD QUESTION ERROR', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to add question.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // EDIT QUESTION
    public function editQuestion(Request $request)
    {
        $question = Questions::find($request->question_id);

        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Question not found.',
            ], 404);
        }

        if ($request->question_type === 'multipleChoice') {
            $data = $request->validate([
                'question' => 'required|string|max:2000',
                'choice_A' => 'required|string|max:2000',
                'choice_B' => 'required|string|max:2000',
                'choice_C' => 'required|string|max:2000',
                'choice_D' => 'required|string|max:2000',
                'correct_choice' => 'required|in:A,B,C,D',
                'answer' => 'required|string|max:2000',
            ]);

            $question->update([
                'question' => $data['question'],
                'answer' => $data['answer'],
                'updated_at' => Carbon::now(),
            ]);

            Choices::where('question_id', $question->id)->update([
                'choice_A' => $data['choice_A'],
                'choice_B' => $data['choice_B'],
                'choice_C' => $data['choice_C'],
                'choice_D' => $data['choice_D'],
                'updated_at' => Carbon::now(),
            ]);
        }

        if ($request->question_type === 'TorF') {
            $data = $request->validate([
                'question' => 'required|string|max:2000',
                'answer' => 'required|in:True,False',
            ]);

            $question->update([
                'question' => $data['question'],
                'answer' => $data['answer'],
                'updated_at' => Carbon::now(),
            ]);
        }

        if ($request->question_type === 'identification') {
            $data = $request->validate([
                'question' => 'required|string|max:2000',
                'answer' => 'required|string|max:2000',
            ]);

            $question->update([
                'question' => $data['question'],
                'answer' => $data['answer'],
                'updated_at' => Carbon::now(),
            ]);
        }

        RecentActivity::create([
            'name' => auth()->user()->name,
            'action' => 'edited_question',
            'subject' => $request->subject_name,
            'module' => $request->module_name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Question updated successfully',
        ]);
    }

    // DELETE QUESTION
    public function deleteQuestion(Request $request)
    {
        $data = $request->validate([
            'question_id' => 'required|uuid',
        ]);

        $question = Questions::find($data['question_id']);

        if (!$question) {
            return response()->json([
                'message' => 'Question not found',
            ], 404);
        }

        $moduleId = $question->module_id;
        $questionType = $question->question_type;

        RecentActivity::create([
            'name' => auth()->user()->name,
            'action' => 'deleted_question',
            'subject' => $request->subject_name,
            'module' => $request->module_name,
        ]);

        $question->delete();

        if ($questionType === 'coding') {
            $hasCoding = Questions::where('module_id', $moduleId)
                ->where('question_type', 'coding')
                ->exists();

            Modules::where('id', $moduleId)
                ->update([
                    'has_coding' => $hasCoding,
                ]);
        } else {
            $hasQuestionType = Questions::where('module_id', $moduleId)
                ->whereIn('question_type', [
                    'multipleChoice',
                    'identification',
                    'TorF',
                ])
                ->exists();

            Modules::where('id', $moduleId)
                ->update([
                    'has_question_type' => $hasQuestionType,
                ]);
        }

        $questions = Questions::where('module_id', $moduleId)
            ->select(
                'id',
                'module_id',
                'topic_id',
                'question',
                'question_type',
                'answer'
            )
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Question Deleted Successfully!',
            'questions' => $questions,
        ]);
    }
}