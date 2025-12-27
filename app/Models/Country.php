<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    // CASTS ARE MANDATORY FOR JSON/REPEATER FIELDS
    protected $casts = [
        'is_active' => 'boolean',
        'why_study' => 'array',
        'quick_stats' => 'array',
        'living_costs' => 'array',
        'requirements' => 'array',
        'visa_steps' => 'array', // <--- Ensure this is here
    ];

    public function universities(): HasMany
    {
        return $this->hasMany(University::class);
    }
}