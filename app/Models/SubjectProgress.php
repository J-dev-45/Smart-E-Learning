<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectProgress extends Model
{
    protected $table = 'subject_progress';
    protected $fillable = [
        'user_id',
        'subject_id',
        'progress',
        'has_passed',
    ];
}
