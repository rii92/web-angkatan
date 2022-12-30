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

    const JURUSAN_SD = "SD";
    const JURUSAN_SI = "SI";
    const JURUSAN_SK = "SK";
    const JURUSAN_SE = "SE";

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
                self::STATUS_WAIT => "Wait",
                self::STATUS_REJECT => "Reject",
                self::STATUS_PROGRESS => "Progress",
                self::STATUS_DONE => "Done"
            ];
        return [
            self::STATUS_WAIT,
            self::STATUS_REJECT,
            self::STATUS_PROGRESS,
            self::STATUS_DONE
        ];
    }

    // public static function getKonselor($dayInWeek, $jurusan)
    public static function getKonselor()
    {
        $konselor = ["221911030","221911179","211910997","221911241","221911069","221911206","211911112"];
        return $konselor;
    }

    public static function getPSDM()
    {
        $konselor = ["221910760","221911048","211910729","211910798","221911059","221911206","211910830"];
        return $konselor;
    }

    public static function allJurusan($returnAssocArray = false)
    {
        if ($returnAssocArray)
            return [
                self::JURUSAN_SD => self::JURUSAN_SD,
                self::JURUSAN_SI => self::JURUSAN_SI,
                self::JURUSAN_SE => self::JURUSAN_SE,
                self::JURUSAN_SK => self::JURUSAN_SK
            ];
        return [
            self::JURUSAN_SD,
            self::JURUSAN_SI,
            self::JURUSAN_SE,
            self::JURUSAN_SK
        ];
    }
}
