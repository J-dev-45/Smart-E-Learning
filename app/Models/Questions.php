<?php

namespace App\Models;

use App\Models\TestCase;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasUuids;
    protected $table = 'questions';
    protected $fillable = [
        'module_id',
        'question',
        'question_type',
        'answer',
        'explanation',
        'points',
        'updated_at'
    ];

    public function testCases()
    {
        return $this->hasMany(TestCase::class, 'question_id', 'id')
            ->orderBy('test_case_order');
    }
}
