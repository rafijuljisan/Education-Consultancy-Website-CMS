<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'flag_image',
        'cover_image',
        'short_description',
        'details',
        'why_study',
        'quick_stats',
        'living_costs',
        'requirements',
        'visa_info',
        'work_permit_info',
        'visa_steps',
        'is_active',
    ];

    /**
     * Cast JSON fields to arrays automatically
     */
    protected $casts = [
        'why_study' => 'array',
        'quick_stats' => 'array',
        'living_costs' => 'array',
        'requirements' => 'array',
        'visa_steps' => 'array',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Default values for JSON fields
     */
    protected $attributes = [
        'why_study' => '[]',
        'quick_stats' => '[]',
        'living_costs' => '[]',
        'requirements' => '[]',
        'visa_steps' => '[]',
        'is_active' => true,
    ];

    /**
     * Relationship: Country has many Universities
     */
    public function universities(): HasMany
    {
        return $this->hasMany(University::class);
    }

    /**
     * Scope: Only active (published) countries
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Featured countries (with universities)
     */
    public function scopeFeatured($query)
    {
        return $query->active()
            ->has('universities')
            ->withCount('universities')
            ->orderBy('universities_count', 'desc');
    }

    /**
     * Helper: Check if country has complete information
     */
    public function isComplete(): bool
    {
        return !empty($this->details) 
            && !empty($this->short_description)
            && count($this->why_study ?? []) > 0
            && count($this->quick_stats ?? []) > 0;
    }

    /**
     * Helper: Get primary stats for display (first 3)
     */
    public function getPrimaryStatsAttribute()
    {
        return collect($this->quick_stats)->take(3);
    }

    /**
     * Helper: Check if has visa information
     */
    public function hasVisaInfo(): bool
    {
        return !empty($this->visa_info) 
            || !empty($this->visa_steps)
            || !empty($this->requirements);
    }
}