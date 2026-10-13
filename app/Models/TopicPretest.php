<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicPretest extends Model
{
    protected $table = 'topic_pretest';
    protected $fillable = [
        'user_id',
        'subject_id',
        'module_id',
        'topic_id',
        'has_passed'
    ];
}
