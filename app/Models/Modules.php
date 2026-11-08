<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    use HasUuids;
    protected $table = 'modules';
    protected $fillable = [
        'order',
        'subject_id',
        'module_name',
        'description',
        'has_coding',
        'has_question_type'
    ];
}
