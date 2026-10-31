<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AnsweredAssessmentQuestions;
use App\Models\Leaderboard;
use App\Models\ModuleQuiz;
use App\Models\Modules;
use App\Models\Questions;
use App\Models\Subjects;
use App\Models\TemporaryPoints;
use App\Models\UserScoreboard;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Pretest extends Controller
{
    public function submitAnswer(Request $request)
    {
        $request->validate([
            'question_id' => ['required', 'uuid'],
            'student_answer' => ['required', 'string'],
            'subject_id' => ['required', 'uuid'],
        ]);

        $type_of_assessment = $request->type_of_assessment;

        $question = Questions::find($request->question_id);

        // FIX: null check BEFORE touching $question->answer
        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Question not found.'
            ], 404);
        }

        $student_answer = strtolower(trim($request->student_answer));
        $correct_answer = strtolower(trim($question->answer));

        // FIX: compute correctness once, up front, for both quiz and exam
        $is_correct = $correct_answer === $student_answer;
        $correct = $is_correct ? 'yes' : 'no';

        // ===========================================================================================
        // QUIZ
        // ===========================================================================================

        if ($type_of_assessment === 'quiz') {

            $request->validate([
                'module_id' => ['required', 'uuid'],
            ]);

            $score = ModuleQuiz::where('user_id', auth()->id())
                ->where('subject_id', $request->subject_id)
                ->where('module_id', $request->module_id)
                ->first();

            if (!$score) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quiz record not found.'
                ], 404);
            }

            if ($score->status === 'passed') {
                return response()->json([
                    'success' => false,
                    'message' => 'This quiz has already been completed.'
                ], 403);
            }

            if ($score->status === 'locked') {
                return response()->json([
                    'success' => false,
                    'message' => 'This quiz is locked.'
                ], 403);
            }

            $alreadyAnswered = AnsweredAssessmentQuestions::where('user_id', auth()->id())
                ->where('module_id', $request->module_id)
                ->where('question_id', $question->id)
                ->exists();

            if ($alreadyAnswered) {
                $answered_questions_ids = AnsweredAssessmentQuestions::where('user_id', auth()->id())
                    ->where('module_id', $request->module_id)
                    ->pluck('question_id');

                return response()->json([
                    'success' => true,
                    'score' => (int) $score->scored,
                    'correct' => $correct,
                    'already_answered' => true,
                    'answered_questions' => $answered_questions_ids
                ]);
            }

            AnsweredAssessmentQuestions::create([
                'user_id' => auth()->id(),
                'subject_id' => $request->subject_id,
                'module_id' => $request->module_id,
                'question_id' => $question->id,
                'type_of_assessment' => $type_of_assessment,
                'user_answer' => $student_answer,
                'correct_answer' => $correct_answer,
                'explanation' => $question->explanation,
                'is_correct' => $is_correct
            ]);

            if ($is_correct) {
                $open_temporary_points = TemporaryPoints::where('user_id', auth()->id())->value('points') ?? 0;

                TemporaryPoints::updateOrCreate(
                    ['user_id' => auth()->id()],
                    ['points' => $open_temporary_points + $question->points]
                );

                $score->increment('scored');
            }

            $score->refresh();

            $answered_questions_ids = AnsweredAssessmentQuestions::where('user_id', auth()->id())
                ->where('module_id', $request->module_id)
                ->pluck('question_id');

            return response()->json([
                'success' => true,
                'score' => (int) $score->scored,
                'correct' => $correct,
                'answered_questions' => $answered_questions_ids
            ]);

        // ===========================================================================================
        // EXAM
        // ===========================================================================================

        } elseif ($type_of_assessment === 'exam') {

            $alreadyAnswered = AnsweredAssessmentQuestions::where('user_id', auth()->id())
                ->where('subject_id', $request->subject_id)
                ->whereNull('module_id')
                ->where('question_id', $question->id)
                ->exists();

            if ($alreadyAnswered) {

                $answered_questions_ids = AnsweredAssessmentQuestions::where('user_id', auth()->id())
                    ->where('subject_id', $request->subject_id)
                    ->whereNull('module_id')
                    ->pluck('question_id');

                return response()->json([
                    'success' => true,
                    'correct' => $correct,
                    'is_correct' => $is_correct,
                    'already_answered' => true,
                    'answered_questions' => $answered_questions_ids
                ]);
            }

            AnsweredAssessmentQuestions::create([
                'user_id' => auth()->id(),
                'subject_id' => $request->subject_id,
                'question_id' => $question->id,
                'type_of_assessment' => $type_of_assessment,
                'user_answer' => $student_answer,
                'correct_answer' => $correct_answer,
                'explanation' => $question->explanation,
                'is_correct' => $is_correct
            ]);

            $score = AnsweredAssessmentQuestions::where('user_id', auth()->id())
                ->where('subject_id', $request->subject_id)
                ->whereNull('module_id')
                ->where('is_correct', true)
                ->count();

            if ($is_correct) {
                $open_temporary_points = TemporaryPoints::where('user_id', auth()->id())->value('points') ?? 0;

                TemporaryPoints::updateOrCreate(
                    ['user_id' => auth()->id()],
                    ['points' => $open_temporary_points + $question->points]
                );
            }

            $answered_questions_ids = AnsweredAssessmentQuestions::where('user_id', auth()->id())
                ->where('subject_id', $request->subject_id)
                ->whereNull('module_id')
                ->pluck('question_id');

            return response()->json([
                'success' => true,
                'score' => (int) $score,
                'correct' => $correct,
                'is_correct' => $is_correct,
                'answered_questions' => $answered_questions_ids
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid assessment type.'
        ], 422);
    }


    // ------------------------------------------------------------------------------------>>>>>>>>>>>>>>>>>>>>>>>>>>>>> RESULT PRETEST

    public function resultPretest(Request $request)
    {
        $type_of_assessment = $request->type_of_assessment;

        // ========================================================
        // QUIZ
        // ========================================================
        if ($type_of_assessment === 'quiz') {

            $module_quiz = ModuleQuiz::where('user_id', auth()->id())
                ->where('subject_id', $request->subject_id)
                ->where('module_id', $request->module_id)
                ->first();

            $module = Modules::findOrFail($request->module_id);

            if (!$module_quiz) {
                return redirect()->route('home');
            }

            if ($module_quiz->status === 'passed') {
                return redirect()->route('home');
            }

            if ($request->type === 'coding') {
                $questions = Questions::where('module_id', $module->id)
                    ->where('question_type', 'coding')
                    ->get();
            } else {
                $questions = Questions::where('module_id', $module->id)
                    ->whereIn('question_type', [
                        'multipleChoice',
                        'TorF',
                        'identification'
                    ])
                    ->get();
            }

            $question_ids = $questions->pluck('id');

            $answered_questions = AnsweredAssessmentQuestions::where('user_id', auth()->id())
                ->where('subject_id', $request->subject_id)
                ->where('module_id', $module->id)
                ->whereIn('question_id', $question_ids)
                ->pluck('question_id');

            $total_questions = min($questions->count(), 15);

            $answered_count = $answered_questions->count();

            $subject_name = Subjects::where('id', $request->subject_id)
                ->value('subject_name');

            if ($total_questions > 0 && $answered_count < $total_questions) {
                return redirect()->route('assessment.taking', [
                    'type_of_assessment' => $type_of_assessment,
                    'to_take' => $request->type,
                    'subject_name' => $subject_name,
                    'subject_id' => $request->subject_id,
                    'module_name' => str_replace(
                        ' ',
                        '_',
                        Modules::where('id', $module->id)->value('module_name')
                    ),
                    'module_id' => $module->id,
                ]);
            }

            $selected_questions = $questions
                ->whereIn('id', $answered_questions)
                ->values();

            $answered_assessment_questions = AnsweredAssessmentQuestions::where('user_id', auth()->id())
                ->where('subject_id', $request->subject_id)
                ->where('module_id', $module->id)
                ->where('type_of_assessment', 'quiz')
                ->get();

            $total_possible_points = (int) $selected_questions->sum('points');
            $total_possible_score = (int) $answered_assessment_questions->count();

            $temporary_points = TemporaryPoints::where('user_id', auth()->id())
                ->first();

            if ($request->type === 'coding') {
                $section_score = (int) $selected_questions->count() * 20;
            } else {
                $section_score = (int) $answered_assessment_questions->where('is_correct', true)->count();
            }

            $score_percent = $total_possible_score > 0
                ? ($section_score / $total_possible_score) * 100
                : 0;

            $status = $score_percent >= 75 ? 'Passed' : 'Failed';

            $module_name = $module->module_name;

            $message = $status === 'Passed'
                ? "Congratulations! You passed the quiz. Keep up the great work!"
                : "Don't give up! You didn't pass the quiz this time. Review your lessons and try again!";

            if ($status === 'Passed') {

                if ($request->type === 'coding') {
                    $module_quiz->update([
                        'coding_passed' => true
                    ]);
                } else {
                    $module_quiz->update([
                        'questions_type_passed' => true
                    ]);
                }

                $module_quiz->refresh();
                $module_passed = false;

                if ($module->has_question_type && $module->has_coding) {
                    if ($module_quiz->questions_type_passed && $module_quiz->coding_passed) {
                        $module_passed = true;
                    }

                } elseif ($module->has_question_type && !$module->has_coding) {
                    if ($module_quiz->questions_type_passed) {
                        $module_passed = true;
                    }

                } elseif (!$module->has_question_type && $module->has_coding) {
                    if ($module_quiz->coding_passed) {
                        $module_passed = true;
                    }
                }

                if ($module_passed) {

                    $user_scoreboard = UserScoreboard::where('user_id', auth()->id())
                        ->value('total_score') ?? 0;

                    UserScoreboard::updateOrCreate(
                        ['user_id' => auth()->id()],
                        ['total_score' => $user_scoreboard + (int) $module_quiz->scored]
                    );

                    $module_quiz->update([
                        'is_open' => false,
                        'has_passed' => true,
                        'scored' => 0
                    ]);

                    if ($temporary_points && $temporary_points->points > 0) {
                        $leaderboard = Leaderboard::firstOrCreate(
                            ['user_id' => auth()->id()],
                            ['points' => 0]
                        );

                        $leaderboard->increment(
                            'points',
                            (int) $temporary_points->points
                        );

                        $temporary_points->delete();
                    }

                    $nextmodule = ModuleQuiz::where('user_id', auth()->id())
                        ->where('subject_id', $request->subject_id)
                        ->where('module_id', '>', $module->id)
                        ->orderBy('module_id', 'asc')
                        ->first();

                    if ($nextmodule) {
                        $nextmodule->update([
                            'is_open' => true
                        ]);
                    }
                }
            } else {

                $module_quiz->update([
                    'scored' => 0
                ]);

                $temporary_points?->update([
                    'points' => 0
                ]);

                session()->forget('pretest_coding_points');
                session()->forget('pretest_coding_run');
            }

            $subject_id = $request->subject_id;
            $module_id = $module->id;

            return view(
                'Client.Pages.Assessment_Result',
                compact(
                    'score_percent',
                    'status',
                    'message',
                    'module_name',
                    'subject_name',
                    'module_id',
                    'subject_id',
                    'type_of_assessment',
                    'section_score'
                )
            );

        // ========================================================
        // EXAM
        // ========================================================
        } elseif ($type_of_assessment === 'exam') {

            $modules = Modules::where('subject_id', $request->subject_id)->get();

            $questions = Questions::whereIn('module_id', $modules->pluck('id'))
                ->whereIn('question_type', [
                    'multipleChoice',
                    'TorF',
                    'identification'
                ])->get();

            $question_ids = $questions->pluck('id');

            $answered_questions = AnsweredAssessmentQuestions::where('user_id', auth()->id())
                ->where('subject_id', $request->subject_id)
                ->whereNull('module_id')
                ->whereIn('question_id', $question_ids)
                ->where('type_of_assessment', 'exam')
                ->pluck('question_id');

            $total_questions = min($questions->count(), 40);

            $answered_count = $answered_questions->count();

            $subject_name = Subjects::where('id', $request->subject_id)
                ->value('subject_name');

            if ($total_questions > 0 && $answered_count < $total_questions) {
                return redirect()->route('assessment.taking', [
                    'type_of_assessment' => $type_of_assessment,
                    'to_take' => $request->type,
                    'subject_name' => $subject_name,
                    'subject_id' => $request->subject_id,
                    'module_name' => 'none',
                    'module_id' => "0",
                ]);
            }

            $temporary_points = TemporaryPoints::where('user_id', auth()->id())
                ->first();

            $score = AnsweredAssessmentQuestions::where('user_id', auth()->id())
                ->where('subject_id', $request->subject_id)
                ->whereNull('module_id')
                ->where('type_of_assessment', 'exam')
                ->where('is_correct', true)
                ->count();

            $section_score = (int) $score;

            $exam_total = max($total_questions, 1);
            $score_percent = ($score / $exam_total) * 100;

            $status = $score_percent >= 75 ? 'Passed' : 'Failed';

            $message = $status === 'Passed'
                ? "Congratulations! You passed the summative exam. Keep up the great work!"
                : "Don't give up! You didn't pass the summative exam this time. Review your lessons and try again!";

            if ($status === 'Passed') {

                $user_scoreboard = UserScoreboard::where('user_id', auth()->id())
                    ->value('total_score') ?? 0;

                UserScoreboard::updateOrCreate(
                    ['user_id' => auth()->id()],
                    ['total_score' => $user_scoreboard + (int) $score]
                );

                if ($temporary_points && $temporary_points->points > 0) {
                    $leaderboard = Leaderboard::firstOrCreate(
                        ['user_id' => auth()->id()],
                        ['points' => 0]
                    );

                    $leaderboard->increment(
                        'points',
                        (int) $temporary_points->points
                    );

                    $temporary_points->delete();
                }

            } else {

                $temporary_points?->update([
                    'points' => 0
                ]);

                session()->forget('pretest_coding_points');
                session()->forget('pretest_coding_run');
            }

            $subject_id = $request->subject_id;
            $module_id = $request->module_id ?? 0;
            $module_name = 'none';

            return view(
                'Client.Pages.Assessment_Result',
                compact(
                    'score_percent',
                    'status',
                    'message',
                    'module_name',
                    'subject_name',
                    'module_id',
                    'subject_id',
                    'type_of_assessment',
                    'section_score'
                )
            );
        }

        return redirect()->route('home');
    }
}