<?php

namespace App\Http\Livewire\Sambat;

use App\Models\Sambat;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Str;

class Table extends DataTableComponent
{
    public $user_id;

    public function columns(): array
    {
        return [
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('sambat.column.actions')->with('sambat', $row);
                }),
            Column::make('User','user.name')
                ->searchable(),
            Column::make('Sambatan', 'description')
                    ->searchable()
                    ->format(fn ($value) => view('sambat.column.text')->with('value', Str::limit($value, 100))),
            Column::make('Waktu Upload', 'created_at'),             
        ];
    }

    public function query(): Builder
    {
        return Sambat::with('user')
                ->when($this->user_id, function(Builder $query, $user_id){
                    $query->where('user_id', '=', $user_id);
                });
    }

}
