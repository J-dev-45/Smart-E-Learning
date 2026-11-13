<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StudentRecord extends Model
{
    protected $fillable = [
        'id_number',
        'is_disabled',
    ];

    protected $casts = [
        'is_disabled' => 'boolean',
    ];

    /**
     * Get the registered user associated with this student ID.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id_number', 'id_number');
    }
}
