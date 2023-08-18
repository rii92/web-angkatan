<?php

namespace App\Http\Livewire\Mahasiswa\Simulation;

use App\Constants\AppSimulation;
use App\Exports\SatkerExport;
use App\Models\Satker;
use App\Models\Simulations;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Illuminate\Support\Str;
use App\Exports\Sheets\SatkerPerProv;

class SatkerTable extends DataTableComponent
{
    public int $simulation_id;

    public array $perPageAccepted = [10, 15];

    public string $pageName = 'satker_table';

    private const SATKER = 'Satuan Kerja';
    private const PER_PROVINSI = 'Per Provinsi';

    public array $filters = [
        'tampilan' => self::SATKER
    ];

    public array $bulkActions = [
        'exportSelected' => 'Export Excel',
    ];

    public function configure(): void
    {
        // Search will wait 1 second before sending request.
        $this->setSearchDebounce(1000);
    }

    private function columns_kabupaten(): array
    {
        $centeredColumnFormat = fn ($value) => view("mahasiswa.simulation.column.center", ['value' => $value]);

        $baseColumn = [
            Column::make("Nama", "name")
                ->format(fn ($value, $column, $row) => $row->kode_wilayah . " - " . $value)
                ->searchable(),

            Column::make("Provinsi", "location.provinsi")
        ];

        if ($this->getFilter('formation'))
            return array_merge($baseColumn, [
                Column::make("Formasi " . $this->getFilter('formation'), $this->getFilter('formation'))
                    ->sortable()
                    ->format($centeredColumnFormat),
                Column::make("Pilihan 1", "formation_1_count")
                    ->sortable()
                    ->format($centeredColumnFormat),
                Column::make("Pilihan 2", "formation_2_count")
                    ->sortable()
                    ->format($centeredColumnFormat),
                Column::make("Pilihan 3", "formation_3_count")
                    ->sortable()
                    ->format($centeredColumnFormat),
                Column::make("Final", "formation_final_count")
                    ->sortable()
                    ->format($centeredColumnFormat),
            ]);

        $formationColumns = [];

        foreach (AppSimulation::BASED_ON() as $key => $value)
            array_push($formationColumns, Column::make("Formation " . Str::upper($key), $key)->format($centeredColumnFormat));

        return array_merge($baseColumn, $formationColumns);
    }

    private function query_kabupaten()
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

    private function columns_provinsi(): array
    {
        $centeredColumnFormat = fn ($value) => view("mahasiswa.simulation.column.center", ['value' => $value]);

        $columns = [Column::make("Nama", "provinsi")->searchable()];

        if (!$this->getFilter('formation'))
            foreach (AppSimulation::BASED_ON() as $key => $value)
                array_push($columns, Column::make("Formasi " . Str::upper($key), $key)->format($centeredColumnFormat));
        else {
            array_push($columns, Column::make(Str::upper("Formasi " . $this->getFilter('formation')), $this->getFilter('formation'))
                ->format($centeredColumnFormat));

            foreach ([1, 2, 3, "final"] as $f)
                array_push($columns, Column::make("Formasi {$f}", "formation_{$f}_count")->format($centeredColumnFormat));
        }

        return $columns;
    }

    public function getTableRowUrl($row): string
    {
        if ($this->getFilter('tampilan') == self::SATKER)
            return route('user.simulasi.details-kab.satker', ['simulation' => $this->simulation_id, 'satker' => $row->id]);
        return route('user.simulasi.details-prov.satker', ['simulation' => $this->simulation_id, 'provinsi' => $row->provinsi]);
    }

    public function columns(): array
    {
        if ($this->getFilter('tampilan') == self::SATKER)
            return $this->columns_kabupaten();
        return $this->columns_provinsi();
    }

    public function query()
    {
        if ($this->getFilter('tampilan') == self::SATKER)
            return $this->query_kabupaten();
        return $this->query_provinsi();
    }

    public function filters(): array
    {
        return [
            'tampilan' => Filter::make('tampilan')
                ->select([
                    self::PER_PROVINSI => "Provinsi",
                    self::SATKER => "Satuan Kerja"
                ]),
            'formation' => Filter::make('formation')
                ->select(array_merge(['' => "All"], AppSimulation::BASED_ON())),
            'provinsi' => Filter::make('provinsi')
                ->select(array_merge(['' => "All"], AppSimulation::PROVINSI_FILTER())),
        ];
    }

    /**
     * export to xlsx file
     *
     * @return void
     */
    public function exportSelected()
    {
        if ($this->selectedRowsQuery->count() == 0) return $this->emit('error', "Pilih Row Terlebih Dahulu");
        if ($this->getFilter('tampilan') == self::PER_PROVINSI) return $this->emit('error', "Hanya bisa mengexport tampilan satuan kerja");

        $simulation = Simulations::find($this->simulation_id);

        try {
            return (new SatkerExport($this->selectedRowsQuery(), $simulation))->download($simulation->title . "_Satker_" . now()->format('d-M-Y H-i') . ".xlsx");
        } catch (\Throwable $th) {
            return $this->emit('error', "Somethings Wrong, I can feel It");
        }
    }
}
