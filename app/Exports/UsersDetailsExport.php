<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersDetailsExport implements FromQuery, WithHeadings, WithMapping
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
            $row->details->jenis_kelamin_value,
            $row->details->no_hp,
            $row->details->pa_divisi,
            $row->details->pa_jabatan,
            $row->details->alamat_rumah,
            $row->details->alamat_kos,
        ];
    }

    public function headings(): array
    {
        return [
            'NIM',
            'Nama',
            'Kelas',
            'Jenis Kelamin',
            'No HP',
            'PA Divisi',
            'PA Jabatan',
            'Alamat Rumah',
            'Alamat Kos',
        ];
    }
}
