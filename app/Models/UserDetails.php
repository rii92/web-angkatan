<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetails extends Model
{
    use HasFactory;

    protected $table = 'users_details';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'jenis_kelamin_value', 'jurusan_short', 'admin_name', 'anonim_name_value'
    ];

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getJenisKelaminValueAttribute()
    {
        if ($this->jenis_kelamin == 'P') return "Perempuan";
        return "Laki-Laki";
    }

    public function getAnonimNameValueAttribute()
    {
        return "(Anonim) " . $this->anonim_name;
    }

    /**
     * 1 on 1 realationship to Location model
     *
     * @var array
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getJurusanShortAttribute()
    {
        return substr($this->kelas, 1, 2);
    }

    public function getAdminNameAttribute()
    {
        return "Admin {$this->jurusan_short}-{$this->user_id}";
    }
}
