<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'subtitle', 'description', 
        'image_path', 'button_text', 'button_link', 
        'sort_order', 'is_active'
    ];

    // Scope to easily get active sliders in order
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order', 'asc');
    }
}