<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function sambat()
    {
        return $this->belongsToMany(Sambat::class, 'sambat_tags', 'tag_id', 'sambat_id');
    }

    public function konsul()
    {
        return $this->morphedByMany(Konsul::class, 'taggable');
    }
}
