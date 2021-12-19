<?php

namespace App\Http\Livewire\Admin\Roles;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class TablePermission extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable()
                ->searchable(),
            Column::make('Permission', 'name')
                ->format(function ($value, $column, $row) {
                    return Str::of($row->name)->replace('_', ' ')->title();
                })
                ->sortable()
                ->searchable(),
            Column::make('Description', 'description')
        ];
    }

    public function query(): Builder
    {
        return Permission::query();
    }
}
