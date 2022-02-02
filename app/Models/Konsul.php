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
        return $this->belongsToMany(User::class, 'konsul_chats', 'konsul_id', 'user_id')
            ->withTimestamps()
            ->withPivot('is_admin', 'is_seen', 'chat', 'type', 'id');
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
    public function unreadMessageCount($isAdmin)
    {
        if (in_array($this->status, [AppKonsul::STATUS_PROGRESS, AppKonsul::STATUS_DONE])) {
            return $this->chats()->wherePivot('is_seen', false)->wherePivot('is_admin', $isAdmin)->count();
        } else
            return  $this->status == AppKonsul::STATUS_WAIT && !$isAdmin ? 1 : 0;
    }

    /**
     * menandai pesan jadi dibaca, jika $isAdmin true maka pesan dari admin yang akan diubah jadi seen
     *
     * @param  mixed $isAdmin
     * @return void
     */
    public function markUnreadMessage($isAdmin)
    {
        $this->chats()->wherePivot('is_admin', $isAdmin)->update(['is_seen' => true]);
    }
}
