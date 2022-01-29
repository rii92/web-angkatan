<?php

namespace App\Constants;

class AppKonsul
{
    const TYPE_AKADEMIK = "akademik";
    const TYPE_UMUM = "umum";

    const STATUS_WAIT = "wait";
    const STATUS_REJECT = "reject";
    const STATUS_PROGRESS = "progress";
    const STATUS_DONE = "done";

    const TYPE_CHAT_TEXT = "text";
    const TYPE_CHAT_IMAGE = "image";

    public static function allTypeKonsul($returnAssocArray = false)
    {
        if ($returnAssocArray)
            return [
                self::TYPE_AKADEMIK => "Akademik",
                self::TYPE_UMUM => "Umum"
            ];

        return [self::TYPE_AKADEMIK, self::TYPE_UMUM];
    }

    public static function allStatus($returnAssocArray = false)
    {
        if ($returnAssocArray)
            return [
                self::STATUS_WAIT => "Menunggu",
                self::STATUS_REJECT => "Ditolak",
                self::STATUS_PROGRESS => "Dalam Proses",
                self::STATUS_DONE => "Selesai"
            ];
        return [self::STATUS_WAIT, self::STATUS_REJECT, self::STATUS_PROGRESS, self::STATUS_DONE];
    }
}
