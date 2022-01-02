<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function sambat()
    {
        return $this->belongsToMany(Sambat::class, 'sambat_tags', 'tag_id', 'sambat_id');
    }
}
