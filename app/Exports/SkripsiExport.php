<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SkripsiExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    private $selectedRowQuery;

    public function __construct(Builder $selectedRowQuery)
    {
        $this->selectedRowQuery = $selectedRowQuery;
    }

    public function query()
    {
        return $this->selectedRowQuery;
    }

    public function map($row): array
    {
        return [
            $row->details->nim,
            $row->name,
            $row->details->kelas,
            $row->details->skripsi_dosbing,
            $row->details->skripsi_judul,
            $row->details->skripsi_metode,
            $row->details->skripsi_variabel_dependent,
            $row->details->skripsi_variabel_independent,
        ];
    }

    public function headings(): array
    {
        return [
            'NIM',
            'Nama',
            'Kelas',
            'Dosen Pembimbing',
            'Judul',
            'Metode',
            'Variabel Dependen',
            'Variabel Independen'
        ];
    }
}
