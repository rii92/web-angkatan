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
            Column::make("d3", "d3")
                ->excludeFromSelectable(),
            Column::make("ks", "ks")
                ->excludeFromSelectable(),
            Column::make("st", "st")
                ->excludeFromSelectable(),
            Column::make("se", "se"),
            Column::make("sk", "sk"),
            Column::make("si", "si"),
            Column::make("sd", "sd"),
        ];
    }

    public function query()
    {
        return Satker::with('location');
    }
}
