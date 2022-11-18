<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satker extends Model
{
    use HasFactory;

    protected $table = 'satkers';

    protected $attributes = [
        'se' => 0,
        'sk' => 0,
        'si' => 0,
        'sd' => 0,
        'd3' => 0,
        'ks' => 0,
        'st' => 0,
    ];

    /**
    * 1 on 1 realationship to Location model
    *
    * @var array
    */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
