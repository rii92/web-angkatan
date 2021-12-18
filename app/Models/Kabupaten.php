<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'kabupaten';
    protected $primaryKey = 'kab_id';
    protected $fillable = ['provinsi_id', 'nama'];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'prov_id', 'prov_id');
    }
}
