<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $guarded = []; // Allow mass assignment
    protected $casts = [
    'is_active' => 'boolean',
    'data' => 'array', // Crucial for storing flexible content
];
}