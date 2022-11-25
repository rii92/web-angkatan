<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulationsTime extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'start_time'  => 'datetime:Y-m-d\TH:i',
        'end_time'  => 'datetime:Y-m-d\TH:i'
    ];

    public function simulation()
    {
        return $this->belongsTo(Simulations::class, 'simulations_id');
    }

    public function user()
    {
        return $this->hasMany(UserFormations::class, 'session_id');
    }
}
