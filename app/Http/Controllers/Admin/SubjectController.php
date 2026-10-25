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

        $modules = Modules::where('subject_id', $subject->id)->get();
        $topics = Topics::whereIn('module_id', $modules->pluck('id'))->get();
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
}
