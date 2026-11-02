<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AnsweredAssessmentQuestions;
use App\Models\Choices;
use App\Models\ModuleQuiz;
use App\Models\Modules;
use App\Models\PretestSavedCodes;
use App\Models\Questions;
use App\Models\StudentAttempts;
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
        
        $subject_name = Subjects::where('id', $subject_id)
                ->value('subject_name');

        if($request->type_of_assessment === 'quiz'){
            
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
                $questions = Questions::where('module_id', $request->module_id)
                    ->whereNotIn('id', $answered_question_ids)
                    ->whereIn('question_type', ['multipleChoice', 'TorF', 'identification'])
                    ->inRandomOrder()
                    ->limit($remaining_questions)
                    ->get();

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
                    ->limit($remaining_questions)
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

            $questions = Questions::whereIn('module_id', $modules->pluck('id'))
                ->whereNotIn('id', $answered_question_ids)
                ->whereIn('question_type', ['multipleChoice', 'TorF', 'identification'])
                ->inRandomOrder()
                ->limit($remaining_questions)
                ->get();

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

    // ========================================================================================================================================
    // ========================================================================================================================================
    // ========================================================================================================================================
    // ========================================================================================================================================
    // ========================================================================================================================================
    // ========================================================================================================================================

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


    // ========================================================================================================================================
    // ========================================================================================================================================
    // ========================================================================================================================================
    // ========================================================================================================================================
    // ========================================================================================================================================
    // ========================================================================================================================================



    public function submitUnanswered(Request $request)
    {
        $data = $request->validate([
            'subject_id'         => ['required', 'uuid', 'exists:subjects,id'],
            'module_id'          => ['required_if:type_of_assessment,quiz', 'nullable', 'uuid', 'exists:modules,id'],
            'type_of_assessment' => ['required', 'in:quiz,exam'],
            'question_ids' => ['required', 'array'],
            'question_ids.*' => ['required', 'string'],
        ]);

        $subject = Subjects::find($data['subject_id']);

        if($data['type_of_assessment'] === 'quiz'){

            $module = Modules::find($data['module_id']);
            $answered_ids = AnsweredAssessmentQuestions::where('user_id', auth()->id())
                ->where('subject_id', $data['subject_id'])
                ->where('module_id', $data['module_id'])
                ->where('type_of_assessment', 'quiz')
                ->pluck('question_id');

            $unanswered = Questions::whereIn('id', $data['question_ids'])->select('id', 'answer', 'explanation')->get();

            DB::transaction(function () use ($unanswered, $data, $subject, $module) {
                foreach ($unanswered as $question) {
                    AnsweredAssessmentQuestions::create([
                        'user_id' => auth()->id(),
                        'subject_id' => $subject->id,
                        'module_id' => $module->id,
                        'question_id' => $question->id,
                        'type_of_assessment' => 'quiz',
                        'user_answer' => 'Time`s Up',
                        'correct_answer' => $question->answer,
                        'explanation' => $question->explanation,
                        'is_correct' => false,
                    ]);
                }
            });

            return redirect()->route('assessment.result', [
                'type_of_assessment' => $data['type_of_assessment'],
                'type'               => 'question_type',
                'subject_name'       => str_replace(' ', '_', $subject->subject_name),
                'subject_id'         => $data['subject_id'],
                'module_name'        => str_replace(' ', '_', $module->module_name),
                'module_id'          => $data['module_id'],
            ]);
        }elseif($data['type_of_assessment'] === 'exam'){

            $answered_ids = AnsweredAssessmentQuestions::where('user_id', auth()->id())
                ->where('subject_id', $data['subject_id'])
                ->where('type_of_assessment', 'exam')
                ->pluck('question_id');

            $unanswered = Questions::whereIn('id', $data['question_ids'])->select('id', 'answer', 'explanation')->get();

            DB::transaction(function () use ($unanswered, $data, $subject, $module) {
                foreach ($unanswered as $question) {
                    AnsweredAssessmentQuestions::create([
                        'user_id' => auth()->id(),
                        'subject_id' => $subject->id,
                        'module_id' => null,
                        'question_id' => $question->id,
                        'type_of_assessment' => 'exam',
                        'user_answer' => 'Time`s Up',
                        'correct_answer' => $question->answer,
                        'explanation' => $question->explanation,
                        'is_correct' => false,
                    ]);
                }
            });


            return redirect()->route('assessment.result', [
                'type_of_assessment' => $data['type_of_assessment'],
                'type'               => 'question_type',
                'subject_name'       => str_replace(' ', '_', $subject->subject_name),
                'subject_id'         => $data['subject_id'],
                'module_name'        => 'none',
                'module_id'          => '0',
            ]);

        }
    }
}
