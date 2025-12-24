<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $guarded = [];

    // Validates that this item has children
    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('sort_order');
    }

    // Validates if this item is a child
    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }
}