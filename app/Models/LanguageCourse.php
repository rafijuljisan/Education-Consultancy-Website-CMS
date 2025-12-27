<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageCourse extends Model
{
    protected $guarded = [];

    protected $casts = [
    'is_active' => 'boolean',
    'certificate_available' => 'boolean', // Cast to boolean
    'start_date' => 'date',               // Cast to Carbon date instance
    'benefits' => 'array',
    'variants' => 'array',
    'features' => 'array',
    'course_testimonials' => 'array',
    'faqs' => 'array',
];
}