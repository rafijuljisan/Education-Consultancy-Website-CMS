<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Scholarship extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'deadline' => 'date',
        'benefits' => 'array',
        'requirements' => 'array',
        'documents' => 'array',
        'application_process' => 'array', // Steps
        'timeline' => 'array',            // Key Dates
        'faqs' => 'array',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}