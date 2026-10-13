<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleQuiz extends Model
{
    protected $table = 'module_quiz';
    protected $fillable = [
        'user_id',
        'subject_id',
        'module_id',
        'is_open',
        'has_passed',
        'questions_type_passed',
        'coding_passed',
        'scored',
        'updated_at'
    ];
}
