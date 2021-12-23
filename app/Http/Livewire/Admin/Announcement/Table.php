<?php

namespace App\Http\Livewire\Admin\Announcement;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Announcement;
use Illuminate\Support\Str;

class Table extends DataTableComponent
{
    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make('Judul', 'title')
                ->format(function ($title) {
                    return Str::limit($title, 20);
                })
                ->searchable(),
            Column::make('Status', 'published_at')
                ->format(function ($published_at, $column, $row) {
                    return view('admin.announcement.column.status')->with(['status' => $published_at < now() ? 'Publish' : 'Unpubish', 'id' => $row->id]);
                })
                ->sortable(),
            Column::make('Tanggal Dipublish', 'published_at')
                ->sortable()
                ->format(function ($published_at) {
                    return $published_at->format('d M Y h:i A');
                }),
            Column::make('Tanggal Dibuat', 'created_at')
                ->sortable()
                ->format(function ($created_at) {
                    return $created_at->format('d M Y h:i A');
                }),
            Column::make('Action')
                ->format(function ($value, $column, $row) {
                    return view('admin.announcement.column.action')->with('announcement', $row);
                }),
        ];
    }

    public function query(): Builder
    {
        return Announcement::query();
    }
}
