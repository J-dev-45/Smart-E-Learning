<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleProgress extends Model
{
    protected $table = 'module_progress';
    protected $fillable = [
        'user_id',
        'subject_id',
        'module_id',
        'status',
        'progress',
        'has_passed',
    ];
}
