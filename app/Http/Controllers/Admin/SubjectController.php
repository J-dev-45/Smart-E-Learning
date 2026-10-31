<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modules;
use App\Models\Questions;
use App\Models\RecentActivity;
use App\Models\Subjects;
use App\Models\Topics;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubjectController extends Controller
{

    public function subjectPage(Request $request){
        $subject = Subjects::find($request->subject_id);

        $subject_id = $subject->id;
        $subject_name = $subject->subject_name;

        $modules = Modules::where('subject_id', $subject->id)
            ->orderBy('order', 'asc')
            ->get();
        $topics = Topics::whereIn('module_id', $modules->pluck('id'))
            ->orderBy('order', 'asc')
            ->get();
        $questions = Questions::whereIn('module_id', $modules->pluck('id'))->get();

        return view('Admin.Pages.Modules', compact(
            'subject_id',
            'subject_name',
            'modules',
            'topics',
            'questions'
        ));

    }

    public function addSubject(Request $request){

        $validated = $request->validate([
            'subject_name' => 'required|string|max:100',
            'subject_code' => 'required|string|max:10',
        ]);

        $max_order = Subjects::max('order');
        $next_order = is_null($max_order) ? 1 : $max_order + 1; 

        $subjects = Subjects::create([
            'subject_name' => $validated['subject_name'],
            'subject_code' => $validated['subject_code'],
            'slug' => Str::slug($validated['subject_name']),
            'order' => $next_order
        ]);

        RecentActivity::create([
            'name' => auth()->user()->name,
            'action' => 'added_subject',
            'subject' => $validated['subject_name']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Subject added successfully',
            'subject' => $subjects
        ]);

    }


    public function editSubject(Request $request){
        $input = $request->validate([
            'new_subject_name' => 'required|string|max:255',
            'new_subject_code' => 'required|string|max:10',
        ]);
        $subject = Subjects::find($request->subject_id);

        $subject->update([
            'subject_name' => $input['new_subject_name'],
            'subject_code' => $input['new_subject_code'],
            'slug' => Str::slug($input['new_subject_name'])
        ]);

        RecentActivity::create([
            'name' => auth()->user()->name,
            'action' => 'edited_subject',
            'subject' => $request->subject_name,
            'subject' => $input['new_subject_name']
        ]);

        return response()->json([
            'success'=> true,
            'message'=> 'Subject updated successfully!'
        ]);
    }



    public function deleteSubject(Request $request)
    {
        $subject = Subjects::find($request->subject_id);

        if (!$subject) {
            return response()->json([
                'success' => false,
                'message' => 'subject not found!'
            ], 444);
        }

        $subjectName = $subject->subject_name;
        $subjectId = $subject->id;

        $subject->delete();

        RecentActivity::create([
            'name' => auth()->user()->name,
            'action' => 'deleted_subject',
            'subject' => $request->subject_name,
            'subject' => $subjectName
        ]);

        return response()->json([
            'success' => true,
            'message' => 'subject deleted Successfully!',
            'deleted_subject_id' => $subjectId
        ]);
    }
}
