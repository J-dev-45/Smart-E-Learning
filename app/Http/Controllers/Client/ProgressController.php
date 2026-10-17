<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AnsweredTopicPretest;
use App\Models\ModuleProgress;
use App\Models\Questions;
use App\Models\SubjectProgress;
use App\Models\TopicProgress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    
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




    // TOPIC PRETEST PROGRESS 
    public function topicPretest(Request $request){

        $topic_progress = TopicProgress::where('user_id', auth()->id())
            ->where('topic_id',$request->topicProgress_id)
            ->first();
        
        $module_progress = ModuleProgress::where('user_id', auth()->id())
            ->where('module_id', $topic_progress->module_id)
            ->first();
        
        $subject_progress = SubjectProgress::where('user_id', auht()->id())
            ->where('subject_id', $topic_progress->subject_id)
            ->first();
        

        foreach($request->answers as $question_id => $answer){
            $question = Questions::find('id', $question_id);

            AnsweredTopicPretest::create([
                'user_id' => auth()->id(),
                'user_answer' =>  $answer
            ]);

            if($questions->answer === $answer){
                $topic_progress->increment('question_score');
            }
        }

        $passing_percent = 70;
        $passing_score = $request->answers->length() * ($passing_percent/100);

        if($topic_progress->question_score >= $passing_score){
            if($topic_progress->progress === 80){
                $topic_progress->update([
                    'progress' => $topic_progress->progress + 20,
                    'has_passed' => true
                ]);
            }

            return response()->json([
                'success' => true,
                'Failed' => false
            ]);
        }else{
            return response()->json([
                'success' => true,
                'Failed' => true
            ]);
        }

        
    }



    public function retakeTopicPretest(Request $request){
        foreach($request->answers as $question_id => $answers){
            $answeredQuestions = AnsweredTopicPretest::find('question_id', $question_id);
            $answeredQuestions->delete();
        }


        return response()->json([
            'success' => true,

        ]);
    }
}