<?php

namespace App\Http\Livewire\Sambat;

use App\Models\Sambat;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Str;

class Table extends DataTableComponent
{
    public bool $dumpFilters = true;
    public function columns(): array
    {
        return [
            // Column::make('Actions')
            //     ->format(function ($value, $column, $row) {
            //         return view('sambat.details')->with('sambat', $row);
            //     }),
            Column::make('Sambatan', 'description')
                    ->searchable()
                    ->format(fn ($value) => view('sambat.column.text')->with('value', Str::limit($value, 50))),
            Column::make('Waktu Upload', 'created_at'),
                
        ];
    }

    public function query(): Builder
    {
        return Sambat::query();
    }

}
