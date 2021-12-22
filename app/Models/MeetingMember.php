<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingMember extends Model
{
    use HasFactory;

    protected $dates = [
        'attend_at'
    ];

    protected $fillable = [
        'user_id', 'meeting_id', 'status', 'attend_at'
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
