<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'published_at'
    ];

    protected $casts = [
        'published_at'  => 'datetime:Y-m-d\TH:i'
    ];
}
