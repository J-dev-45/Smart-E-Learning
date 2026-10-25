<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttempts extends Model
{
    protected $table = 'student_attempts';
    protected $fillable = [
        'user_id',
        'subject_id',
        'module_id',
        'type_of_assessment',
        'attempts_count',
        'started_at',
        'ends_at',
        'finished_at'
    ];
}
