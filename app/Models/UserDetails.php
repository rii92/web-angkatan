<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetails extends Model
{
    use HasFactory;

    protected $table = 'users_details';
    protected $guarded = [];
    public $timestamps = false;

    protected $dates = [
        'last_login',
        'last_seen_notification',
    ];

    /**
     * accessor to translate code jenis kelamin
     *
     * @return void
     */
    public function getJenisKelaminAttribute($jenisKelamin)
    {
        if ($jenisKelamin)
            return $jenisKelamin == "P" ? 'Perempuan' : 'Laki-Laki';
        return $jenisKelamin;
    }

    /**
     * mutator to translate code jenis kelamin
     *
     * @param  mixed $jenisKelamin
     * @return void
     */
    public function setJenisKelaminAttribute($jenisKelamin)
    {
        if ($jenisKelamin)
            $this->attributes['jenis_kelamin'] = $jenisKelamin == 'Laki-Laki' ? 'L' : 'P';
    }

    /**
     * one to many dengan tabel kabupaten
     *
     * @return void
     */
    public function kabupaten()
    {
        return $this->hasOne(Kabupaten::class, 'kab_id', 'alamat_kabupaten');
    }

    /**
     * one to many dengan tabel provinsi
     *
     * @return void
     */
    public function provinsi()
    {
        return $this->hasOne(Provinsi::class, 'prov_id', 'alamat_provinsi');
    }
}
