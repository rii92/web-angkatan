<?php

namespace App\Constants;

class AppTurnitins
{
    const STATUS_WAIT = "wait";
    const STATUS_REJECT = "reject";
    const STATUS_REVISI_LINK = "revisi link";
    const STATUS_PROGRESS = "progress";
    const STATUS_DONE = "done";

    public static function allStatus()
    {
        return [
            self::STATUS_WAIT => "Menunggu",
            self::STATUS_REVISI_LINK => "Revisi Link",
            self::STATUS_PROGRESS => "Dalam Proses",
            self::STATUS_DONE => "Selesai",
            self::STATUS_REJECT => "Ditolak",
        ];
    }
}
