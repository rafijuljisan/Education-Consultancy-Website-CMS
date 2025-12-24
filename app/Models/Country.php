<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $guarded = [];

    // ADD THIS FUNCTION
    public function universities(): HasMany
    {
        return $this->hasMany(University::class);
    }
}