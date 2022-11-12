<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satker extends Model
{
    use HasFactory;

    protected $table = 'satkers';

    protected $attributes = [
        'se_formation' => 0,
        'sk_formation' => 0,
        'si_formation' => 0,
        'sd_formation' => 0,
        'd3_formation' => 0,
        'ks_formation' => 0,
        'st_formation' => 0,
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
