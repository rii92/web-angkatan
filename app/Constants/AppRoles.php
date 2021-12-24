<?php

namespace App\Constants;

class AppRoles
{
    const BPH = 'bph';
    const USERS = 'users';
    const ADMIN = 'admin';
    const HUMAS = 'humas';
    const AKADEMIK = 'akademik';
    const MEMBER = 'pengurus_angkatan';
    const ALUMNI = 'd3_angkatan_60';
    const D3_61 = 'd3_angkatan_61';

    public static function allRoles()
    {
        return [
            self::BPH => 'BPH',
            self::USERS => 'Mahasiswa',
            self::ADMIN => 'Administrator / TI',
            self::HUMAS => 'Humas',
            self::AKADEMIK => 'Akademik',
            self::MEMBER => 'Pengurus Angkatan',
            self::ALUMNI => 'D3 Angkatan 60 (Alumni)',
            self::D3_61 => 'D3 Angkatan 61'
        ];
    }
}
