<?php

namespace App\Constants;

use App\Models\Location;
use App\Models\SimulationsTime;
use Illuminate\Support\Facades\Cache;

class AppSimulation
{
    const BASED_ON = 'jurusan'; // jurusan or peminatan
    const SEDANG_MEMILIH = 'Sedang Memilih';
    const BELUM_MEMILIH = 'Belum Memilih';
    const SUDAH_MEMILIH = 'Sudah Memilih';
    const TIDAK_MEMILIH = 'Tidak Memilih';

    const PILIHAN_AMAN = "Pilihan Aman";
    const PILIHAN_TIDAK_AMAN = "Pilihan TIdak Aman";
    const PILIHAN_MENUNGGU = "Menunggu Hasil";

    const STATUS_PILIHAN_AMAN = 1;
    const STATUS_PILIHAN_TIDAK_AMAN = 2;
    const STATUS_PILIHAN_MENUNGGU = 3;

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

    public static function PROVINSI_FILTER(): array
    {
        return Cache::rememberForever(
            "location_filters",
            fn () => Location::selectRaw('DISTINCT(provinsi)')
                ->get()
                ->mapWithKeys(fn ($item, $key) => [$item->provinsi => $item->provinsi])
                ->toArray()
        );
    }

    public static function KABUPATEN_FILTER($provinsi): array
    {
        return Cache::rememberForever(
            "location_filters_$provinsi",
            function () use ($provinsi) {
                return Location::select('kabupaten')
                    ->where('provinsi', $provinsi)
                    ->get()
                    ->mapWithKeys(fn ($item, $key) => [$item->kabupaten => $item->kabupaten])
                    ->toArray();
            }
        );
    }

    public static function SESSION_FILTER($simulation_id): array
    {
        return Cache::rememberForever(
            "jumlah_session_" . $simulation_id,
            function () use ($simulation_id) {
                $count = SimulationsTime::where('simulations_id', $simulation_id)->get()->count();

                $filters = [];
                for ($i = 1; $i <= $count; $i++)
                    $filters[$i] = $i;
                return $filters;
            }
        );
    }

    public static function STATUS_PILIHAN(): array
    {
        return [
            self::PILIHAN_AMAN => self::PILIHAN_AMAN,
            self::PILIHAN_TIDAK_AMAN => self::PILIHAN_TIDAK_AMAN,
            self::PILIHAN_MENUNGGU => self::PILIHAN_MENUNGGU
        ];
    }
}
