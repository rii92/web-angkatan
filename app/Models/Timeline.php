<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'start_date'  => 'date:Y-m-d',
        'end_date'  => 'date:Y-m-d'
    ];
}
