<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOption\None;

class UsersDetailsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithColumnWidths
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
            $row->details->skripsi_dosbing,
            $row->details->pa_divisi,
            $row->details->pa_jabatan,
            $row->details->alamat_rumah,
            $row->details->alamat_kos,
            $row->details->location->provinsi ?? null,
            $row->details->location->kabupaten ?? null,
            $row->details->no_hp_ayah,
            $row->details->no_hp_ibu,
            $row->details->no_hp_wali,
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
            'Dosbing',
            'PA Divisi',
            'PA Jabatan',
            'Alamat Rumah',
            'Alamat Kos',
            'Provinsi',
            'Kabupaten',
            'No HP Ayah',
            'No HP Ibu',
            'No Wali',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'F' => 30,
            'I' => 40,
            'J' => 40,
        ];
    }
}
