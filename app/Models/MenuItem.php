<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'label',
        'url',
        'parent_id',
        'sort_order',
        'new_tab',
        'is_active',
        // Add these:
        'link_source',
        'page_route',
        'country_id',
        'service_id',
    ];
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
    protected static function booted()
    {
        static::creating(function ($model) {
            if (is_null($model->sort_order)) {
                $model->sort_order = 0;
            }
        });
    }
}