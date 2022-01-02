<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sambat extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'sambat_tags', 'sambat_id', 'tag_id');
    }

    public function sambat_comment()
    {
        return $this->hasMany(SambatComment::class);
    }

    public function sambat_image()
    {
        return $this->hasMany(SambatImage::class);
    }

    public function sambat_vote()
    {
        return $this->hasMany(SambatVote::class);
    }
}
