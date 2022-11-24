<?php

namespace App\Constants;

class AppSimulation
{
    const BASED_ON = 'jurusan'; // jurusan or peminatan
    const SEDANG_MEMILIH = 'Sedang Memilih';
    const BELUM_MEMILIH = 'Belum Memilih';
    const SUDAH_MEMILIH = 'Sudah Memilih';
    const TIDAK_MEMILIH = 'Tidak Memilih';

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

    public static function STATUS_PEMILIHAN(): array
    {
        return [
            self::BELUM_MEMILIH => self::BELUM_MEMILIH,
            self::SEDANG_MEMILIH => self::SEDANG_MEMILIH,
            self::SUDAH_MEMILIH => self::SUDAH_MEMILIH,
            self::TIDAK_MEMILIH => self::TIDAK_MEMILIH
        ];
    }
}
