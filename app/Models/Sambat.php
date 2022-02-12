<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sambat extends Model
{
    use HasFactory;

    protected $table = 'sambat';

    protected $fillable = [
        'user_id',
        'description',
        'is_anonim'
    ];

    protected $attributes = [
        'is_anonim' => false
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function sambat_comment()
    {
        return $this->hasMany(SambatComment::class);
    }

    public function votes()
    {
        return $this->hasMany(SambatVote::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where('description', 'like', $term);
    }
}
