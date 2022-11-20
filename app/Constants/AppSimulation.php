<?php

namespace App\Constants;

class AppSimulation
{
    const BASED_ON = 'jurusan';

    public static function BASED_ON(): array
    {
        return [
            "ks" => "Komputasi Statistik",
            "st" => "DIV Statistik",
            "d3" => "DIII Statistik",
            "si" => "Sistem Informasi",
            "sd" => "Sains Data",
            "se" => "Statistik Ekonomi",
            "sk" => "Statistik Kependudukan",
        ];
    }
}
