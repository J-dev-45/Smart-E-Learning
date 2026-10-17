<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnsweredModuleQuestions extends Model
{
    protected $table = 'answered_module_questions';
    protected $fillable = [
        'user_id',
        'module_id',
        'question_id',
        'user_answer',
        'correct_answer',
        'explanation',
    ];
}
