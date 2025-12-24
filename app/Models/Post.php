<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected $casts = [
        'published_at' => 'date',
    ];

    public function author()
    {
        // Assuming your posts table has 'user_id' or 'author_id'
        // If your column is 'created_by', change 'user_id' to 'created_by'
        return $this->belongsTo(User::class, 'user_id'); 
    }
}