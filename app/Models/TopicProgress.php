<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicProgress extends Model
{
    protected $table = 'topic_progress';
    protected $fillable = [
        'user_id',
        'subject_id',
        'module_id',
        'topic_id',
        'scroll_progress',
        'question_score',
        'progress',
        'has_passed',
    ];
}
