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

    public function scopeAkademik()
    {
        return $this->where('catagory', AppKonsul::TYPE_AKADEMIK);
    }

    public function scopeUmum()
    {
        return $this->where('category', AppKonsul::TYPE_UMUM);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chat()
    {
        return $this->belongsToMany(User::class, 'konsul_chats', 'konsul_id', 'user_id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
