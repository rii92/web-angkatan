<?php

namespace App\Exports\Sheets;

use App\Constants\AppSimulation;
use App\Models\UserFormations;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SatkerPerProv implements FromQuery, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    use Exportable;

    private $selectedRowQuery;
    private $provinsi;
    private $simulation;

    public function __construct(Builder $selectedRowQuery, $provinsi, $simulation)
    {
        $this->selectedRowQuery = $selectedRowQuery;
        $this->provinsi = $provinsi;
        $this->simulation = $simulation;
    }

    private function getPilihanKe($pilihanKe, $idKabkot)
    {
        return UserFormations::with(['user', 'user.details', 'user.details.location', 'satker1', 'satker2', 'satker3'])
            ->select('*')
            ->selectRaw("{$pilihanKe} as pilihan_ke")
            ->selectRaw("satker_{$pilihanKe} = satker_final as is_final")
            ->where('simulations_id', $this->simulation->id)
            ->whereIn("satker_{$pilihanKe}", $idKabkot);
    }

    public function query()
    {
        $idKabkot = $this->selectedRowQuery->whereHas('location', function (Builder $query) {
            $query->where('provinsi',  $this->provinsi);
        })->get('id')->pluck('id');

        $query = $this->getPilihanKe(1, $idKabkot)
            ->union($this->getPilihanKe(2, $idKabkot))
            ->union($this->getPilihanKe(3, $idKabkot));

        return $query->orderBy('is_final', 'desc')
            ->orderBy('based_on', 'asc')
            ->orderBy('user_rank', 'asc')
            ->orderBy('pilihan_ke', 'asc');
    }

    private function getSatker($row, $variabel)
    {
        if ($row->pilihan_ke == 1) return $row->satker1->{$variabel};
        if ($row->pilihan_ke == 2) return $row->satker2->{$variabel};
        return $row->satker3->{$variabel};
    }

    public function map($row): array
    {
        return [
            $row->user->details->nim,
            $row->user->name,

            $row->user->details->kelas,
            $row->based_on,
            $row->user_rank,

            $row->pilihan_ke,
            $this->getSatker($row, 'kode_wilayah'),
            $this->getSatker($row, 'name'),
            $row->is_final ? "Terpilih di Satker ini" : "Tidak Terpilih di Satker ini",

            $row->user->details->location->kabupaten ?? '',
            $row->user->details->location->provinsi ?? '',
        ];
    }

    public function headings(): array
    {
        return [
            "NIM",
            "Nama",

            "Kelas",
            "Jurusan",
            "Ranking " . AppSimulation::BASED_ON,

            "Pilihan Ke",
            "Kode Wilayah",
            "Nama Satker",
            "Status",

            "Kabupaten Asal",
            "Provinsi Asal",
        ];
    }

    public function title(): string
    {
        return $this->provinsi;
    }
}
