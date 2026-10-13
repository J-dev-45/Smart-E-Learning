<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AnsweredQuestions;
use App\Models\ModuleQuiz;
use App\Models\Modules;
use App\Models\ModuleStarted;
use App\Models\Questions;
use App\Models\Subjects;
use App\Models\SubjectStarted;
use App\Models\Topics;
use Illuminate\Http\Request;

class LearnController extends Controller
{

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

        return view(
            'Client.Pages.Quiz_Modules',
            compact(
                'subject',
                'user_modules',
                'modules',
                'topics',
                'subject_id',
                'answered_questions',
                'questions'
            )
        );
    }

    public function learnModule(Request $request){
        $subject = Subjects::where('id', $request->subject_id)->firstOrFail();
        $module = Modules::where('id', $request->module_id)->firstOrFail();
        $topics = Topics::where('module_id', $module->id)->get();

        $module_already_started = ModuleStarted::where('module_id', $module->id)->exists();

        if(!$module_already_started){
            ModuleStarted::create([
                'user_id' => auth()->id(),
                'module_id' => $module->id
            ]);
        }

        switch($subject->subject_name){

            case "Discrete Mathematics":
                return view('Client.Review_Pages.Discrete_Mathematics',compact(
                    'module',
                    'topics'
                ));
                break;

        }

    }

    public function quizzes(Request $request){

        $subject = Subjects::find('id', $request->subject_id);

        $modules = Modules::where('subject_id', $subject->id)
            ->orderBy('order', 'asc')
            ->get();

        $subject_name = $subject->subject_name;

        $user_modules = ModuleQuiz::select('module_quiz.*')
            ->join('modules', 'module_quiz.module_id', '=', 'modules.id')
            ->where('module_quiz.user_id', auth()->id())
            ->where('module_quiz.subject_id', $request->subject_id)
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
                'subject_name',
                'user_modules',
                'modules',
                'subject_id',
                'answered_questions',
                'questions'
            )
        );
    }
}
