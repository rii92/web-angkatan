<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satker extends Model
{
    use HasFactory;

    protected $table = 'satkers';

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
