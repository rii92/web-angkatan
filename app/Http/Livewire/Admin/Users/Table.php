<?php

namespace App\Http\Livewire\Admin\Users;

use App\Constants\AppRoles;
use App\Exports\UsersDetailsExport;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class Table extends DataTableComponent
{

    public array $bulkActions = [
        'exportSelected' => 'Export Excel',
    ];

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
            Column::make('Last Activity', 'session.last_activity'),
            Column::make('Role')
                ->format(function ($value, $column, $user) {
                    return view('admin.users.column.role')->with('user', $user);
                }),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('admin.users.column.actions')->with('user', $row);
                }),
        ];
    }

    public function query(): Builder
    {
        return User::with('roles', 'session')
            ->when($this->getFilter('role'), fn ($query, $role) => $query->role($role));
    }

    public function filters(): array
    {
        return [
            'role' => Filter::make('Role User')
                ->select(array_merge(['' => 'All'], AppRoles::allRoles()))
        ];
    }

    /**
     * export to xlsx file
     *
     * @return void
     */
    public function exportSelected()
    {
        if ($this->selectedRowsQuery->count() == 0) return $this->emit('error', "Pilih Row Terlebih Dahulu");

        try {
            return (new UsersDetailsExport($this->selectedRowsQuery()))->download("Data-User " . now()->format('d-M-Y H-i') . ".xlsx");
        } catch (\Throwable $th) {
            return $this->emit('error', "Somethings Wrong, I can feel It");
        }
    }
}
