<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Support\AnswerNormalizer;
use App\Models\AnsweredAssessmentQuestions;
use App\Models\AnsweredModuleQuestions;
use App\Models\Leaderboard;
use App\Models\ModuleProgress;
use App\Models\ModuleQuiz;
use App\Models\Modules;
use App\Models\ModuleStarted;
use App\Models\Questions;
use App\Models\StudentAttempts;
use App\Models\SubjectProgress;
use App\Models\Subjects;
use App\Models\Topics;
use Illuminate\Http\Request;

class LearnController extends Controller
{

    // =================================================================================================================================
    // LEARN
    // =================================================================================================================================

    public function learn(Request $request){

        $subject = Subjects::findOrFail($request->subject_id);

        if ($subject->pre_requisite) {
            $pre_req_has_passed = SubjectProgress::where('user_id', auth()->id())
                ->where('subject_id', $subject->pre_requisite)
                ->where('progress', '>=', 100)
                ->where('has_passed', true)
                ->exists();

            if (!$pre_req_has_passed) {
                return redirect()->route('home');
            }
        }

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

        $answered_assessment_questions_exam = AnsweredAssessmentQuestions::where('user_id', auth()->id())
            ->where('subject_id', $subject_id)
            ->where('module_id', null)
            ->where('type_of_assessment', 'exam')
            ->get();

        $exam_passed = false;
        if($answered_assessment_questions_exam->count() === 40 ){
            $exam_score = $answered_assessment_questions_exam->where('is_correct', true)->count();
            if($exam_score >= 30){
                $exam_passed = true;
            }else{
                $exam_passed = false;
            }
        }


        $subject_progress = SubjectProgress::where('user_id', auth()->id())
            ->where('subject_id', $subject->id)
            ->exists();

        if (!$subject_progress) {
            SubjectProgress::create([
                'user_id' => auth()->id(),
                'subject_id' => $subject->id
            ]);
        }

        $subject_started = $subject_progress;

        $total_modules = $module_quizzes->count();


        $remaining_modules = ModuleQuiz::where('user_id', auth()->id())
            ->where('subject_id', $subject_id)
            ->where('has_passed', false)
            ->count(); 
            
        $modules_passed_count = ModuleQuiz::where('user_id', auth()->id())
            ->where('subject_id', $subject_id)
            ->where('has_passed', true)
            ->count();

        $modules_passed = ModuleQuiz::where('user_id', auth()->id())
            ->where('subject_id', $subject_id)
            ->where('has_passed', true)
            ->get();

        $answered_assessment_questions_quiz = AnsweredAssessmentQuestions::where('user_id', auth()->id())
            ->where('subject_id', $subject_id)
            ->whereIn('module_id', $modules_passed->pluck('module_id'))
            ->where('type_of_assessment', 'quiz')
            ->get();

        $quizzes_total_score = $answered_assessment_questions_quiz->where('is_correct', true)->count(); 

        $exam_score = $answered_assessment_questions_exam->where('is_correct', true)->count();
        if($exam_score >= ceil(40 * 0.75) ){
            $total_assessment_score = $exam_score + $quizzes_total_score;
            $total_answered_assessment = $answered_assessment_questions_exam->count() + $answered_assessment_questions_quiz->count();
        }else{
            $total_assessment_score = $quizzes_total_score;
            $total_answered_assessment = $answered_assessment_questions_quiz->count();
        }


        $answered_module_questions = AnsweredModuleQuestions::where('user_id', auth()->id())
            ->whereIn('module_id', $modules_passed->pluck('module_id'))
            ->get();

        $total_answered = $total_answered_assessment + $answered_module_questions->count();

        $activity_score = 0;
        foreach($answered_module_questions as $amq){
            if (AnswerNormalizer::isCorrect($amq->user_answer, $amq->correct_answer)) {
                $activity_score++;
            }
        }
        $total_score = $total_assessment_score + $activity_score;

        $average_score = $total_answered > 0
            ? round(($total_score / $total_answered) * 100)
            : 0;

        return view(
            'Client.Pages.Quiz_Modules',
            compact(
                'subject',
                'user_modules',
                'modules',
                'topics',
                'subject_id',
                'questions',
                'exam_open',
                'modules_started',
                'exam_started',
                'exam_passed',
                'remaining_modules',
                'modules_passed_count',
                'average_score'
            )
        );
    }

    // =================================================================================================================================
    // LEARN MODULE
    // =================================================================================================================================

    public function learnModule(Request $request)
    {
        $subject = Subjects::where('id', $request->subject_id)->firstOrFail();

        if ($subject->pre_requisite) {
            $pre_req_has_passed = SubjectProgress::where('user_id', auth()->id())
                ->where('subject_id', $subject->pre_requisite)
                ->where('progress', '>=', 100)
                ->where('has_passed', true)
                ->exists();

            if (!$pre_req_has_passed) {
                return redirect()->route('home');
            }
        }

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

        $has_unpassed_previous_module = ModuleQuiz::where('user_id', auth()->id())
            ->where('subject_id', $subject->id)
            ->where('id', '<', $module_quiz->id)
            ->where('has_passed', false)
            ->exists();

        if ($has_unpassed_previous_module) {
            return redirect()->route('home');
        }

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

        $next_module = Modules::where('subject_id', $subject->id)
            ->where('order', '>', $module->order)
            ->orderBy('order', 'ASC')
            ->first();

        if ($answered_module_questions->isNotEmpty()) {

        foreach ($answered_module_questions as $answered) {

            if (AnswerNormalizer::isCorrect(
                $answered->user_answer,
                $answered->correct_answer
            )) {

                $score++;

                if ($answered->is_correct !== true) {
                    $answered->is_correct = true;
                    $answered->save();
                }

            } else {

                if ($answered->is_correct !== false) {
                    $answered->is_correct = false;
                    $answered->save();
                }

            }
        }

        $passing_score = (int) ceil(
            $total_questions * ($passing_percent / 100)
        );

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
            'answered_module_questions',
            'next_module',
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

            case "Computer Programming 1":
                return view(
                    'Client.Review_Pages.Computer_Programming_1',$viewData);
                break;
            
            case "Computer Programming 2":
                return view(
                    'Client.Review_Pages.Computer_Programming_2',$viewData);
                break;

        }
    }

    // =================================================================================================
    // 
    //  ███████╗ ██████╗██████╗  ██████╗ ██╗     ██╗         ██████╗ ██████╗  ██████╗  ██████╗ ██████╗ ███████╗███████╗███████╗
    //  ██╔════╝██╔════╝██╔══██╗██╔═══██╗██║     ██║         ██╔══██╗██╔══██╗██╔═══██╗██╔════╝ ██╔══██╗██╔════╝██╔════╝██╔════╝
    //  ███████╗██║     ██████╔╝██║   ██║██║     ██║         ██████╔╝██████╔╝██║   ██║██║  ███╗██████╔╝█████╗  ███████╗███████╗
    //  ╚════██║██║     ██╔══██╗██║   ██║██║     ██║         ██╔═══╝ ██╔══██╗██║   ██║██║   ██║██╔══██╗██╔══╝  ╚════██║╚════██║
    //  ███████║╚██████╗██║  ██║╚██████╔╝███████╗███████╗    ██║     ██║  ██║╚██████╔╝╚██████╔╝██║  ██║███████╗███████║███████║
    //  ╚══════╝ ╚═════╝╚═╝  ╚═╝ ╚═════╝ ╚══════╝╚══════╝    ╚═╝     ╚═╝  ╚═╝ ╚═════╝  ╚═════╝ ╚═╝  ╚═╝╚══════╝╚══════╝╚══════╝
    // 
    // =================================================================================================

    
    public function scrollModuleProgress(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'module_id' => 'required',
            'module_percent' => 'required|numeric|min:0|max:85',
        ]);

        $subject_progress = SubjectProgress::where('user_id', auth()->id())
            ->where('subject_id', $request->subject_id)
            ->first();

        if (!$subject_progress) {
            return response()->json([
                'success' => false,
                'message' => 'Subject progress record not found.'
            ], 404);
        }

        $module_quizzes = ModuleQuiz::where('user_id', auth()->id())
            ->where('subject_id', $request->subject_id)
            ->get();

        $module = Modules::find($request->module_id);

        if (!$module) {
            return response()->json([
                'success' => false,
                'message' => 'Module not found.'
            ], 404);
        }

        $total_modules = $module_quizzes->count();

        if ($total_modules === 0) {
            return response()->json([
                'success' => false,
                'message' => 'No modules found.'
            ], 422);
        }

        $module_weight = 80;

        $completed_modules = $module_quizzes->where('has_passed', true)->count();

        $has_coding = $module->has_coding;

        $percent_per_module = $module_weight / $total_modules;

        $module_progress = $percent_per_module;

        $scroll_progress = 0.0;
        $activity_progress = 0.0;
        $quiz_progress = 0.0;
        $coding_progress = 0.0;

        if (!$has_coding) {
            $scroll_progress = $module_progress / 3;
            $activity_progress = $module_progress / 3;
            $quiz_progress = $module_progress / 3;
        } else {
            $scroll_progress = $module_progress / 4;
            $activity_progress = $module_progress / 4;
            $quiz_progress = $module_progress / 4;
            $coding_progress = $module_progress / 4;
        }

        $modulePercent = (float) $request->module_percent;

        if (fmod($modulePercent, 5.0) != 0.0) {
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

            if ($modulePercent >= 85 && $currentProgress < 85) {
                $subject_progress->progress += (float) $scroll_progress;
                $subject_progress->save();
            }
        }

        return response()->json([
            'success' => true,
            'module_progress' => $module_progress->fresh(),
            'subject_progress' => $subject_progress->fresh(),
        ]);
    }

    // =================================================================================================
    // 
    //  ███████╗██╗   ██╗██████╗ ███╗   ███╗██╗████████╗    █████╗  ██████╗████████╗██╗██╗   ██╗██╗████████╗██╗   ██╗
    //  ██╔════╝██║   ██║██╔══██╗████╗ ████║██║╚══██╔══╝   ██╔══██╗██╔════╝╚══██╔══╝██║██║   ██║██║╚══██╔══╝╚██╗ ██╔╝
    //  ███████╗██║   ██║██████╔╝██╔████╔██║██║   ██║      ███████║██║        ██║   ██║██║   ██║██║   ██║    ╚████╔╝ 
    //  ╚════██║██║   ██║██╔══██╗██║╚██╔╝██║██║   ██║      ██╔══██║██║        ██║   ██║╚██╗ ██╔╝██║   ██║     ╚██╔╝  
    //  ███████║╚██████╔╝██████╔╝██║ ╚═╝ ██║██║   ██║      ██║  ██║╚██████╗   ██║   ██║ ╚████╔╝ ██║   ██║      ██║   
    //  ╚══════╝ ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚═╝   ╚═╝      ╚═╝  ╚═╝ ╚═════╝   ╚═╝   ╚═╝  ╚═══╝  ╚═╝   ╚═╝      ╚═╝   
    // 
    // =================================================================================================
    
    
    
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
        $points = 0;
        $passing_percent = 80;
        $total_questions = count($validated['answers']);

        $leaderboard = Leaderboard::where('user_id', auth()->id())->firstOrFail();

        $module_progress = ModuleProgress::where('user_id', auth()->id())
            ->where('subject_id', $validated['subject_id'])
            ->where('module_id', $validated['module_id'])
            ->firstOrFail();

        $subject_progress = SubjectProgress::where('user_id', auth()->id())
            ->where('subject_id', $validated['subject_id'])
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

            if (AnswerNormalizer::isCorrect($answer, $question->answer)) {
                $score++;
                $points += $question->points;
            }
        }

        $answered_questions = AnsweredModuleQuestions::where('user_id', auth()->id())
            ->where('module_id', $validated['module_id'])
            ->get();

        $passing_score = (int) ceil($total_questions * ($passing_percent / 100));

        // SUBJECT PROGRESS

        $module_quizzes = ModuleQuiz::where('user_id', auth()->id())
            ->where('subject_id', $validated['subject_id'])
            ->get();

        $module = Modules::findOrFail($validated['module_id']);

        $total_modules = $module_quizzes->count();

        if ($total_modules === 0) {
            return response()->json([
                'success' => false,
                'message' => 'No modules found.'
            ], 422);
        }

        $module_weight = 80;
        $completed_modules = $module_quizzes->where('has_passed', true)->count();
        $has_coding = $module->has_coding;

        $percent_per_module = $module_weight / $total_modules;

        $module_weight_progress = $percent_per_module;

        if (!$has_coding) {
            $activity_progress = $module_weight_progress / 3;
        } else {
            $activity_progress = $module_weight_progress / 4;
        }

        if ($score >= $passing_score) {

            if (!$module_progress->has_passed) {

                $leaderboard->increment('points', (int) $points);

                $module_progress->update([
                    'progress' => 100,
                    'has_passed' => true,
                ]);

                $subject_progress->progress += (float) $activity_progress;
                $subject_progress->save();

            }

            return response()->json([
                'success' => true,
                'failed' => false,
                'score' => $score,
                'answers' => $answered_questions,
            ]);
        }

        return response()->json([
            'success' => true,
            'failed' => true,
            'score' => $score,
            'answers' => $answered_questions,
        ]);
    }



    // =================================================================================================
    // 
    //  ██████╗ ███████╗████████╗ █████╗ ██╗  ██╗███████╗     █████╗  ██████╗████████╗██╗██╗   ██╗██╗████████╗██╗   ██╗
    //  ██╔══██╗██╔════╝╚══██╔══╝██╔══██╗██║ ██╔╝██╔════╝    ██╔══██╗██╔════╝╚══██╔══╝██║██║   ██║██║╚══██╔══╝╚██╗ ██╔╝
    //  ██████╔╝█████╗     ██║   ███████║█████╔╝ █████╗      ███████║██║        ██║   ██║██║   ██║██║   ██║    ╚████╔╝ 
    //  ██╔══██╗██╔══╝     ██║   ██╔══██║██╔═██╗ ██╔══╝      ██╔══██║██║        ██║   ██║╚██╗ ██╔╝██║   ██║     ╚██╔╝  
    //  ██║  ██║███████╗   ██║   ██║  ██║██║  ██╗███████╗    ██║  ██║╚██████╗   ██║   ██║ ╚████╔╝ ██║   ██║      ██║   
    //  ╚═╝  ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝    ╚═╝  ╚═╝ ╚═════╝   ╚═╝   ╚═╝  ╚═══╝  ╚═╝   ╚═╝      ╚═╝   
    // 
    // =================================================================================================

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

    

}