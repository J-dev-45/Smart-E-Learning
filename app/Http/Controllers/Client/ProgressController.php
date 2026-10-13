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
    public function scrollProgress(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'module_id' => 'required',
            'topic_id' => 'required',
            'topic_percent' => 'required|numeric|min:0|max:80',
        ]);

        $topicProgress = TopicProgress::where('user_id', auth()->id())
            ->where('subject_id', $request->subject_id)
            ->where('module_id', $request->module_id)
            ->where('topic_id', $request->topic_id)
            ->first();

        if (!$topicProgress) {
            return response()->json([
                'success' => false,
                'message' => 'Topic progress record not found.'
            ], 404);
        }

        $currentDatabaseProgress = (float) ($topicProgress->scroll_progress ?? 0);
        $currentTopicPercent = (float) $request->topic_percent;

        $databaseMilestone = floor($currentDatabaseProgress / 5) * 5;
        $topicMilestone = floor($currentTopicPercent / 5) * 5;

        if ($topicMilestone > $databaseMilestone) {
            $topicProgress->scroll_progress = $topicMilestone;
            $topicProgress->progress = $topicMilestone;
            $topicProgress->save();
        }

        return response()->json([
            'success' => true,
            'topic_progress' => $topicProgress->fresh()
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