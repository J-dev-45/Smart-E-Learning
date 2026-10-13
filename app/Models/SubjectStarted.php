<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectStarted extends Model
{
    protected $table = 'subject_started';
    protected $fillable = [
        'user_id',
        'subject_id',
        'has_passed'
    ];
}
