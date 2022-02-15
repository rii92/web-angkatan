<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonsulChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'konsul_id',
        'chat',
        'type',
        'is_admin',
        'is_seen',
    ];

    public function userdetails()
    {
        return $this->hasOne(UserDetails::class, 'user_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
