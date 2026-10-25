<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnsweredAssessmentQuestions extends Model
{
    protected $table = 'answered_assessment_questions';
    protected $fillable = [
        'user_id',
        'subject_id',
        'module_id',
        'question_id',
        'type_of_assessment',
        'user_answer',
        'correct_answer',
        'explanation',
        'is_correct'
    ];
}
