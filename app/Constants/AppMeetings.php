<?php

namespace App\Constants;

class AppMeetings
{
    const PRESENT = 'hadir';
    const HAS_PERMISSION = 'izin';
    const NOT_PRESENT = 'tidak hadir';

    public static function allStatus()
    {
        return [
            self::PRESENT => 'Hadir',
            self::HAS_PERMISSION => 'Izin',
            self::NOT_PRESENT => 'Tidak Hadir'
        ];
    }
}
