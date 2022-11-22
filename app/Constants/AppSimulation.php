<?php

namespace App\Constants;

class AppSimulation
{
    const BASED_ON = 'jurusan'; // jurusan or peminatan

    public static function BASED_ON(): array
    {

        if (self::BASED_ON === "jurusan") return [
            "ks" => "Komputasi Statistik",
            "st" => "DIV Statistik",
            "d3" => "DIII Statistik",
        ];

        return [
            "si" => "Sistem Informasi",
            "sd" => "Sains Data",
            "se" => "Statistik Ekonomi",
            "sk" => "Statistik Kependudukan",
            "d3" => "DIII Statistik",
        ];
    }
}
