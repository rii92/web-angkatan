<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sambat extends Model
{
    use HasFactory;

    protected $table = 'sambat';
    protected $fillable = ['user_id', 'description', 'is_anonim'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, SambatTag::class);
    }

    public function sambat_comment()
    {
        return $this->hasMany(SambatComment::class);
    }

    public function sambat_vote()
    {
        return $this->hasMany(SambatVote::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where('description', 'like', $term);
    }
}
