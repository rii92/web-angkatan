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

    public static function allRoles()
    {
        return [
            self::BPH => 'BPH', 
            self::USERS => 'Mahasiswa', 
            self::ADMIN => 'Administrator / TI', 
            self::HUMAS => 'Humas', 
            self::AKADEMIK => 'Akademik', 
            self::MEMBER => 'Pengurus Angkatan', 
        ];
    }
}
