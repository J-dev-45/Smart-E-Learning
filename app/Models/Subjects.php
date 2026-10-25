<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $table = 'subjects';
    use HasUuids;
    protected $fillable = [
        'order',
        'subject_name',
        'subject_code',
        'slug'
    ];
}
