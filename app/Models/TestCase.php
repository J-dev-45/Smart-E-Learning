<?php

namespace App\Models;

use App\Models\Questions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestCase extends Model
{
    protected $fillable = [
        'question_id',
        'scanner_input',
        'expected_output',
        'test_case_order',
        'is_hidden',
    ];

    protected $casts = [
    'is_hidden' => 'boolean',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Questions::class);
    }
}