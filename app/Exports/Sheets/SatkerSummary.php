<?php

namespace App\Exports\Sheets;

use App\Constants\AppSimulation;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class SatkerSummary implements FromQuery, WithHeadings, WithMapping, WithTitle
{
    use Exportable;

    private $selectedRowQuery;

    public function __construct(Builder $selectedRowQuery, $simulation)
    {
        $countList = [];
        foreach ([1, 2, 3, "final"] as $pilihan)
            foreach (AppSimulation::BASED_ON() as $formation => $value)
                $countList = array_merge($countList, [
                    "formation_{$pilihan} as formation_{$pilihan}_{$formation}" => function (Builder $query) use ($simulation, $formation) {
                        $query->where("based_on", $formation)
                            ->where('simulations_id', $simulation->id);
                    }
                ]);

        $selectedRowQuery->withCount($countList)
            ->orderBy('kode_wilayah');

        $this->selectedRowQuery = $selectedRowQuery;
    }

    public function query()
    {
        return $this->selectedRowQuery;
    }

    private function if_zero($value)
    {
        return $value ? $value : '0';
    }

    public function map($row): array
    {
        return [
            $row->kode_wilayah,
            $row->name,
            $row->location->provinsi,
            $this->if_zero($row->d3 + $row->ks + $row->st),

            $this->if_zero($row->d3),
            $this->if_zero($row->formation_final_d3),
            $this->if_zero($row->formation_1_d3),
            $this->if_zero($row->formation_2_d3),
            $this->if_zero($row->formation_3_d3),

            $this->if_zero($row->ks),
            $this->if_zero($row->formation_final_ks),
            $this->if_zero($row->formation_1_ks),
            $this->if_zero($row->formation_2_ks),
            $this->if_zero($row->formation_3_ks),

            $this->if_zero($row->st),
            $this->if_zero($row->formation_final_st),
            $this->if_zero($row->formation_1_st),
            $this->if_zero($row->formation_2_st),
            $this->if_zero($row->formation_3_st),

        ];
    }

    public function headings(): array
    {
        return [
            "Kode Wilayah",
            "Nama Satker",
            "Provinsi",
            "Jumlah Formasi",

            "D3_Jumlah Formasi",
            "D3_Jumlah Formasi Final",
            "D3_Jumlah Pilihan Pertama",
            "D3_Jumlah Pilihan Kedua",
            "D3_Jumlah Pilihan Ketiga",

            "KS_Jumlah Formasi",
            "KS_Jumlah Formasi Final",
            "KS_Jumlah Pilihan Pertama",
            "KS_Jumlah Pilihan Kedua",
            "KS_Jumlah Pilihan Ketiga",

            "ST_Jumlah Formasi",
            "ST_Jumlah Formasi Final",
            "ST_Jumlah Pilihan Pertama",
            "ST_Jumlah Pilihan Kedua",
            "ST_Jumlah Pilihan Ketiga",
        ];
    }

    public function title(): string
    {
        return "Summary";
    }
}
