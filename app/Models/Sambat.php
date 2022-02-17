<?php

namespace App\Models;

use App\Constants\AppSambat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function userdetails()
    {
        return $this->hasOne(UserDetails::class, 'user_id', 'user_id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->hasMany(SambatComment::class);
    }

    public function latestComment()
    {
        return $this->hasOne(SambatComment::class)->latestOfMany();
    }

    public function votes()
    {
        return $this->hasMany(SambatVote::class);
    }

    public function latestVote()
    {
        return $this->hasOne(SambatVote::class)->latestOfMany();
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

    public function myvote()
    {
        return $this->votes()->where('user_id', auth()->id() ?? -1);
    }

    // this is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();
        self::deleting(function ($sambat) { // before delete() method call this
            $sambat->comments()->delete();
            $sambat->votes()->delete();
            $sambat->images()->each(function ($image) {
                Storage::disk('public')->delete($image->url);
                $image->delete();
            });
            $sambat->tags()->detach();
        });
    }
}
