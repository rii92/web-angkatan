<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFormations extends Model
{
    use HasFactory;

    protected $table = 'users_formations';
    protected $guarded = [];

    protected $dates = [
        'satker_final_updated_at',
        'user_selection_at'
    ];

    public function getBasedOnAttribute($value)
    {
        return strtoupper($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function satker1()
    {
        return $this->belongsTo(Satker::class, "satker_1");
    }

    public function satker2()
    {
        return $this->belongsTo(Satker::class, "satker_2");
    }

    public function satker3()
    {
        return $this->belongsTo(Satker::class, "satker_3");
    }

    public function satkerfinal()
    {
        return $this->belongsTo(Satker::class, "satker_final");
    }

    public function simulasi()
    {
        return $this->belongsTo(Simulations::class);
    }

    public function session_time()
    {
        return  $this->belongsTo(SimulationsTime::class, 'session_id');
    }
}
