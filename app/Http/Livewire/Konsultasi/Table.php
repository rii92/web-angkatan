<?php

namespace App\Http\Livewire\Konsultasi;

use App\Models\Konsul;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Table extends DataTableComponent
{

    public $catagory,$is_admin;
    private $data;
    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make('Judul', 'title')->searchable(),
            Column::make('Nama', 'user.name')->sortable()->searchable(),
            Column::make('Status')->format(function ($value, $column, $row) {
                return view('konsultasi.column.status')->with('konsul', $row);
            })->sortable(),
            Column::make('Tanggal Dibuat', 'created_at')->format(function ($created_at) {
                return $created_at->format('d-M H:i');
            })->sortable(),
            Column::make('Aksi')->format(function ($value, $column, $row) {
                return view('konsultasi.column.action')->with('konsul', $row);
            }),
        ];
    }

    public function query(): Builder
    {
        $this->data = Konsul::with('user')->where('catagory', '=', $this->catagory);
        if (!$this->is_admin) $this->data = $this->data->where('user_id', '=', Auth::id());
        // dd($this->data->get()->toArray());
        return $this->data;
    }
}