<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    // Relationship: A course belongs to a University
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    // Relationship: A course belongs to a Category (e.g., Subject Area)
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}