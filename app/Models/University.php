<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class University extends Model
{
    protected $guarded = [];

    // Relationship: A University belongs to a Country
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    // Relationship: A University has many Courses
    // (This is the part you were missing)
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}