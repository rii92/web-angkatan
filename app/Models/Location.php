<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'full_location'
    ];

    public function getFullLocationAttribute()
    {
        return $this->kabupaten . ", " . $this->provinsi;
    }
}
