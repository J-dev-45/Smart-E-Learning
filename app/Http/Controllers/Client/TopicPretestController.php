<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AnsweredTopicPretest;
use App\Models\ModuleProgress;
use App\Models\Questions;
use App\Models\SubjectProgress;
use App\Models\TopicProgress;
use Illuminate\Http\Request;

class TopicPretestController extends Controller
{
    public function submitTopicPretest(Request $request){
        $topic_progress = TopicProgress::where('user_id', auth()->id())
            ->where('topic_id',$request->topicProgress_id)
            ->first();
        
        $module_progress = ModuleProgress::where('user_id', auth()->id())
            ->where('module_id', $topic_progress->module_id)
            ->first();
        
        $subject_progress = SubjectProgress::where('user_id', auht()->id())
            ->where('subject_id', $topic_progress->subject_id)
            ->first();
        

        foreach($request->answers as $ans){
            $question = Questions::find('id', $ans->id);

            if($questions->answer === $ans->answer){
                $topic_progress->increment('question_score');
                AnsweredTopicPretest::create([
                    'user_id' => auth()->id(),
                    'user_answer' =>  $ans->answer
                ]);
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
}
