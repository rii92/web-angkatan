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

    public array $perPageAccepted = [10, 15];

    public string $pageName = 'satker_table';

    private const PER_SATKER = 'Per Satuan Kerja';

    private const PER_PROVINSI = 'Per Provinsi';

    public array $filters = [
        'views' => self::PER_SATKER
    ];

    public function configure(): void
    {
        // Search will wait 1 second before sending request.
        $this->setSearchDebounce(1000);
    }

    
    /**
     * get result for all satker
     */
    private function query_satker()
    {
        $this->tableName = '';

        $this->defaultSortColumn = 'location_id';

        $this->defaultSortDirection = 'asc';

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
            })
            ->when($this->getFilter('provinsi'), function ($query, $provinsi) {
                $query->whereHas("location", function ($query) use ($provinsi) {
                    $query->where('provinsi', $provinsi);
                });
            });
    }

    /**
     * custom query to get result by provinces
     */
    private function query_provinsi()
    {
        $this->tableName = 'locations';

        $this->defaultSortColumn = 'locations.provinsi';

        $this->defaultSortDirection = 'asc';

        $query =  Satker::select('locations.provinsi')
            ->join('locations', 'locations.id', '=', 'satkers.location_id')
            ->groupby('locations.provinsi')
            ->when($this->getFilter('provinsi'), function ($query, $provinsi) {
                $query->where('locations.provinsi', $provinsi);
            });

        if (!$this->getFilter('formation'))
            foreach (AppSimulation::BASED_ON() as $key => $value)
                $query->selectRaw("SUM(satkers." . $key . ") as " . $key);
        else {
            $query->selectRaw("SUM(satkers." . $this->getFilter('formation') . ") as " . $this->getFilter('formation'));

            foreach ([1, 2, 3, "final"] as $f)
                $query->leftJoin("users_formations as formation_{$f}", function ($join) use ($f) {
                    $join->on("formation_{$f}.satker_{$f}", '=', 'locations.id')
                        ->where("formation_{$f}.based_on", $this->getFilter('formation'))
                        ->where("formation_{$f}.simulations_id", $this->simulation_id);
                })
                    ->selectRaw("COUNT(DISTINCT formation_{$f}.user_id) as formation_{$f}_count");
        }

        return $query;
    }


    /**
     * Column Table
     */
    public function columns(): array
    {
        $centeredColumnFormat = fn ($value) => view("mahasiswa.simulation.column.center", ['value' => $value]);

        $baseColumn = $this->getFilter('views') !== self::PER_SATKER
            ? [Column::make("Nama", "provinsi")->searchable()]
            : [
                Column::make("Nama", "name")
                    ->format(fn ($value, $column, $row) => $row->full_name)
                    ->searchable(),

                Column::make("Provinsi", "location.provinsi")
            ];

        if ($this->getFilter('formation'))
            return array_merge($baseColumn, [
                Column::make("Formasi " . $this->getFilter('formation'), $this->getFilter('formation'))
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
            array_push($formationColumns, Column::make("Formation " . Str::upper($key), $key)->format($centeredColumnFormat));

        return array_merge($baseColumn, $formationColumns);
    }

    public function getTableRowUrl($row): string
    {
        if ($this->getFilter('views') !== self::PER_SATKER) return '#';
        return route('user.simulasi.details.satker', ['simulation' => $this->simulation_id, 'satker' => $row->id]);
    }

    public function query()
    {
        if ($this->getFilter('views') == self::PER_SATKER) return $this->query_satker();
        return $this->query_provinsi();
    }

    public function filters(): array
    {
        return [
            'views' => Filter::make('views')
                ->select([
                    self::PER_PROVINSI => "Provinsi",
                    self::PER_SATKER => "Satuan Kerja"
                ]),
            'formation' => Filter::make('formation')
                ->select(array_merge(['' => "All"], AppSimulation::BASED_ON())),
            'provinsi' => Filter::make('provinsi')
                ->select(array_merge(['' => "All"], AppSimulation::PROVINSI_FILTER())),
        ];
    }
}
