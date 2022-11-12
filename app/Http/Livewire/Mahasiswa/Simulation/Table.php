<?php

namespace App\Http\Livewire\Mahasiswa\Simulation;

use App\Models\Simulations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Str;

class Table extends DataTableComponent
{
    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public bool $showSearch = false;
    public bool $showPerPage = false;

    public function columns(): array
    {
        return [
            Column::make('title')
                ->searchable()
                ->format(fn ($value) => Str::limit($value, 40)),
            Column::make('Status')
                ->format(fn ($value, $column, $row) => view('mahasiswa.simulation.column.status')
                    ->with(['start_time' => $row->start_time, 'end_time' => $row->end_time])),
            Column::make('Jumlah Sesi', 'sesi_count'),
            Column::make('mulai', 'start_time')
                ->format(fn ($value, $column, $row) => Carbon::create($row->start_time)->format('d M Y h:i A')),
            Column::make('berakhir', 'end_time')
                ->format(fn ($value, $column, $row) => Carbon::create($row->end_time)->format('d M Y h:i A')),

        ];
    }

    public function getTableRowUrl($row): string
    {
        return route('user.simulasi.details', $row->id);
    }

    public function query(): Builder
    {
        return Simulations::withMin('times as start_time', 'start_time')
            ->withMax('times as end_time', 'end_time')
            ->withCount('times as sesi_count');
    }
}
