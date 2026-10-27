<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AnsweredAssessmentQuestions;
use App\Models\AnsweredModuleQuestions;
use App\Models\AnsweredQuestions;
use App\Models\Leaderboard;
use App\Models\ModuleProgress;
use App\Models\ModuleQuiz;
use App\Models\Modules;
use App\Models\ModuleStarted;
use App\Models\Questions;
use App\Models\StudentAttempts;
use App\Models\Subjects;
use App\Models\SubjectStarted;
use App\Models\TemporaryPoints;
use App\Models\Topics;
use App\Models\UserScoreboard;
use Illuminate\Http\Request;

class LearnController extends Controller
{

    // =================================================================================================================================
    // LEARN
    // =================================================================================================================================

    public function learn(Request $request){
        $subject = Subjects::findOrFail($request->subject_id);

        $modules = Modules::where('subject_id', $subject->id)
            ->orderBy('order', 'asc')
            ->get();
        
        $topics = Topics::whereIn('module_id', $modules->pluck('id'))
            ->orderBy('order', 'asc')
            ->get();

        $existingModuleIds = ModuleQuiz::where('user_id', auth()->id())
            ->where('subject_id', $subject->id)
            ->pluck('module_id');

        $modules_to_add = $modules->whereNotIn('id', $existingModuleIds);

        $hasOpenModule = ModuleQuiz::where('user_id', auth()->id())
            ->where('subject_id', $subject->id)
            ->where('is_open', true)
            ->exists();

        foreach ($modules_to_add as $index => $module) {
            $isOpen = !$hasOpenModule && $index === 0;

            ModuleQuiz::create([
                'user_id' => auth()->id(),
                'subject_id' => $subject->id,
                'module_id' => $module->id,
                'is_open' => $isOpen,
                'scored' => 0,
            ]);

            if ($isOpen) {
                $hasOpenModule = true;
            }
        }

        $subject_started = SubjectStarted::where('user_id', auth()->id())
            ->where('subject_id', $subject->id)
            ->exists();

        if (!$subject_started) {
            SubjectStarted::create([
                'user_id' => auth()->id(),
                'subject_id' => $subject->id
            ]);
        }

        $user_modules = ModuleQuiz::select('module_quiz.*')
            ->join('modules', 'module_quiz.module_id', '=', 'modules.id')
            ->where('module_quiz.user_id', auth()->id())
            ->where('module_quiz.subject_id', $subject->id)
            ->orderBy('modules.order', 'asc')
            ->get()
            ->map(function ($module) {

                if (
                    $module->questions_type_passed &&
                    $module->coding_passed
                ) {
                    $module->status = 'passed';
                } elseif ($module->is_open) {
                    $module->status = 'open';
                } else {
                    $module->status = 'locked';
                }

                return $module;
            });

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

        $subject_id = $subject->id;

        $answered_questions = AnsweredQuestions::where('user_id', auth()->id())
            ->get();

        $module_quizzes = ModuleQuiz::where('user_id', auth()->id())
            ->where('subject_id', $subject->id)
            ->get();

        $exam_open = $module_quizzes->isNotEmpty()
            && $module_quizzes->every(fn($quiz) => $quiz->has_passed === true);

        $modules_started = ModuleStarted::where('user_id', auth()->id())
            ->whereIn('module_id', $modules->pluck('id'))
            ->get();

        $exam_started = StudentAttempts::where('user_id', auth()->id())
            ->where('subject_id', $subject_id)
            ->where('module_id', null)
            ->exists();

        $answered_assessment_questions = AnsweredAssessmentQuestions::where('user_id', auth()->id())
            ->where('subject_id', $subject_id)
            ->where('module_id', null)
            ->where('type_of_assessment', 'exam')
            ->get();

        $exam_passed = false;
        if($answered_assessment_questions->count() === 40 ){
            $exam_score = $answered_assessment_questions->where('is_correct', true)->count();
            if($exam_score >= 30){
                $exam_passed = true;
            }else{
                $exam_passed = false;
            }
        }

        
            
        

        return view(
            'Client.Pages.Quiz_Modules',
            compact(
                'subject',
                'user_modules',
                'modules',
                'topics',
                'subject_id',
                'answered_questions',
                'questions',
                'exam_open',
                'modules_started',
                'exam_started',
                'exam_passed'
            )
        );
    }

    // =================================================================================================================================
    // LEARN MODULE
    // =================================================================================================================================

    public function learnModule(Request $request)
    {
        $subject = Subjects::where('id', $request->subject_id)->firstOrFail();
        $module = Modules::where('id', $request->module_id)->firstOrFail();
        $topics = Topics::where('module_id', $module->id)->orderBy('order', 'ASC')->get();

        $module_already_started = ModuleStarted::where('user_id', auth()->id())
            ->where('module_id', $module->id)
            ->exists();

        $module_in_progress = ModuleProgress::where('user_id', auth()->id())
            ->where('module_id', $module->id)
            ->exists();

        if (!$module_already_started) {
            ModuleStarted::create([
                'user_id' => auth()->id(),
                'module_id' => $module->id
            ]);
        }

        if (!$module_in_progress) {
            ModuleProgress::create([
                'user_id' => auth()->id(),
                'subject_id' => $subject->id,
                'module_id' => $module->id
            ]);
        }

        $module_progress = ModuleProgress::where('user_id', auth()->id())
            ->where('subject_id', $subject->id)
            ->where('module_id', $module->id)
            ->firstOrFail();
        
        $module_quiz = ModuleQuiz::where('user_id', auth()->id())
            ->where('subject_id', $subject->id)
            ->where('module_id', $module->id)
            ->firstOrFail();

        $activity_questions = Questions::where('module_id', $module->id)
            ->where('question_type', 'identification')
            ->inRandomOrder()
            ->limit(10)
            ->get();

        $answered_module_questions = AnsweredModuleQuestions::where('user_id', auth()->id())
            ->where('module_id', $module->id)
            ->get();

        $score = 0;
        $passing_percent = 80;
        $total_questions = $answered_module_questions->count();
        $failed = false;
        $answered_questions = [];

        if ($answered_module_questions->isNotEmpty()) {

            $answered_questions = Questions::whereIn('id', $answered_module_questions->pluck('question_id'))
                ->get();

            foreach ($answered_module_questions as $answered) {
                if (strtolower($answered->user_answer) === strtolower($answered->correct_answer)) {
                    $score++;
                }
            }

            $passing_score = (int) ceil($total_questions * ($passing_percent / 100));

            if ($score < $passing_score) {
                $failed = true;
            }
        }

        $viewData = compact(
            'module',
            'topics',
            'subject',
            'module_progress',
            'module_quiz',
            'activity_questions',
            'answered_questions',
            'failed',
            'score',
            'answered_module_questions'
        );

        switch ($subject->subject_name) {
            case "Discrete Mathematics":
                return view(
                    'Client.Review_Pages.Discrete_Mathematics',$viewData);
                break;
            
            case "Data Structures and Algorithms":
                return view(
                    'Client.Review_Pages.Data_Structures_And_Algorithms',$viewData);
                break;
            
            case "Introduction to Computing":
                return view(
                    'Client.Review_Pages.Introduction_To_Computing',$viewData);
                break;
        }
    }

    // =================================================================================================================================
    // SCROLL MODULE PROGRESS
    // =================================================================================================================================

    public function scrollModuleProgress(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'module_id' => 'required',
            'module_percent' => 'required|numeric|min:0|max:85',
        ]);

        $modulePercent = (float) $request->module_percent;

        if ($modulePercent % 5 !== 0) {
            return response()->json([
                'success' => false,
                'message' => 'Progress must use 5% increments.'
            ], 422);
        }

        $module_progress = ModuleProgress::where('user_id', auth()->id())
            ->where('subject_id', $request->subject_id)
            ->where('module_id', $request->module_id)
            ->first();

        if (!$module_progress) {
            return response()->json([
                'success' => false,
                'message' => 'Module progress record not found.'
            ], 404);
        }

        $currentProgress = (float) ($module_progress->progress ?? 0);

        if ($modulePercent > $currentProgress) {
            $module_progress->progress = $modulePercent;
            $module_progress->save();
        }

        return response()->json([
            'success' => true,
            'module_progress' => $module_progress->fresh()
        ]);
    }

    // =================================================================================================================================
    // SUBMIT MODULE ACTIVITY
    // =================================================================================================================================
    
    public function submitModuleActivity(Request $request)
    {
        $validated = $request->validate([
            'module_id' => ['required', 'uuid'],
            'subject_id' => ['required', 'uuid'],
            'answers' => ['required', 'array'],
            'answers.*.question_id' => ['required', 'uuid', 'exists:questions,id'],
            'answers.*.answer' => ['nullable', 'string', 'max:5000'],
        ]);

        $score = 0;
        $passing_percent = 80;
        $total_questions = count($validated['answers']);

        $temporary_points = TemporaryPoints::create([
            'user_id' => auth()->id(),
            'points' => 0,
        ]);

        $leaderboard = Leaderboard::where('user_id', auth()->id())->firstOrFail();
        $scoreboard = UserScoreboard::where('user_id', auth()->id())->firstOrFail();

        $module_progress = ModuleProgress::where('user_id', auth()->id())
            ->where('subject_id', $validated['subject_id'])
            ->where('module_id', $validated['module_id'])
            ->firstOrFail();

        foreach ($validated['answers'] as $item) {
            $questionId = $item['question_id'];
            $answer = strtolower(trim($item['answer'] ?? ''));

            $question = Questions::findOrFail($questionId);

            AnsweredModuleQuestions::create([
                'user_id' => auth()->id(),
                'module_id' => $validated['module_id'],
                'question_id' => $questionId,
                'user_answer' => $answer,
                'correct_answer' => $question->answer,
                'explanation' => $question->explanation,
            ]);

            if ($answer === strtolower(trim($question->answer))) {
                $score++;

                $temporary_points->update([
                    'points' => $temporary_points->points + $question->points,
                ]);
            }
        }

        $answered_questions = AnsweredModuleQuestions::where('user_id', auth()->id())
            ->where('module_id', $validated['module_id'])
            ->get();

        $passing_score = (int) ceil($total_questions * ($passing_percent / 100));

        if ($score >= $passing_score) {
            $leaderboard->update([
                'points' => $leaderboard->points + $temporary_points->points,
            ]);

            $scoreboard->update([
                'total_score' => $scoreboard->total_score + $score
            ]);

            $module_progress->update([
                'progress' => 100,
                'has_passed' => true,
            ]);

            $temporary_points->delete();

            return response()->json([
                'success' => true,
                'failed' => false,
                'score' => $score,
                'answers' => $answered_questions,
            ]);
        }

        $temporary_points->delete();

        return response()->json([
            'success' => true,
            'failed' => true,
            'score' => $score,
            'answers' => $answered_questions,
        ]);
    }

    // =================================================================================================================================
    // RETAKE
    // =================================================================================================================================

    public function retakeActivity(Request $request)
    {
        $request->validate([
            'module_id' => ['required', 'uuid', 'exists:modules,id'],
        ]);

        $module_id = $request->module_id;

        AnsweredModuleQuestions::where('user_id', auth()->id())
            ->where('module_id', $module_id)
            ->delete();

        $new_questions = Questions::where('module_id', $module_id)
            ->where('question_type', 'identification')
            ->inRandomOrder()
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'failed' => false,
            'new_questions' => $new_questions
        ]);
    }

    public function retakeAssessment(){
        
    }

}