<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleStarted extends Model
{
    protected $table = 'module_started';
    protected $fillable = [
        'user_id',
        'module_id'
    ];
}
