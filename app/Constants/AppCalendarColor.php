<?php

namespace App\Constants;

class AppCalendarColor
{
    private static $color = ["green", "red", "blue", "orange", "yellow", "purple", "lime", "pink"];

    public static function all()
    {
        return collect(self::$color)->map(function ($color) {
            return 'calendar-' . $color;
        })->all();
    }
}
