<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Choices;
use App\Models\Modules;
use App\Models\Questions;
use App\Models\Subjects;
use Illuminate\Http\Request;

class QuestionsPage extends Controller
{
    public function questions(Request $request)
    {
        $questionColumns = [
            'id',
            'module_id',
            'question',
            'question_type',
            'answer',
            'explanation',
        ];

        $toView = $request->to_view;
        $subjectId = $request->subject_id;
        $moduleId = $request->module_id;

        $subject_name = Subjects::where('id', $subjectId)
            ->value('subject_name');

        $module_name = 'All';
        $topic_name = 'All';

        $subjects = Subjects::select([
            'id',
            'subject_name',
            'slug',
        ])->get();

        $modules = Modules::select([
            'id',
            'order',
            'subject_id',
            'module_name',
        ])->get();

        $questionsQuery = Questions::select($questionColumns);

        switch ($toView) {
            case 'view-subject-questions':
                $moduleIds = Modules::where('subject_id', $subjectId)
                    ->pluck('id');

                $questionsQuery->whereIn('module_id', $moduleIds);

                $moduleId = '0';
                $module_name = 'All';
                $topic_name = 'All';
                break;

            case 'view-module-questions':
                $module = Modules::select([
                    'id',
                    'module_name',
                ])->find($moduleId);

                if ($module) {
                    $module_name = $module->module_name;
                }

                $questionsQuery->where('module_id', $moduleId);

                $topic_name = 'All';
                break;

            default:
                $questionsQuery->whereRaw('1 = 0');
                break;
        }

        $questions = $questionsQuery->get();

        $choices = $questions->isNotEmpty()
            ? Choices::whereIn(
                'question_id',
                $questions->pluck('id')
            )->get()
            : collect();

        return view('Admin.Pages.Questions', compact(
            'moduleId',
            'subject_name',
            'module_name',
            'topic_name',
            'subjects',
            'modules',
            'questions',
            'choices'
        ));
    }
}