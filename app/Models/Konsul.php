<?php

namespace App\Models;

use App\Constants\AppKonsul;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'is_publish'
    ];

    public function scopeKonsulType($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopePublish($query)
    {
        return $query->where('status', AppKonsul::STATUS_DONE)
            ->where('acc_publish_admin', true)
            ->where('acc_publish_user', true);
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

    public function getIsPublishAttribute()
    {
        return $this->acc_publish_admin && $this->acc_publish_user;
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

    public function activity()
    {
        return $this->morphToMany(User::class, 'activity', 'users_activities', 'activity_id', 'user_id')
            ->withPivot('title', 'note', 'icon', 'created_at')
            ->orderByPivot('created_at', 'desc');
    }

    public function publishKonsul()
    {
        $randomInt = Faker::create()->numerify(' #####');
        $this->slug = Str::slug(Str::limit($this->title, 60, '') . $randomInt);
        $this->published_at = now();
    }

    public function unpublishKonsul()
    {
        $this->slug = null;
        $this->published_at = null;
    }
}
