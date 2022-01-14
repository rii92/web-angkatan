<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SambatVote extends Model
{
    use HasFactory;

    public function sambat()
    {
        return $this->belongsTo(Sambat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}