<?php

namespace App\Models;

use App\Constants\AppKonsul;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsul extends Model
{
    use HasFactory;
    protected $table = 'konsul';
    protected $guarded = [];

    public function scopeKonsulType($query, $category)
    {
        return $query->where('category', $category);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userdetails()
    {
        return $this->hasOne(UserDetails::class, 'user_id', 'user_id');
    }

    public function chat()
    {
        return $this->belongsToMany(User::class, 'konsul_chats', 'konsul_id', 'user_id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * mendapat jumlah pesan yang belum dibaca dari suatu konsultasi
     *
     * @return void
     */
    public function unreadMessageCount()
    {
        $count = $this->status == AppKonsul::STATUS_WAIT ? 1 : 0;
        // masih ada kondisi lain lagi nanti

        return $count;
    }
}
