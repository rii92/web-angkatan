<?php

namespace App\Http\Livewire\Mahasiswa\Simulation;

use App\Constants\AppSimulation;
use App\Models\Satker;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class SatkerTable extends DataTableComponent
{
    public int $simulation_id;

    public string $defaultSortColumn = 'location_id';

    public string $defaultSortDirection = 'desc';

    public bool $columnSelect = true;

    public array $perPageAccepted = [10, 15];

    public string $pageName = 'satker_table';

    public string $tableName = 'satkers';

    public function columns(): array
    {
        $baseColumn = [
            Column::make("nama", "name")
                ->searchable()
                ->excludeFromSelectable(),
            Column::make("lokasi satker", "location.full_location")
                ->excludeFromSelectable(),
        ];

        if ($this->getFilter('formation')) return array_merge($baseColumn, [
            Column::make("Formasi", $this->getFilter('formation')),
            Column::make("Pilihan 1", "formation_1_count"),
            Column::make("Pilihan 2", "formation_2_count"),
            Column::make("Pilihan 3", "formation_3_count"),
            Column::make("Final", "formation_final_count"),
        ]);

        return array_merge($baseColumn, [
            Column::make("DIII", "d3")->excludeFromSelectable(),
            Column::make("KS", "ks")->excludeFromSelectable(),
            Column::make("ST", "st")->excludeFromSelectable(),
            Column::make("SE", "se"),
            Column::make("SK", "sk"),
            Column::make("SI", "si"),
            Column::make("SD", "sd"),
        ]);
    }

    public function filters(): array
    {
        return [
            'formation' => Filter::make('formation')
                ->select(array_merge(['' => "All"], AppSimulation::BASED_ON()))
        ];
    }

    public function query()
    {
        return Satker::with('location')
            ->when($this->getFilter('formation'), function ($query, $formation) {
                $query->withCount([
                    "formation_1" => function (Builder $query) use ($formation) {
                        $query->where("based_on", $formation)
                            ->where('simulations_id', $this->simulation_id);
                    },
                    "formation_2" => function (Builder $query) use ($formation) {
                        $query->where("based_on", $formation)
                            ->where('simulations_id', $this->simulation_id);
                    },
                    "formation_3" => function (Builder $query) use ($formation) {
                        $query->where("based_on", $formation)
                            ->where('simulations_id', $this->simulation_id);
                    },
                    "formation_final" => function (Builder $query) use ($formation) {
                        $query->where("based_on", $formation)
                            ->where('simulations_id', $this->simulation_id);
                    }
                ]);
            });
    }
}
