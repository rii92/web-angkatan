<?php

namespace App\Http\Livewire\Mahasiswa\Simulation;

use App\Models\Satker;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SatkerTable extends DataTableComponent
{

    public string $defaultSortColumn = 'location_id';
    public string $defaultSortDirection = 'desc';

    public bool $columnSelect = true;

    public function columns(): array
    {
        return [
            Column::make("name")
                ->searchable()
                ->excludeFromSelectable(),
            Column::make("location")
                ->format(function ($value, $column, $row) {
                    if (!$row->location) return "";
                    return $row->location->kabupaten . ", " . $row->location->provinsi;
                }),
            Column::make("d3", "d3_formation")
                ->excludeFromSelectable(),
            Column::make("ks", "ks_formation")
                ->excludeFromSelectable(),
            Column::make("st", "st_formation")
                ->excludeFromSelectable(),
            Column::make("se", "se_formation"),
            Column::make("sk", "sk_formation"),
            Column::make("si", "si_formation"),
            Column::make("sd", "sd_formation"),
        ];
    }

    public function query()
    {
        return Satker::with('location');
    }
}
