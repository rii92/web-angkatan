<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulationsTime extends Model
{
    use HasFactory;

    public function simulation()
    {
        return $this->belongsTo(Simulations::class);
    }
}
