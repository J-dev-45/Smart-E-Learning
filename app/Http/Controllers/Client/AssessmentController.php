<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Support\AnswerNormalizer;
use App\Models\AnsweredAssessmentQuestions;
use App\Models\Choices;
use App\Models\Leaderboard;
use App\Models\ModuleProgress;
use App\Models\ModuleQuiz;
use App\Models\Modules;
use App\Models\PretestSavedCodes;
use App\Models\Questions;
use App\Models\StudentAttempts;
use App\Models\SubjectProgress;
use App\Models\Subjects;
use App\Models\TestCase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentController extends Controller
{
    public function taking_assessment(Request $request)
    {
        $subject_id = $request->subject_id;
        $module_id = $request->module_id;
        $module_name = $request->module_name;
        $type_of_assessment = $request->type_of_assessment;

        $subject = Subjects::findOrFail($subject_id);
        
        $subject_name = $subject->subject_name;

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

        if($request->type_of_assessment === 'quiz'){
            
            $module_quiz = ModuleQuiz::where('user_id', auth()->id())
            ->where('subject_id', $request->subject_id)
            ->where('module_id', $request->module_id)
            ->first();
        
            $module = Modules::findOrFail($request->module_id);
            $module_progress_has_passed = ModuleProgress::where('user_id', auth()->id())
                ->where('subject_id', $subject_id)
                ->where('module_id', $module_id)
                ->where('has_passed', true)
                ->exists();
            
            if(!$module_progress_has_passed){
                return redirect()->route('home');
            }

            if (!$module_quiz) {
                return redirect()->route('home');
            }

            if ($module_quiz->status === 'passed') {
                return redirect()->route('home');
            }

            if ($module_quiz->status === 'locked') {
                return redirect()->route('home');
            }

            if ($module_quiz->status === 'failed') {
                $module_quiz->update([
                    'status' => 'open'
                ]);
            }

            

            $answered_questions_data = AnsweredAssessmentQuestions::where('user_id', auth()->id())
                ->where('subject_id', $subject_id)
                ->where('module_id', $request->module_id)
                ->where('type_of_assessment', 'quiz')
                ->get();

            $answered_question_ids = $answered_questions_data->pluck('question_id');

            $questions_count = Questions::where('module_id', $request->module_id)->count();

            $total_questions = min($questions_count, 15);

            $answered_count = $answered_questions_data
                ->whereIn('question_id', Questions::where('module_id', $request->module_id)->pluck('id'))
                ->count();

            $remaining_questions = max(0, $total_questions - $answered_count);

            if($remaining_questions === 0){
                return redirect()->route('assessment.result', [
                    'type_of_assessment' => $type_of_assessment,
                    'type' => $request->to_take,
                    'subject_name' => str_replace(
                        ' ',
                        '_',
                        $subject_name
                    ),
                    'subject_id' => $request->subject_id,
                    'module_name' => str_replace(
                        ' ',
                        '_',
                        $module->module_name
                    ),
                    'module_id' => $module->id,
                ]);
            }
            

            $module_name = Modules::where('id', $module_id)
                ->value('module_name');

            $score = ModuleQuiz::where('user_id', auth()->id())
                ->where('subject_id', $subject_id)
                ->where('module_id', $module_id)
                ->value('scored');


            $total_seconds = 60 * 60;

            $start = now();

            $student_attempt = StudentAttempts::firstOrCreate(
                [
                    'user_id' => auth()->id(),
                    'subject_id' => $subject_id,
                    'module_id' => $module_id,
                    'type_of_assessment' => 'quiz',
                    'finished_at' => null,
                ],
                [
                    'started_at' => $start,
                    'ends_at' => $start->copy()->addSeconds($total_seconds),
                ]
            );

            $remaining_seconds = max(0, (int) now()->diffInSeconds($student_attempt->ends_at, false));

            
            // ===========================
            // 
            // ===========================
            if($request->to_take === 'question_type'){
                $multipleChoiceQuestions = Questions::where('module_id', $request->module_id)
                    ->whereNotIn('id', $answered_question_ids)
                    ->where('question_type', 'multipleChoice')
                    ->inRandomOrder()
                    ->take(5)
                    ->get();

                $trueOrFalseQuestions = Questions::where('module_id', $request->module_id)
                    ->whereNotIn('id', $answered_question_ids)
                    ->where('question_type', 'TorF')
                    ->inRandomOrder()
                    ->take(5)
                    ->get();

                $identificationQuestions = Questions::where('module_id', $request->module_id)
                    ->whereNotIn('id', $answered_question_ids)
                    ->where('question_type', 'identification')
                    ->inRandomOrder()
                    ->take(5)
                    ->get();

                $questions = $multipleChoiceQuestions
                    ->concat($trueOrFalseQuestions)
                    ->concat($identificationQuestions)
                    ->shuffle()
                    ->values();

                $choices = Choices::whereIn('question_id', $questions->pluck('id'))->get();

                return view(
                    'Client.Pages.Assessment',
                    compact(
                        'questions',
                        'choices',
                        'answered_count',
                        'answered_questions_data',
                        'module_id',
                        'subject_id',
                        'subject_name',
                        'module_name',
                        'score',
                        'remaining_seconds',
                        'total_seconds',
                        'type_of_assessment'
                    )
                );
                
            }elseif($request->to_take === 'coding'){
                $questions = Questions::where('module_id', $request->module_id)
                    ->whereNotIn('id', $answered_question_ids)
                    ->where('question_type', 'coding')
                    ->inRandomOrder()
                    ->limit(1)
                    ->get();

                $saved_codes = PretestSavedCodes::where('user_id', auth()->user()->id)
                    ->whereIn('question_id', $questions->pluck('id'))
                    ->get();
                
                $test_case = TestCase::whereIn('question_id', $questions->pluck('id'))->get();

                return view(
                    'Client.Pages.Assessment',
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
                        'score',
                        'remaining_seconds',
                        'total_seconds',
                        'type_of_assessment'
                    )
                );
            }

        }elseif($request->type_of_assessment === 'exam'){

            $modules = Modules::where('subject_id', $subject_id)->get();

            $answered_questions_data = AnsweredAssessmentQuestions::where('user_id', auth()->id())
                ->where('subject_id', $subject_id)
                ->where('module_id', null)
                ->where('type_of_assessment', 'exam')
                ->get();

            $answered_question_ids = $answered_questions_data->pluck('question_id');

            $answered_count = $answered_questions_data
                ->whereIn('question_id', Questions::whereIn('module_id', $modules->pluck('id'))->pluck('id'))
                ->count();

            $questions_count = Questions::whereIn('module_id', $modules->pluck('id'))->count();

            $total_questions = min($questions_count, 40);

            $remaining_questions = max(0, $total_questions - $answered_count);

            if($remaining_questions === 0){
                return redirect()->route('assessment.result', [
                    'type_of_assessment' => $type_of_assessment,
                    'type' => $request->to_take,
                    'subject_name' => str_replace(
                        ' ',
                        '_',
                        $subject_name
                    ),
                    'subject_id' => $request->subject_id,
                    'module_name' => 'none',
                    'module_id' => "0",
                ]);
            }

            $score = $answered_questions_data->where('is_correct', true)->count(); 


            $multipleChoiceQuestions = Questions::whereIn('module_id', $modules->pluck('id'))
                    ->whereNotIn('id', $answered_question_ids)
                    ->where('question_type', 'multipleChoice')
                    ->inRandomOrder()
                    ->take(20)
                    ->get();

                $trueOrFalseQuestions = Questions::whereIn('module_id', $modules->pluck('id'))
                    ->whereNotIn('id', $answered_question_ids)
                    ->where('question_type', 'TorF')
                    ->inRandomOrder()
                    ->take(10)
                    ->get();

                $identificationQuestions = Questions::whereIn('module_id', $modules->pluck('id'))
                    ->whereNotIn('id', $answered_question_ids)
                    ->where('question_type', 'identification')
                    ->inRandomOrder()
                    ->take(10)
                    ->get();

                $questions = $multipleChoiceQuestions
                    ->concat($trueOrFalseQuestions)
                    ->concat($identificationQuestions)
                    ->shuffle()
                    ->values();

            $choices = Choices::whereIn('question_id', $questions->pluck('id'))->get();

            $total_seconds = 90 * 60;

            $start = now();

            $student_attempt = StudentAttempts::firstOrCreate(
                [
                    'user_id' => auth()->id(),
                    'subject_id' => $subject_id,
                    'type_of_assessment' => 'exam',
                    'finished_at' => null,
                ],
                [
                    'started_at' => $start,
                    'ends_at' => $start->copy()->addSeconds($total_seconds),
                ]
            );
            $remaining_seconds = max(0, (int) now()->diffInSeconds($student_attempt->ends_at, false));

            

            return view(
                    'Client.Pages.Assessment',
                    compact(
                        'questions',
                        'choices',
                        'answered_count',
                        'answered_questions_data',
                        'module_id',
                        'module_name',
                        'subject_id',
                        'subject_name',
                        'score',
                        'remaining_seconds',
                        'total_seconds',
                        'type_of_assessment'
                    )
                );
        }


    }

    // =================================================================================================
    // 
    //  ██████╗ ███████╗████████╗ █████╗ ██╗  ██╗███████╗     █████╗ ███████╗███████╗███████╗███████╗███████╗███╗   ███╗███████╗███╗   ██╗████████╗
    //  ██╔══██╗██╔════╝╚══██╔══╝██╔══██╗██║ ██╔╝██╔════╝    ██╔══██╗██╔════╝██╔════╝██╔════╝██╔════╝██╔════╝████╗ ████║██╔════╝████╗  ██║╚══██╔══╝
    //  ██████╔╝█████╗     ██║   ███████║█████╔╝ █████╗      ███████║███████╗███████╗█████╗  ███████╗███████╗██╔████╔██║█████╗  ██╔██╗ ██║   ██║
    //  ██╔══██╗██╔══╝     ██║   ██╔══██║██╔═██╗ ██╔══╝      ██╔══██║╚════██║╚════██║██╔══╝  ╚════██║╚════██║██║╚██╔╝██║██╔══╝  ██║╚██╗██║   ██║
    //  ██║  ██║███████╗   ██║   ██║  ██║██║  ██╗███████╗    ██║  ██║███████║███████║███████╗███████║███████║██║ ╚═╝ ██║███████╗██║ ╚████║   ██║
    //  ╚═╝  ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝    ╚═╝  ╚═╝╚══════╝╚══════╝╚══════╝╚══════╝╚══════╝╚═╝     ╚═╝╚══════╝╚═╝  ╚═══╝   ╚═╝
    // 
    // =================================================================================================

    public function retakeAssessment(Request $request)
    {
        $validated = $request->validate([
            'type_of_assessment' => ['required', 'in:quiz,exam'],
            'type'               => ['nullable', 'string'],
            'subject_id'         => ['required', 'uuid', 'exists:subjects,id'],
            'module_id'          => ['required_if:type_of_assessment,quiz', 'nullable', 'uuid', 'exists:modules,id'],
        ]);
    
        $type_of_assessment = $validated['type_of_assessment'];
        $to_take = $validated['type'] ?? 'question_type';
    
        $subject = Subjects::findOrFail($validated['subject_id']);

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
    
        if ($type_of_assessment === 'quiz') {
    
            $module = Modules::findOrFail($validated['module_id']);
            $student_attempt = StudentAttempts::where('user_id', auth()->id())
                ->where('subject_id', $validated['subject_id'])
                ->where('module_id', $validated['module_id'])
                ->where('type_of_assessment', 'quiz')
                ->first();

            if ($student_attempt) {
                $start = now();

                $student_attempt->update([
                    'started_at' => $start,
                    'ends_at' => $start->copy()->addSeconds(
                        $type_of_assessment === 'quiz' ? 3600 : 5400
                    ),
                    'finished_at' => null,
                ]);

                $student_attempt->increment('attempts_count');
                $student_attempt->refresh();
            }
    
            AnsweredAssessmentQuestions::where('user_id', auth()->id())
                ->where('subject_id', $subject->id)
                ->where('module_id', $module->id)
                ->where('type_of_assessment', 'quiz')
                ->delete();
    
            $module_name = str_replace(' ', '_', $module->module_name);
            $module_id = $module->id;
    
        } else {
    
            AnsweredAssessmentQuestions::where('user_id', auth()->id())
                ->where('subject_id', $subject->id)
                ->whereNull('module_id')
                ->where('type_of_assessment', 'exam')
                ->delete();
    
            $module_name = 'none';
            $module_id = '0';
        }
    
        return response()->json([
            'success'  => true,
            'redirect' => route('assessment.taking', [
                'type_of_assessment' => $type_of_assessment,
                'to_take'            => $to_take,
                'subject_name'       => str_replace(' ', '_', $subject->subject_name),
                'subject_id'         => $subject->id,
                'module_name'        => $module_name,
                'module_id'          => $module_id,
            ]),
        ]);
    }


    // =================================================================================================
    // 
    //  ███████╗██╗   ██╗██████╗ ███╗   ███╗██╗████████╗    ██╗   ██╗███╗   ██╗ █████╗ ███╗   ██╗███████╗██╗    ██╗███████╗██████╗ ███████╗██████╗ 
    //  ██╔════╝██║   ██║██╔══██╗████╗ ████║██║╚══██╔══╝    ██║   ██║████╗  ██║██╔══██╗████╗  ██║██╔════╝██║    ██║██╔════╝██╔══██╗██╔════╝██╔══██╗
    //  ███████╗██║   ██║██████╔╝██╔████╔██║██║   ██║       ██║   ██║██╔██╗ ██║███████║██╔██╗ ██║███████╗██║ █╗ ██║█████╗  ██████╔╝█████╗  ██║  ██║
    //  ╚════██║██║   ██║██╔══██╗██║╚██╔╝██║██║   ██║       ██║   ██║██║╚██╗██║██╔══██║██║╚██╗██║╚════██║██║███╗██║██╔══╝  ██╔══██╗██╔══╝  ██║  ██║
    //  ███████║╚██████╔╝██████╔╝██║ ╚═╝ ██║██║   ██║       ╚██████╔╝██║ ╚████║██║  ██║██║ ╚████║███████║╚███╔███╔╝███████╗██║  ██║███████╗██████╔╝
    //  ╚══════╝ ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚═╝   ╚═╝        ╚═════╝ ╚═╝  ╚═══╝╚═╝  ╚═╝╚═╝  ╚═══╝╚══════╝ ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝╚══════╝╚═════╝
    // 
    // =================================================================================================



    
    
    public function submitUnanswered(Request $request)
    {
        $data = $request->validate([
            'subject_id'         => ['required', 'uuid', 'exists:subjects,id'],
            'module_id'          => ['required_if:type_of_assessment,quiz', 'nullable', 'uuid', 'exists:modules,id'],
            'type_of_assessment' => ['required', 'in:quiz,exam'],
            'question_ids'       => ['sometimes', 'array'],
            'question_ids.*'     => ['required', 'uuid', 'exists:questions,id'],
        ]);

        $subject = Subjects::findOrFail($data['subject_id']);
        $user_id = auth()->id();

        if ($data['type_of_assessment'] === 'quiz') {

            $module = Modules::where('id', $data['module_id'])
                ->where('subject_id', $subject->id)
                ->firstOrFail();

            $answered_ids = AnsweredAssessmentQuestions::where('user_id', $user_id)
                ->where('subject_id', $subject->id)
                ->where('module_id', $module->id)
                ->where('type_of_assessment', 'quiz')
                ->pluck('question_id');

            $unanswered = Questions::where('module_id', $module->id)
                ->whereIn('id', $data['question_ids'] ?? [])
                ->whereNotIn('id', $answered_ids)
                ->get(['id', 'answer', 'explanation']);

            DB::transaction(function () use ($unanswered, $subject, $module, $user_id) {

                foreach ($unanswered as $question) {

                    AnsweredAssessmentQuestions::create([
                        'user_id'            => $user_id,
                        'subject_id'         => $subject->id,
                        'module_id'          => $module->id,
                        'question_id'        => $question->id,
                        'type_of_assessment' => 'quiz',
                        'user_answer'        => 'Time`s Up',
                        'correct_answer'     => $question->answer,
                        'explanation'        => $question->explanation,
                        'is_correct'         => false,
                    ]);
                }
            });

            return redirect()->route('assessment.result', [
                'type_of_assessment' => 'quiz',
                'type'               => 'question_type',
                'subject_name'       => str_replace(' ', '_', $subject->subject_name),
                'subject_id'         => $subject->id,
                'module_name'        => str_replace(' ', '_', $module->module_name),
                'module_id'          => $module->id,
            ]);

        } elseif ($data['type_of_assessment'] === 'exam') {

            $module_ids = Modules::where('subject_id', $subject->id)
                ->pluck('id');

            $answered_ids = AnsweredAssessmentQuestions::where('user_id', $user_id)
                ->where('subject_id', $subject->id)
                ->whereNull('module_id')
                ->where('type_of_assessment', 'exam')
                ->pluck('question_id');

            $unanswered = Questions::whereIn('module_id', $module_ids)
                ->whereIn('id', $data['question_ids'] ?? [])
                ->whereNotIn('id', $answered_ids)
                ->get(['id', 'answer', 'explanation']);

            DB::transaction(function () use ($unanswered, $subject, $user_id) {

                foreach ($unanswered as $question) {

                    AnsweredAssessmentQuestions::create([
                        'user_id'            => $user_id,
                        'subject_id'         => $subject->id,
                        'module_id'          => null,
                        'question_id'        => $question->id,
                        'type_of_assessment' => 'exam',
                        'user_answer'        => 'Time`s Up',
                        'correct_answer'     => $question->answer,
                        'explanation'        => $question->explanation,
                        'is_correct'         => false,
                    ]);
                }
            });

            return redirect()->route('assessment.result', [
                'type_of_assessment' => 'exam',
                'type'               => 'question_type',
                'subject_name'       => str_replace(' ', '_', $subject->subject_name),
                'subject_id'         => $subject->id,
                'module_name'        => 'none',
                'module_id'          => '0',
            ]);
        }

        return redirect()->route('home');
    }



    
    // =================================================================================================
    // 
    //  ██████╗ ███████╗███████╗██╗   ██╗██╗  ████████╗    ██████╗  █████╗  ██████╗ ███████╗
    //  ██╔══██╗██╔════╝██╔════╝██║   ██║██║  ╚══██╔══╝    ██╔══██╗██╔══██╗██╔════╝ ██╔════╝
    //  ██████╔╝█████╗  ███████╗██║   ██║██║     ██║       ██████╔╝███████║██║  ███╗█████╗
    //  ██╔══██╗██╔══╝  ╚════██║██║   ██║██║     ██║       ██╔═══╝ ██╔══██║██║   ██║██╔══╝
    //  ██║  ██║███████╗███████║╚██████╔╝███████╗██║       ██║     ██║  ██║╚██████╔╝███████╗
    //  ╚═╝  ╚═╝╚══════╝╚══════╝ ╚═════╝ ╚══════╝╚═╝       ╚═╝     ╚═╝  ╚═╝ ╚═════╝ ╚══════╝
    // 
    // =================================================================================================

    public function resultPage(Request $request)
    {
        $type_of_assessment = $request->type_of_assessment;

        if ($type_of_assessment === 'quiz') {

            $module_quiz = ModuleQuiz::where('user_id', auth()->id())
                ->where('subject_id', $request->subject_id)
                ->where('module_id', $request->module_id)
                ->first();

            $module = Modules::findOrFail($request->module_id);
            $student_attempts = StudentAttempts::where('user_id', auth()->id())
                ->where('subject_id', $request->subject_id)
                ->where('module_id', $module->id)
                ->where('type_of_assessment', 'quiz')
                ->first();

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

            $assessment_points = $questions->whereIn('id', $answered_assessment_questions->where('is_correct', true)->pluck('question_id'))
                ->sum('points');

            $total_possible_score = (int) $answered_assessment_questions->count();

            

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
            $bonus_points = 0;
            $total_points = 0;
            if ($status === 'Passed') {

                
                // SUBJECT PROGRESS
                $subject_progress = SubjectProgress::where('user_id', auth()->id())
                    ->where('subject_id', $request->subject_id)
                    ->firstOrFail();

                $module_quizzes = ModuleQuiz::where('user_id', auth()->id())
                    ->where('subject_id', $request->subject_id)
                    ->get();

                $module = Modules::findOrFail($request->module_id);

                $total_modules = $module_quizzes->count();

                if ($total_modules === 0) {
                    return redirect()->route('home');
                }

                $module_weight = 80;
                $completed_modules = $module_quizzes->where('has_passed', true)->count();
                $has_coding = $module->has_coding;

                $percent_per_module = $module_weight / $total_modules;

                if (!$has_coding) {
                    $component_progress = $percent_per_module / 3;
                } else {
                    $component_progress = $percent_per_module / 4;
                }

                if ($request->type === 'coding') {

                    if (!$module_quiz->coding_passed) {
                        $module_quiz->update([
                            'coding_passed' => true
                        ]);

                        $subject_progress->progress += (float) $component_progress;
                        $subject_progress->save();
                    }

                } else {

                    if (!$module_quiz->questions_type_passed) {
                        $module_quiz->update([
                            'questions_type_passed' => true
                        ]);

                        $subject_progress->progress += (float) $component_progress;
                        $subject_progress->save();
                    }
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


                $leaderboard = Leaderboard::where('user_id', auth()->id())->first();
                
                if($student_attempts->attempts_count === 1 && $student_attempts->bonus_claimed === false){
                    Leaderboard::where('user_id', auth()->id())
                        ->increment(
                            'points',
                            30
                        );

                    $student_attempts->update([
                        'bonus_claimed' => true
                    ]);

                    $student_attempts->refresh();

                    $bonus_points = 30;
                }else{
                    $bonus_points = 0;
                }

                $total_points = $assessment_points + $bonus_points;

                $leaderboard->increment(
                    'points',
                    (int) $assessment_points
                );

                                
                if ($module_passed) {

                    $module_quiz->update([
                        'is_open' => false,
                        'has_passed' => true,
                        'scored' => 0
                    ]);                    

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
                $total_points = $assessment_points + $bonus_points;
                $module_quiz->update([
                    'scored' => 0
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
                    'section_score',
                    'assessment_points',
                    'bonus_points',
                    'total_points'
                )
            );
        }
        // ========================================================
        // EXAM
        // ========================================================
        elseif ($type_of_assessment === 'exam') {

            $modules = Modules::where('subject_id', $request->subject_id)->get();

            $student_attempts = StudentAttempts::where('user_id', auth()->id())
                ->where('subject_id', $request->subject_id)
                ->where('type_of_assessment', 'exam')
                ->first();

            $questions = Questions::whereIn('module_id', $modules->pluck('id'))
                ->whereIn('question_type', [
                    'multipleChoice',
                    'TorF',
                    'identification'
                ])->get();

            $question_ids = $questions->pluck('id');

            $answered_assessment_questions = AnsweredAssessmentQuestions::where('user_id', auth()->id())
                ->where('subject_id', $request->subject_id)
                ->whereNull('module_id')
                ->whereIn('question_id', $question_ids)
                ->where('type_of_assessment', 'exam')
                ->get();

            $assessment_points = $questions->whereIn('id', $answered_assessment_questions->where('is_correct', true)->pluck('question_id'))
                ->sum('points');

            $total_questions = min($questions->count(), 40);
            $answered_count = $answered_assessment_questions->count();

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


            $bonus_points = 0;
            $total_points = 0;
            if ($status === 'Passed') {

                $subject_progress = SubjectProgress::where('user_id', auth()->id())
                    ->where('subject_id', $request->subject_id)
                    ->firstOrFail();

                $subject_progress->update([
                    'progress' => 100,
                    'has_passed' => true
                ]);

                $leaderboard = Leaderboard::where('user_id', auth()->id())
                    ->first();

                if($student_attempts->attempts_count === 1 && $student_attempts->bonus_claimed === false){
                    Leaderboard::where('user_id', auth()->id())
                        ->increment(
                            'points',
                            50
                        );

                    $student_attempts->update([
                        'bonus_claimed' => true
                    ]);
                    $student_attempts->refresh();
                    $bonus_points = 50;
                }else{
                    $bonus_points = 0;
                }

                $total_points = $assessment_points + $bonus_points;

                $leaderboard->increment(
                    'points',
                    (int) $assessment_points
                );
            } else {
                $total_points = $assessment_points + $bonus_points;
                
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
                    'section_score',
                    'assessment_points',
                    'bonus_points',
                    'total_points'
                )
            );
        }

        return redirect()->route('home');
    }


    // =================================================================================================
    // 
    //  ███████╗██╗   ██╗██████╗ ███╗   ███╗██╗████████╗    █████╗ ███╗   ██╗███████╗██╗    ██╗███████╗██████╗
    //  ██╔════╝██║   ██║██╔══██╗████╗ ████║██║╚══██╔══╝   ██╔══██╗████╗  ██║██╔════╝██║    ██║██╔════╝██╔══██╗
    //  ███████╗██║   ██║██████╔╝██╔████╔██║██║   ██║      ███████║██╔██╗ ██║███████╗██║ █╗ ██║█████╗  ██████╔╝
    //  ╚════██║██║   ██║██╔══██╗██║╚██╔╝██║██║   ██║      ██╔══██║██║╚██╗██║╚════██║██║███╗██║██╔══╝  ██╔══██╗
    //  ███████║╚██████╔╝██████╔╝██║ ╚═╝ ██║██║   ██║      ██║  ██║██║ ╚████║███████║╚███╔███╔╝███████╗██║  ██║
    //  ╚══════╝ ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚═╝   ╚═╝      ╚═╝  ╚═╝╚═╝  ╚═══╝╚══════╝ ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
    // 
    // =================================================================================================

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

        // Use the shared normalizer for both quiz and exam grading.
        $is_correct = AnswerNormalizer::isCorrect($student_answer, $correct_answer);
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
}
