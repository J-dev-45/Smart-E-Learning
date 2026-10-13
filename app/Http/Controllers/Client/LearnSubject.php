<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ModuleProgress;
use App\Models\Modules;
use App\Models\Questions;
use App\Models\SubjectProgress;
use App\Models\Subjects;
use App\Models\TopicProgress;
use App\Models\Topics;
use Illuminate\Http\Request;

class LearnSubject extends Controller
{
    public function subjectLearn(Request $request)
    {
        $subject = Subjects::findOrFail($request->subject_id);

        $modules = Modules::where('subject_id', $subject->id)
            ->orderBy('order')
            ->get();

        $topics = Topics::whereIn('module_id', $modules->pluck('id'))
            ->orderBy('order')
            ->get();

        
        
        // PROGRESSES
        $subject_prog = SubjectProgress::where('user_id', auth()->id())
            ->where('subject_id', $subject->id)->exists();

        $existing_moduleIds = ModuleProgress::where('user_id', auth()->id())
            ->where('subject_id', $subject->id)
            ->pluck('module_id');

        $modules_to_add = Modules::where('subject_id', $subject->id)
            ->whereNotIn('id', $existing_moduleIds)
            ->orderBy('order', 'asc')
            ->get();

        $existing_topicIds = TopicProgress::where('user_id', auth()->id())
            ->where('subject_id', $subject->id)
            ->whereIn('module_id', $modules->pluck('id'))
            ->pluck('topic_id');
        $topics_to_add = Topics::whereIn('module_id', $modules->pluck('id'))
            ->whereNotIn('id', $existing_topicIds)
            ->orderBy('order', 'asc')
            ->get();

        if(!$subject_prog){
            SubjectProgress::updateOrCreate([
                'user_id' => auth()->id(),
                'subject_id' => $subject->id
            ]);
        }

        $hasOpenModule = ModuleProgress::where('user_id', auth()->id())
            ->where('subject_id', $subject->id)
            ->where('status', 'open')
            ->exists();

        foreach($modules_to_add as $index => $module){
            $status = (!$hasOpenModule && $index === 0) ? 'open' : 'locked';
            ModuleProgress::create([
                'user_id' => auth()->id(),
                'subject_id' => $subject->id,
                'module_id' => $module->id,
                'status' => $status
            ]);
        }
        

        foreach($topics_to_add as $topic){
            TopicProgress::create([
                'user_id' => auth()->id(),
                'subject_id' => $subject->id,
                'module_id' => $topic->module_id,
                'topic_id' => $topic->id,
            ]);
        }

        

        $subject_name = $subject->subject_name;
        $subject_id = $subject->id;

        $subject_progresses = SubjectProgress::where('user_id', auth()->id())
            ->where('subject_id', $subject_id)
            ->get();
        $module_progresses = ModuleProgress::where('user_id', auth()->id())
            ->where('subject_id', $subject->id)
            ->get();
        
        $topic_progresses = TopicProgress::where('user_id', auth()->id())
            ->whereIn('module_id', $module_progresses->pluck('module_id'))
            ->get();

        if ($subject->subject_name === 'Discrete Mathematics') {

            $questions = Questions::whereIn('topic_id', $topics->pluck('id'))
                ->where('question_type', 'identification')
                ->inRandomOrder()
                ->get()
                ->groupBy('topic_id');

            return view(
                'Client.Review_Pages.Discrete_Mathematics.Discrete_Mathematics',
                compact(
                    'subject_name',
                    'subject_id',
                    'modules',
                    'topics',
                    'questions',
                    'subject_progresses',
                    'module_progresses',
                    'topic_progresses'
                )
            );
        }

        abort(404);
    }
}