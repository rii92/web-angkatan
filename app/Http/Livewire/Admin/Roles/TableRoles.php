<?php

namespace App\Http\Livewire\Admin\Roles;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Spatie\Permission\Models\Role;

class TableRoles extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),
            Column::make('Role', 'name')
                ->format(function ($value, $column, $row) {
                    return view('admin.users.column.role')->with('role', $row['name']);
                })
                ->sortable()
                ->searchable(),
            Column::make('Action')
                ->format(function ($value, $column, $role) {
                    return view('admin.roles.column.action')->with('role', $role);
                })
        ];
    }

    public function query(): Builder
    {
        return Role::query();
    }
}
