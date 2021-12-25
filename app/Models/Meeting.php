<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'started_at'  => 'datetime:Y-m-d\TH:i'
    ];

    protected $attributes = [
        'is_open' => false
    ];

    protected $fillable = [
        'name', 'description', 'token', 'started_at', 'is_open'
    ];

    public function members()
    {
        return $this->hasMany(MeetingMember::class);
    }
}
