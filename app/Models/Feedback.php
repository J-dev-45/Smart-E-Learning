<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $fillable = [
        'user_id',
        'student_name',
        'question_id',
        'feedback_message',
        'replied_by',
        'reply_message',
        'status'
    ];
}
