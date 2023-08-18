<?php

namespace App\Http\Livewire\Mahasiswa\Simulation;

use App\Constants\AppSimulation;
use App\Exports\UserFormationExport;
use App\Models\Location;
use App\Models\Simulations;
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

    public array $bulkActions = [
        'exportSelected' => 'Export Excel',
    ];

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
            Column::make('satker final')
                ->format(function ($value, $column, $row) {
                    if (!$row->satkerfinal)
                        return '';
                    return view('mahasiswa.simulation.column.kabupaten', ['kabupaten' => $row->satkerfinal->name, 'satker_id' => $row->satker_final, 'simulations_id' => $row->simulations_id]);
                })
                ->searchable(),
            Column::make('Provinsi')
                ->format(function ($value, $column, $row) {
                    if (!$row->satkerfinal)
                        return '';
                    return view('mahasiswa.simulation.column.provinsi', ['provinsi' => $row->satkerfinal->location->provinsi, 'simulations_id' => $row->simulations_id]);
                }),
            Column::make('Status Pemilihan')
                ->format(fn ($value, $column, $row) => view("mahasiswa.simulation.column.status-pemilihan", [
                    'start' => $row->session_time->start_time,
                    'end' => $row->session_time->end_time,
                    'pilihan_pertama' => $row->satker_1
                ])),
            Column::make('Status Pilihan', 'status_pilihan')
                ->format(fn ($value) => view("mahasiswa.simulation.column.status-pilihan", ['status_pilihan' => $value])),
            Column::make("rank " . AppSimulation::BASED_ON, "user_rank")
                ->sortable()
                ->format($centeredColumnFormat),
            Column::make("sesi", "session")
                ->format(fn ($value) => $centeredColumnFormat($value + 1)),
        ];
    }

    public function filters(): array
    {
        return [
            AppSimulation::BASED_ON => Filter::make(AppSimulation::BASED_ON)
                ->select(array_merge(['' => "All"], AppSimulation::BASED_ON())),
            'provinsi' => Filter::make('provinsi')
                ->select(array_merge(['' => "All"], AppSimulation::PROVINSI_FILTER())),
            'status_pemilihan' => Filter::make('status_pemilihan')
                ->select(array_merge(['' => "All"], AppSimulation::STATUS_PEMILIHAN())),
            'sesi' => Filter::make('sesi')
                ->select(array_merge(['' => "All"], AppSimulation::SESSION_FILTER($this->simulation_id))),
            'status_pilihan' => Filter::make('status_pilihan')
                ->select(array_merge(['' => "All"], AppSimulation::STATUS_PILIHAN()))
        ];
    }

    public function query()
    {
        return UserFormations::with(['user', 'satkerfinal', 'session_time', 'satkerfinal.location'])
            ->where("simulations_id", $this->simulation_id)
            ->when($this->getFilter(AppSimulation::BASED_ON), function ($query, $formation) {
                $query->where("based_on", $formation);
            })
            ->when($this->getFilter('provinsi'), function ($query, $provinsi) {
                $query->whereHas("satkerfinal.location", function ($query) use ($provinsi) {
                    $query->where('provinsi', $provinsi);
                });
            })
            ->when($this->getFilter('status_pemilihan'), function ($query, $status) {
                if ($status == AppSimulation::BELUM_MEMILIH)
                    $query->whereHas('session_time', fn ($query) => $query->where('start_time', '>', now()));

                if (in_array($status, [AppSimulation::SEDANG_MEMILIH, AppSimulation::SUDAH_MEMILIH])) {

                    $query = $status == AppSimulation::SEDANG_MEMILIH ? $query->whereNull('satker_1') : $query->whereNotNull('satker_1');

                    $query->whereHas('session_time', fn ($query) => $query->where('start_time', '<=', now())->where('end_time', '>=', now()));
                }

                if ($status == AppSimulation::TIDAK_MEMILIH)
                    $query->whereNull('satker_1')
                        ->whereHas('session_time', fn ($query) => $query->where('end_time', '<', now()));
            })
            ->when($this->getFilter('sesi'), fn ($query, $sesi) => $query->where('session', $sesi - 1))
            ->when($this->getFilter('status_pilihan'), function ($query, $pilihan) {
                if ($pilihan == AppSimulation::PILIHAN_AMAN) $query->where('status_pilihan', AppSimulation::STATUS_PILIHAN_AMAN);

                if ($pilihan == AppSimulation::PILIHAN_TIDAK_AMAN) $query->where('status_pilihan', AppSimulation::STATUS_PILIHAN_TIDAK_AMAN);

                if ($pilihan == AppSimulation::PILIHAN_MENUNGGU) $query->where('status_pilihan', AppSimulation::STATUS_PILIHAN_MENUNGGU);
            });
    }

    /**
     * export to xlsx file
     *
     * @return void
     */
    public function exportSelected()
    {
        if ($this->selectedRowsQuery->count() == 0) return $this->emit('error', "Pilih Row Terlebih Dahulu");

        $simulasi = Simulations::find($this->simulation_id);

        return (new UserFormationExport($this->selectedRowsQuery()))->download($simulasi->title . "_" . now()->format('d-M-Y H-i') . ".xlsx");
        try {
        } catch (\Throwable $th) {
            return $this->emit('error', "Somethings Wrong, I can feel It");
        }
    }
}
