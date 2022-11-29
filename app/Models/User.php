<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JoelButcher\Socialstream\HasConnectedAccounts;
use JoelButcher\Socialstream\SetsProfilePhotoFromUrl;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto {
        getProfilePhotoUrlAttribute as getPhotoUrl;
    }
    use HasConnectedAccounts;
    use Notifiable;
    use SetsProfilePhotoFromUrl;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        if (filter_var($this->profile_photo_path, FILTER_VALIDATE_URL)) {
            return $this->profile_photo_path;
        }

        return $this->getPhotoUrl();
    }

    /**
     * one to one relationship with table users_details
     *
     * @return void
     */
    public function details()
    {
        return $this->hasOne(UserDetails::class);
    }

    public function formations()
    {
        return $this->hasMany(UserFormations::class);
    }

    public function meetings()
    {
        return $this->hasMany(MeetingMember::class);
    }

    public function konsul()
    {
        return $this->hasMany(Konsul::class);
    }

    public function sambat()
    {
        return $this->hasMany(Sambat::class, 'user_id', 'id');
    }

    public function sambat_comments()
    {
        return $this->hasMany(SambatComment::class, 'user_id', 'id');
    }

    public function sambat_votes()
    {
        return $this->hasMany(SambatVote::class);
    }

    public function session()
    {
        return $this->hasOne(Session::class)->latestOfMany();
    }

    public function turnitin()
    {
        return $this->hasMany(UserTurnitin::class);
    }
}
