<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $guarded = [];

    // Helper to check if position is open
    public function scopeOpen($query)
    {
        return $query->where('is_active', true)->where('is_filled', false);
    }
}