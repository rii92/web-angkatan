<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTurnitin extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'users_turnitins';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userdetails()
    {
        return $this->hasOne(UserDetails::class, 'user_id', 'user_id');
    }

    public function activity()
    {
        return $this->morphToMany(User::class, 'activity', 'users_activities', 'activity_id', 'user_id')
            ->withPivot('title', 'note', 'icon', 'created_at')
            ->orderByPivot('created_at', 'desc');
    }
}
