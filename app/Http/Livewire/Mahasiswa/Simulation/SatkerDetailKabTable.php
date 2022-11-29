<?php

namespace App\Http\Livewire\Mahasiswa\Simulation;

use App\Constants\AppSimulation;
use App\Models\UserFormations;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class SatkerDetailKabTable extends DataTableComponent
{
    public int $simulation_id;
    public int $satker_id;

    public array $perPageAccepted = [10, 15];


    public function columns(): array
    {
        $centeredColumnFormat = fn ($value) => view("mahasiswa.simulation.column.center", ['value' => $value]);

        return [
            Column::make('action')
                ->format(fn ($value, $column, $row) => view('mahasiswa.simulation.column.detail-user', ['user_formation' => $row])),
            Column::make('status', 'is_final')
                ->format(fn ($value) => view('mahasiswa.simulation.column.status-terpilih', ['terpilih' => $value, 'tag' => 'div'])),
            Column::make('Nama', 'user.name')->searchable(),
            Column::make('Pilihan Ke', 'pilihan_ke')
                ->format($centeredColumnFormat),
            Column::make('Kelas', 'user.details.kelas')
                ->format($centeredColumnFormat),
            Column::make('jurusan', 'based_on')
                ->format($centeredColumnFormat),
            Column::make('Rank ' . AppSimulation::BASED_ON, "user_rank")
                ->format($centeredColumnFormat)
        ];
    }

    private function getPilihanKe($pilihanKe)
    {
        return UserFormations::with(['user', 'user.details'])
            ->select('*')
            ->selectRaw("'Pilihan {$pilihanKe}' as pilihan_ke")
            ->selectRaw("satker_{$pilihanKe} = satker_final as is_final")
            ->where('simulations_id', $this->simulation_id)
            ->where("satker_{$pilihanKe}", $this->satker_id)
            ->when(
                $this->getFilter('status'),
                fn ($query, $status) => $query->whereRaw('satker_final ' . $status . " satker_{$pilihanKe}")
            )->when($this->getFilter('jurusan'), fn ($query, $jurusan) => $query->where('based_on', $jurusan));
    }

    public function query()
    {
        if ($this->getFilter('pilihan'))
            $query = $this->getPilihanKe($this->getFilter('pilihan'));
        else
            $query = $this->getPilihanKe(1)
                ->union($this->getPilihanKe(2))
                ->union($this->getPilihanKe(3));

        return $query->orderBy('is_final', 'desc')
            ->orderBy('based_on', 'asc')
            ->orderBy('user_rank', 'asc')
            ->orderBy('pilihan_ke', 'asc');
    }

    public function filters(): array
    {
        return [
            'status' => Filter::make('status')
                ->select([
                    '' => 'All',
                    '!=' => 'tidak terpilih',
                    '=' => 'terpilih'
                ]),
            'jurusan' => Filter::make('jurusan')
                ->select(array_merge(['' => 'All'], AppSimulation::BASED_ON())),
            'pilihan' => Filter::make('pilihan')
                ->select([
                    '' => 'All',
                    1 => 'Pertama',
                    2 => 'Kedua',
                    3 => 'Ketiga'
                ])
        ];
    }
}
