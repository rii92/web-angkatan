<?php

namespace App\Http\Livewire\Admin\Roles;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Spatie\Permission\Models\Permission;

class TablePermission extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable()
                ->searchable(),
            Column::make('Permission', 'name')
                ->sortable()
                ->searchable()
        ];
    }

    public function query(): Builder
    {
        return Permission::query();
    }
}
