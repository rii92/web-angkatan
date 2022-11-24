<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFormations extends Model
{
    use HasFactory;

    protected $table = 'users_formations';
    protected $guarded = [];

    public function getBasedOnAttribute($value)
    {
        return strtoupper($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function satker_1()
    {
        return $this->belongsTo(Satker::class, "satker_1");
    }

    public function satker_2()
    {
        return $this->belongsTo(Satker::class, "satker_2");
    }

    public function satker_3()
    {
        return $this->belongsTo(Satker::class, "satker_3");
    }

    public function satker_final()
    {
        return $this->belongsTo(Satker::class, "satker_final");
    }

    public function simulasi()
    {
        return $this->belongsTo(Simulations::class);
    }

    public function session()
    {
        return  $this->belongsTo(SimulationsTime::class, 'session_id');
    }
}
