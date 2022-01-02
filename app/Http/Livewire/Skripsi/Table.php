<?php

namespace App\Http\Livewire\Skripsi;

use App\Constants\AppRoles;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Str;

class Table extends DataTableComponent
{

    public bool $columnSelect = true;

    public function columns(): array
    {
        return [
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('skripsi.column.actions')->with('user', $row);
                })->excludeFromSelectable(),
            Column::make('NIM', 'details.nim')
                ->searchable()
                ->excludeFromSelectable(),
            Column::make('name')
                ->searchable()
                ->excludeFromSelectable(),
            Column::make('Kelas', 'details.kelas')
                ->searchable()
                ->excludeFromSelectable(),
            Column::make('Dosen Pembimbing', 'details.skripsi_dosbing')
                ->searchable()
                ->excludeFromSelectable(),
            Column::make('Judul Skripsi', 'details.skripsi_judul')
                ->searchable()
                ->excludeFromSelectable()
                ->format(fn ($value) => view('skripsi.column.text')->with('value', $value)),
            Column::make('Metode', 'details.skripsi_metode')
                ->searchable()
                ->format(fn ($value) => view('skripsi.column.text')->with('value', Str::limit($value, 100))),
            Column::make('Variabel Dependen', 'details.skripsi_variabel_dependent')
                ->searchable()
                ->format(fn ($value) => view('skripsi.column.text')->with('value', Str::limit($value, 100))),
            Column::make('Variabel Independen', 'details.skripsi_variabel_independent')
                ->searchable()
                ->format(fn ($value) => view('skripsi.column.text')->with('value', Str::limit($value, 100))),
        ];
    }

    public function query()
    {
        return User::role([AppRoles::USERS, AppRoles::D3_61])->with('details');
    }
}
