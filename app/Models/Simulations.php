<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulations extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function times()
    {
        return $this->hasMany(SimulationsTime::class);
    }

    public function users_formation()
    {
        return $this->hasMany(UserFormations::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($simulation) {
            $simulation->users_formation()->delete();
            $simulation->times()->delete();
        });
    }
}
