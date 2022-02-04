<?php

namespace App\Http\Livewire\Admin\Timelines;

use App\Models\Timeline;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Str;

class Table extends DataTableComponent
{

    public string $defaultSortColumn = 'start_date';
    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make('title')
                ->format(function ($value) {
                    return Str::limit($value, 40);
                })
                ->searchable(),
            Column::make('Start Date', 'start_date')
                ->format(function ($value) {
                    return $value->format('d M Y');
                })
                ->sortable(),
            Column::make('End Date', 'end_date')
                ->format(function ($value) {
                    return $value->format('d M Y');
                })
                ->sortable(),
            Column::make('color')
                ->format(function ($value) {
                    return view('admin.timelines.column.color', ["color" => $value]);
                }),
            Column::make('Action')
                ->format(function ($value, $column, $row) {
                    return view('admin.timelines.column.action', ['timeline' => $row]);
                })
        ];
    }

    public function query(): Builder
    {
        return Timeline::query();
    }
}
