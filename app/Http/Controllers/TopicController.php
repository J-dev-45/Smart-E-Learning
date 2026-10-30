<?php

namespace App\Http\Controllers;

use App\Models\RecentActivity;
use App\Models\Topics;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    public function addTopic(Request $request){
        $input = $request->validate([
            'module_id' => 'required|uuid',
            'topic_name' => 'required|string|max:255'
        ]);

        $maxOrder = Topics::where('module_id', $input['module_id'])->max('order');
        $nextOrder = is_null($maxOrder) ? 1 : $maxOrder + 1;
        $topics = Topics::create([
            'order' => $nextOrder,
            'module_id' => $input['module_id'],
            'topic_name' => $input['topic_name'],
            'slug' => 'topic-'. Str::slug($input['topic_name'])
        ]);

        RecentActivity::create([
            'name' => auth()->user()->name,
            'action' => 'added_topic',
            'module' => $request->module_name,
            'topic' => $input['topic_name']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Topic added Successfully',
            'new_topics' => $topics
        ]);

    }


    public function editTopic(Request $request){
        $input = $request->validate([
            'new_topic_name' => 'required|string|max:255'
        ]);
        $topic = Topics::find($request->topic_id);

        $topic->update([
            'topic_name' => $input['new_topic_name'],
            'slug' => 'topic-'. Str::slug($input['new_topic_name'])
        ]);

        RecentActivity::create([
            'name' => auth()->user()->name,
            'action' => 'edited_topic',
            'subject' => $request->subject_name,
            'topic' => $input['new_topic_name']
        ]);

        return response()->json([
            'success'=> true,
            'message'=> 'Topic updated successfully!'
        ]);
    }
}
