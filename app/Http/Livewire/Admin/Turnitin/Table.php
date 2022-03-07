<?php

namespace App\Http\Livewire\Admin\Turnitin;

use App\Constants\AppTurnitins;
use App\Models\UserTurnitin;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class Table extends DataTableComponent
{
    public string $defaultSortColumn = 'updated_at';
    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make('action')
                ->format(function ($value, $column, $row) {
                    return view('admin.turnitin.column.action', ['turnitin' => $row]);
                }),
            Column::make('nama', 'user.name')
                ->searchable(),
            Column::make('status')
                ->format(function ($status) {
                    return view('components.turnitin.status', ['status' => $status]);
                }),
            Column::make('Link File', 'link_file')
                ->format(function ($link) {
                    return view('components.turnitin.link', ['link' => $link]);
                }),
            Column::make('Link Hasil Pengecekan', 'link_hasil')
                ->format(function ($link) {
                    return view('components.turnitin.link', ['link' => $link]);
                }),
            Column::make('Aktivitas Terakhir', 'updated_at')
                ->sortable()
                ->format(function ($value) {
                    return $value->format('d-M H:i');
                }),
            Column::make('Tanggal Pengajuan', 'created_at')
                ->sortable()
                ->format(function ($value) {
                    return $value->format('d-M H:i');
                }),
        ];
    }

    public function query(): Builder
    {
        return UserTurnitin::with('user')
            ->when($this->getFilter('status'), function ($query, $status) {
                $query->whereIn('status', $status);
            });
    }

    public function filters(): array
    {
        return [
            'status' => Filter::make('Status')
                ->multiSelect(AppTurnitins::allStatus(true)),
        ];
    }
}
