<?php

namespace App\Http\Livewire\Mahasiswa\Sambat;

use App\Models\Sambat;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Str;

class Table extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('mahasiswa.sambat.column.actions')->with('sambat', $row);
                }),
            Column::make('User', 'user.name')
                ->searchable(),
            Column::make('Waktu Upload', 'created_at')->sortable(),
        ];
    }

    public function query(): Builder
    {
        return Sambat::with('user')
            ->where('user_id', auth()->id());
    }
}
