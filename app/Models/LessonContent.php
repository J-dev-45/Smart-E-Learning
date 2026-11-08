<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class LessonContent extends Model
{
    use HasUuids;

    protected $fillable = [
        'topic_id',
        'content',
    ];

    public function topic()
    {
        return $this->belongsTo(Topics::class, 'topic_id');
    }
}