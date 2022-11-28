<?php

namespace App\Http\Livewire\Mahasiswa\Simulation;

use App\Constants\AppSimulation;
use App\Models\Location;
use App\Models\UserFormations;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class UsersTable extends DataTableComponent
{
    public int $simulation_id;

    public string $defaultSortColumn = 'session';

    public string $defaultSortDirection = 'asc';

    public array $perPageAccepted = [10, 15];

    public string $pageName = 'users_table';

    public string $tableName = 'users_formations';

    public function configure(): void
    {
        // Search will wait 1 second before sending request.
        $this->setSearchDebounce(1000);
    }

    public function columns(): array
    {
        $centeredColumnFormat = fn ($value) => view("mahasiswa.simulation.column.center", ['value' => $value]);

        return [
            Column::make('action')
                ->format(fn ($value, $column, $row) => view('mahasiswa.simulation.column.detail-user', ['user_formation' => $row])),
            Column::make("name", "user.name")
                ->searchable(),
            Column::make(AppSimulation::BASED_ON, "based_on")
                ->format($centeredColumnFormat),
            Column::make("sesi", "session")
                ->format(fn ($value) => $centeredColumnFormat($value + 1)),
            Column::make("rank " . AppSimulation::BASED_ON, "user_rank")
                ->format($centeredColumnFormat),
            Column::make('status')
                ->format(fn ($value, $column, $row) => view("mahasiswa.simulation.column.status-pemilihan", [
                    'start' => $row->session_time->start_time,
                    'end' => $row->session_time->end_time,
                    'pilihan_pertama' => $row->satker_1
                ])),
            Column::make('satker final', "satker_final.name")
                ->searchable(),
            Column::make('Provinsi', "satker_final.location.provinsi")
        ];
    }

    public function filters(): array
    {
        return [
            AppSimulation::BASED_ON => Filter::make(AppSimulation::BASED_ON)
                ->select(array_merge(['' => "All"], AppSimulation::BASED_ON())),
            'provinsi' => Filter::make('provinsi')
                ->select(array_merge(['' => "All"], AppSimulation::PROVINSI_FILTER())),
            'status' => Filter::make('status')
                ->select(array_merge(['' => "All"], AppSimulation::STATUS_PEMILIHAN()))
        ];
    }

    public function query()
    {
        return UserFormations::with(['user', 'satker_final', 'session_time', 'satker_final.location'])
            ->where("simulations_id", $this->simulation_id)
            ->when($this->getFilter(AppSimulation::BASED_ON), function ($query, $formation) {
                $query->where("based_on", $formation);
            })
            ->when($this->getFilter('provinsi'), function ($query, $provinsi) {
                $query->whereHas("satker_final.location", function ($query) use ($provinsi) {
                    $query->where('provinsi', $provinsi);
                });
            })
            ->when($this->getFilter('status'), function ($query, $status) {
                if ($status == AppSimulation::BELUM_MEMILIH)
                    $query->whereHas('session_time', fn ($query) => $query->where('start_time', '>', now()));

                if (in_array($status, [AppSimulation::SEDANG_MEMILIH, AppSimulation::SUDAH_MEMILIH])) {

                    $query = $status == AppSimulation::SEDANG_MEMILIH ? $query->whereNull('satker_1') : $query->whereNotNull('satker_1');

                    $query->whereHas('session_time', fn ($query) => $query->where('start_time', '<=', now())->where('end_time', '>=', now()));
                }

                if ($status == AppSimulation::TIDAK_MEMILIH)
                    $query->whereNull('satker_1')
                        ->whereHas('session_time', fn ($query) => $query->where('end_time', '<', now()));
            });
    }
}
