<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AnsweredQuestions;
use App\Models\Choices;
use App\Models\Leaderboard;
use App\Models\ModulePretest;
use App\Models\Modules;
use App\Models\PretestSavedCodes;
use App\Models\Questions;
use App\Models\Subjects;
use App\Models\TemporaryPoints;
use App\Models\TestCase;
use App\Models\UserScoreboard;
use Illuminate\Http\Request;

class Pretest extends Controller
{
    public function pretestModules(Request $request)
    {
        $subject = str_replace('_', ' ', $request->subject_name);

        $modules = Modules::where('subject_id', $request->subject_id)
            ->orderBy('order', 'asc')
            ->get();

        $existingModuleIds = ModulePretest::where('user_id', auth()->id())
            ->where('subject_id', $request->subject_id)
            ->pluck('module_id');

        $modules_to_add = Modules::where('subject_id', $request->subject_id)
            ->whereNotIn('id', $existingModuleIds)
            ->orderBy('order', 'asc')
            ->get();

        $hasOpenModule = ModulePretest::where('user_id', auth()->id())
            ->where('subject_id', $request->subject_id)
            ->where('status', 'open')
            ->exists();        

        foreach ($modules_to_add as $index => $module) {
            $status = (!$hasOpenModule && $index === 0) ? 'open' : 'locked';

            ModulePretest::create([
                'user_id' => auth()->id(),
                'subject_id' => $request->subject_id,
                'module_id' => $module->id,
                'status' => $status,
                'scored' => 0,
            ]);

            if ($status === 'open') {
                $hasOpenModule = true;
            }
        }

        $user_modules = ModulePretest::select('module_pretest.*')
            ->join('modules', 'module_pretest.module_id', '=', 'modules.id')
            ->where('module_pretest.user_id', auth()->id())
            ->where('module_pretest.subject_id', $request->subject_id)
            ->orderBy('modules.order', 'asc')
            ->get();

        $questions = Questions::whereIn('module_id', $modules->pluck('id'))
            ->get()
            ->groupBy('module_id')
            ->map(function ($moduleQuestions) {
                $nonCoding = $moduleQuestions
                    ->where('question_type', '!=', 'coding')
                    ->shuffle()
                    ->take(15);

                $coding = $moduleQuestions
                    ->where('question_type', 'coding')
                    ->shuffle()
                    ->take(5);

                return $nonCoding->concat($coding)->values();
        });

        $subject_id = $request->subject_id;
        $answered_questions = AnsweredQuestions::where('user_id', auth()->id())->get();

        return view(
            'Client.Pages.Pretest_Modules',
            compact(
                'subject',
                'user_modules',
                'modules',
                'subject_id',
                'answered_questions',
                'questions'
            )
        );
    }

    public function takingPretest(Request $request)
    {
        $module_pretest = ModulePretest::where('user_id', auth()->id())
            ->where('subject_id', $request->subject_id)
            ->where('module_id', $request->module_id)
            ->first();
        
        $module = Modules::findOrFail($request->module_id);

        if (!$module_pretest) {
            return redirect()->route('home');
        }

        if ($module_pretest->status === 'passed') {
            return redirect()->route('home');
        }

        if ($module_pretest->status === 'locked') {
            return redirect()->route('home');
        }

        if ($module_pretest->status === 'failed') {
            $module_pretest->update([
                'status' => 'open'
            ]);
        }

        

        $answered_questions_data = AnsweredQuestions::where('user_id', auth()->id())
            ->where('module_id', $request->module_id)
            ->get();

        $answered_question_ids = $answered_questions_data->pluck('question_id');

        $questions_count = Questions::where('module_id', $request->module_id)->count();

        $total_questions = min($questions_count, 15);

        $answered_count = $answered_questions_data
            ->whereIn('question_id', Questions::where('module_id', $request->module_id)->pluck('id'))
            ->count();

        $remaining_questions = max(0, $total_questions - $answered_count);

        $module_id = $request->module_id;
        $subject_id = $request->subject_id;

        $subject_name = Subjects::where('id', $subject_id)
            ->value('subject_name');
        

        $module_name = Modules::where('id', $module_id)
            ->value('module_name');

        $score = ModulePretest::where('user_id', auth()->id())
            ->where('subject_id', $subject_id)
            ->where('module_id', $module_id)
            ->value('scored');


        if($request->to_take === 'question_type'){
           $questions = Questions::where('module_id', $request->module_id)
            ->whereNotIn('id', $answered_question_ids)
            ->whereIn('question_type', ['multipleChoice', 'TorF', 'identification'])
            ->inRandomOrder()
            ->limit($remaining_questions)
            ->get();

            $choices = Choices::whereIn('question_id', $questions->pluck('id'))->get();

            return view(
                'Client.Pages.PreTest',
                compact(
                    'questions',
                    'choices',
                    'answered_count',
                    'answered_questions_data',
                    'module_id',
                    'subject_id',
                    'subject_name',
                    'module_name',
                    'score'
                )
            );
            
        }elseif($request->to_take === 'coding'){
            $questions = Questions::where('module_id', $request->module_id)
                ->whereNotIn('id', $answered_question_ids)
                ->where('question_type', 'coding')
                ->inRandomOrder()
                ->limit($remaining_questions)
                ->get();

            $saved_codes = PretestSavedCodes::where('user_id', auth()->user()->id)
                ->whereIn('question_id', $questions->pluck('id'))
                ->get();
            
            $test_case = TestCase::whereIn('question_id', $questions->pluck('id'))->get();

            return view(
                'Client.Pages.Pretest_Code',
                compact(
                    'questions',
                    'test_case',
                    'saved_codes',
                    'answered_count',
                    'answered_questions_data',
                    'module_id',
                    'subject_id',
                    'subject_name',
                    'module_name',
                    'score'
                )
            );
        }

    }





    public function submitAnswer(Request $request)
    {
        $request->validate([
            'question_id' => ['required', 'uuid'],
            'student_answer' => ['required', 'string'],
            'subject_id' => ['required', 'uuid'],
            'module_id' => ['required', 'uuid'],
        ]);

        $question = Questions::where('id', $request->question_id)
            ->where('module_id', $request->module_id)
            ->first();

        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Question not found.'
            ], 404);
        }

        $score = ModulePretest::where('user_id', auth()->id())
            ->where('subject_id', $request->subject_id)
            ->where('module_id', $request->module_id)
            ->first();

        if (!$score) {
            return response()->json([
                'success' => false,
                'message' => 'Pretest record not found.'
            ], 404);
        }

        if ($score->status === 'passed') {
            return response()->json([
                'success' => false,
                'message' => 'This pretest has already been completed.'
            ], 403);
        }

        if ($score->status === 'locked') {
            return response()->json([
                'success' => false,
                'message' => 'This pretest is locked.'
            ], 403);
        }

        $student_answer = strtolower(trim($request->student_answer));
        $correct_answer = strtolower(trim($question->answer));

        $alreadyAnswered = AnsweredQuestions::where('user_id', auth()->id())
            ->where('module_id', $request->module_id)
            ->where('question_id', $question->id)
            ->exists();

        if ($alreadyAnswered) {
            $correct = $correct_answer === $student_answer ? 'yes' : 'no';

            $answered_questions_ids = AnsweredQuestions::where('user_id', auth()->id())
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

        AnsweredQuestions::create([
            'user_id' => auth()->id(),
            'module_id' => $request->module_id,
            'question_id' => $question->id,
            'answered_at' => now()
        ]);

        $correct = 'no'; 
        $open_temporary_points = TemporaryPoints::where('user_id', auth()->id())->value('points') ?? 0;

        if ($correct_answer === $student_answer) {

            TemporaryPoints::updateOrCreate(
                ['user_id' => auth()->id()],
                ['points' => $open_temporary_points + $question->points]
            );

            $score->increment('scored');
            $correct = 'yes';
        }

        $score->refresh();

        $answered_questions_ids = AnsweredQuestions::where('user_id', auth()->id())
            ->where('module_id', $request->module_id)
            ->pluck('question_id');

        return response()->json([
            'success' => true,
            'score' => (int) $score->scored,
            'correct' => $correct,
            'answered_questions' => $answered_questions_ids
        ]);
    }


    // ------------------------------------------------------------------------------------>>>>>>>>>>>>>>>>>>>>>>>>>>>>> RESULT PRETEST

    public function resultPretest(Request $request)
    {
        $module_pretest = ModulePretest::where('user_id', auth()->id())
            ->where('subject_id', $request->subject_id)
            ->where('module_id', $request->module_id)
            ->first();

        $module = Modules::findOrFail($request->module_id);

        if (!$module_pretest) {
            return redirect()->route('home');
        }

        if ($module_pretest->status === 'passed') {
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

        $answered_questions = AnsweredQuestions::where('user_id', auth()->id())
            ->where('module_id', $module->id)
            ->whereIn('question_id', $question_ids)
            ->pluck('question_id');

        $total_questions = min($questions->count(), 15);

        $answered_count = $answered_questions->count();

        $subject_name = Subjects::where('id', $request->subject_id)
            ->value('subject_name');

        if ($total_questions > 0 && $answered_count < $total_questions) {
            return redirect()->route('pretest.taking', [
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

        $total_possible_points = (int) $selected_questions->sum('points');

        if ($request->type === 'coding') {
            $section_score = (int) $selected_questions->sum('points');
        } else {
            $temporary_points = TemporaryPoints::where('user_id', auth()->id())
                ->first();

            $coding_points = array_sum(
                session('pretest_coding_points', [])
            );

            $section_score = max(
                0,
                (int) ($temporary_points?->points ?? 0) - $coding_points
            );
        }

        $score_percent = $total_possible_points > 0
            ? ($section_score / $total_possible_points) * 100
            : 0;

        $status = $score_percent >= 75 ? 'Passed' : 'Failed';

        $module_name = $module->module_name;

        $message = $status === 'Passed'
            ? "Excellent work! You passed the pretest. You're ready to move forward!"
            : "Don't give up! You didn't pass the pretest this time. Keep studying and try again!";

        $temporary_points = TemporaryPoints::where('user_id', auth()->id())
            ->first();

        if ($status === 'Passed') {

            if ($request->type === 'coding') {
                $module_pretest->update([
                    'coding_passed' => true
                ]);
            } else {
                $module_pretest->update([
                    'questions_type_passed' => true
                ]);
            }

            $module_pretest->refresh();
            $module_passed = false;

            if ($module->has_question_type && $module->has_coding) {
                if ($module_pretest->questions_type_passed &&$module_pretest->coding_passed){
                    $module_passed = true;
                }

            } elseif ($module->has_question_type && !$module->has_coding) {
                if ($module_pretest->questions_type_passed) {
                    $module_passed = true;
                }

            } elseif (!$module->has_question_type && $module->has_coding) {
                if ($module_pretest->coding_passed) {
                    $module_passed = true;
                }
            }

            if ($module_passed) {

                $user_scoreboard = UserScoreboard::where('user_id', auth()->id())
                    ->value('total_score') ?? 0;

                UserScoreboard::updateOrCreate(
                    ['user_id' => auth()->id()],
                    ['total_score' => $user_scoreboard + (int) $module_pretest->scored]
                );

                $module_pretest->update([
                    'status' => 'passed',
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

                $nextmodule = ModulePretest::where('user_id', auth()->id())
                    ->where('subject_id', $request->subject_id)
                    ->where('module_id', '>', $module->id)
                    ->orderBy('module_id', 'asc')
                    ->first();

                if ($nextmodule) {
                    $nextmodule->update([
                        'status' => 'open'
                    ]);
                }
            }
        } else {

            $module_pretest->update([
                'scored' => 0
            ]);

            $temporary_points?->update([
                'points' => 0
            ]);

            session()->forget('pretest_coding_points');
            session()->forget('pretest_coding_run');
        }

        AnsweredQuestions::where('user_id', auth()->id())
            ->where('module_id', $module->id)
            ->delete();

        $subject_id = $request->subject_id;
        $module_id = $module->id;

        return view(
            'Client.Pages.Pretest_Result',
            compact(
                'score_percent',
                'status',
                'message',
                'module_name',
                'subject_name',
                'module_id',
                'subject_id',
            )
        );
    }
        

    
}