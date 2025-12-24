<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'subject',
        'country',
        'name',
        'email',
        'phone',
        'ielts_score',
        'message',
        'is_read'
    ];
}
