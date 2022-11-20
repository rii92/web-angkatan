<?php

namespace App\Http\Livewire\Mahasiswa\Simulation;

use App\Constants\AppSimulation;
use App\Models\Satker;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Illuminate\Support\Str;

class SatkerTable extends DataTableComponent
{
    public int $simulation_id;

    public string $defaultSortColumn = 'location_id';

    public string $defaultSortDirection = 'desc';

    public array $perPageAccepted = [10, 15];

    public string $pageName = 'satker_table';

    public string $tableName = 'satkers';

    public function columns(): array
    {
        $centeredColumnFormat = fn ($value) => view("mahasiswa.simulation.column.center", ['value' => $value]);

        $baseColumn = [
            Column::make("nama", "name")->searchable(),

            Column::make("lokasi satker", "location.full_location")
        ];

        if ($this->getFilter('formation')) return array_merge($baseColumn, [
            Column::make("Formasi", $this->getFilter('formation'))
                ->format($centeredColumnFormat),
            Column::make("Pilihan 1", "formation_1_count")
                ->format($centeredColumnFormat),
            Column::make("Pilihan 2", "formation_2_count")
                ->format($centeredColumnFormat),
            Column::make("Pilihan 3", "formation_3_count")
                ->format($centeredColumnFormat),
            Column::make("Final", "formation_final_count")
                ->format($centeredColumnFormat),
        ]);

        $formationColumns = [];

        foreach (AppSimulation::BASED_ON() as $key => $value)
            array_push($formationColumns, Column::make(Str::upper($key), $key)->format($centeredColumnFormat));

        return array_merge($baseColumn, $formationColumns);
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
