<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPermit extends Model
{
    use HasFactory;

    protected $guarded = [];

    // THIS IS THE FIX
    protected $casts = [
        'is_active' => 'boolean',
        'process_steps' => 'array', // Casts the Repeater data to JSON
        'faqs' => 'array',          // Casts the FAQ data to JSON
        'gallery' => 'array',       // Casts the Gallery images to JSON
        'permit_types' => 'array',
        'sectors' => 'array',
    ];
}