<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class Table extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('id')
                ->searchable()
                ->sortable(),
            Column::make('name')
                ->searchable()
                ->sortable(),
            Column::make('email')
                ->searchable()
                ->sortable(),
            Column::make('Registered At', 'created_at')
                ->sortable(),
            Column::make('Role')
                ->format(function ($value, $column, $user) {
                    if ($user->hasRole('admin')) $role = "admin";
                    else $role = "user";

                    return view('admin.users.column.role')->with('role', $role);
                }),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('admin.users.column.actions')->with('user', $row);
                }),
        ];
    }

    public function query(): Builder
    {
        return User::query()
            ->when($this->getFilter('role'), fn ($query, $role) => $query->role($role));;
    }

    public function filters(): array
    {
        return [
            'role' => Filter::make('Role User')
                ->select([
                    '' => 'Any',
                    'users' => 'Regular Users',
                    'admin' => 'Admin'
                ]),
        ];
    }
}