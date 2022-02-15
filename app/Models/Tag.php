<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name'];

    public function sambat()
    {
        return $this->morphedByMany(Sambat::class, 'taggable');
    }

    public function konsul()
    {
        return $this->morphedByMany(Konsul::class, 'taggable');
    }
}
