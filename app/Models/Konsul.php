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

    protected $dates = [
        'acc_rej_at',
        'done_at',
        'published_at'
    ];

    protected $attributes = [
        'is_anonim' => false
    ];

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

    public function chats()
    {
        return $this->hasMany(KonsulChat::class)->oldest();
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * menandai pesan jadi dibaca, jika $isAdmin true maka pesan dari admin yang akan diubah jadi seen
     *
     * @param  bool $isAdmin
     * @return void
     */
    public function markUnreadMessage($isAdmin = false)
    {
        return $this->chats()->where('konsul_chats.is_admin', $isAdmin)->update(['konsul_chats.is_seen' => true]);
    }
}
