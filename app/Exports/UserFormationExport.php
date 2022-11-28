<?php

namespace App\Exports;

use App\Constants\AppSimulation;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserFormationExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    private $selectedRowQuery;

    public function __construct(Builder $selectedRowQuery)
    {
        $selectedRowQuery->with([
            'user.details',
            'user.details.location',
            'satker1',
            'satker1.location',
            'satker2',
            'satker2.location',
            'satker3',
            'satker3.location',
            'satkerfinal.location',
        ])
            ->orderby('based_on')
            ->orderby('user_rank');

        $this->selectedRowQuery = $selectedRowQuery;
    }

    public function query()
    {
        return $this->selectedRowQuery;
    }

    private function status_pilihan($row)
    {
        if (!$row->satker_1) return 'Tidak Memilih';
        if (!$row->satker_final) return 'Pilihan Tidak Aman';
        return 'Pilihan Aman';
    }

    private function status_pemilihan($row)
    {
        return $row->satker_1 ? 'Memilih' : 'Tidak Memilih';
    }

    public function map($row): array
    {
        return [
            $row->user->details->nim,
            $row->user->name,
            $row->user->details->location->kabupaten ?? '',
            $row->user->details->location->provinsi ?? '',

            $row->user->details->kelas,
            $row->based_on,
            $row->user_rank,

            $this->status_pemilihan($row),
            $this->status_pilihan($row),

            $row->satker1->kode_wilayah ?? '',
            $row->satker1->name ?? '',
            $row->satker1->location->provinsi ?? '',

            $row->satker2->kode_wilayah ?? '',
            $row->satker2->name ?? '',
            $row->satker2->location->provinsi ?? '',

            $row->satker3->kode_wilayah ?? '',
            $row->satker3->name ?? '',
            $row->satker3->location->provinsi ?? '',

            $row->satkerfinal->kode_wilayah ?? '',
            $row->satkerfinal->name ?? '',
            $row->satkerfinal->location->provinsi ?? '',
            $row->satker_final_updated_at,

            $row->session + 1,
            $row->session_time->start_time,
            $row->session_time->end_time
        ];
    }

    public function headings(): array
    {
        return [
            "NIM",
            "Nama",
            "Kabupaten Asal",
            "Provinsi Asal",

            "Kelas",
            "Jurusan",
            "Ranking " . AppSimulation::BASED_ON,

            "Status Pemilihan",
            "Status Pilihan",

            "Pilihan Pertama_Kode Wilayah",
            "Pilihan Pertama_Satker",
            "Pilihan Pertama_Provinsi",

            "Pilihan Kedua_Kode Wilayah",
            "Pilihan Kedua_Satker",
            "Pilihan Kedua_Provinsi",

            "Pilihan Ketiga_Kode Wilayah",
            "Pilihan Ketiga_Satker",
            "Pilihan Ketiga_Provinsi",

            "Pilihan Final_Kode Wilayah",
            "Pilihan Final_Satker",
            "Pilihan Final_Provinsi",
            "Pilihan Final_Updated At",

            "Sesi",
            "Sesi Start Time",
            "Sesi End Time"
        ];
    }
}
