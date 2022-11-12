<?php

namespace App\Models;

use App\Constants\AppPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulations extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function times()
    {
        return $this->hasMany(SimulationsTime::class);
    }

    public function users_formation()
    {
        return $this->hasMany(UserFormations::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($simulation) {
            $simulation->users_formation()->delete();
            $simulation->times()->delete();
        });
    }

    public static function getUserSession($basedOn = 'jurusan', $jumlahSesi = 4)
    {
        $maxPerGroup = "(COUNT(users.id) OVER(partition by users_details.{$basedOn}))";
        $rankPerGroup = "(ROW_NUMBER() OVER(partition by users_details.{$basedOn} order by users_details.rank_{$basedOn}))";

        $sesi = "{$rankPerGroup} / {$maxPerGroup} * {$jumlahSesi}";
        $sesi = "FLOOR({$sesi} - 0.0001)";

        return User::permission(AppPermissions::SIMULATION_ACCESS)
            ->select('users.id as user_id')
            ->selectRaw($sesi . ' as sesi')
            ->join('users_details', 'users.id', '=', 'users_details.user_id')
            ->where("users_details.rank_{$basedOn}", '>', 0)
            ->where("users_details.{$basedOn}", '!=', 'DIII Statistika')
            ->get();
    }
}
