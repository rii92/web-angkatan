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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'full_name'
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

    public function formation_1()
    {
        return $this->hasMany(UserFormations::class, "satker_1");
    }

    public function formation_2()
    {
        return $this->hasMany(UserFormations::class, "satker_2");
    }

    public function formation_3()
    {
        return $this->hasMany(UserFormations::class, "satker_3");
    }

    public function formation_final()
    {
        return $this->hasMany(UserFormations::class, "satker_final");
    }

    public function getFullNameAttribute()
    {
        return $this->kode_wilayah . " - " . $this->name;
    }
}
