<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SambatVote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sambat()
    {
        return $this->belongsTo(Sambat::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
