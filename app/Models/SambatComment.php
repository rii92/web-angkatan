<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SambatComment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userdetails()
    {
        return $this->hasOne(UserDetails::class, 'user_id', 'user_id');
    }

    public function sambat()
    {
        return $this->belongsTo(Sambat::class);
    }
}
