<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{

    protected $table = 'provinsi';
    protected $primaryKey = "prov_id";
    protected $fillable = ['nama'];

    /**
     * one to many relationship between kelompok and anggota
     *
     * @return void
     */
    public function kabupaten()
    {
        return $this->hasMany(Kabupaten::class, 'prov_id', 'prov_id');
    }
}
