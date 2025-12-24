<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    // Allow all fields to be saved
    protected $guarded = []; 

    // Define the relationship back to the Career model
    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }
}