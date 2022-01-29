<?php

namespace App\Http\Livewire\Mahasiswa\Konsultasi;

use App\Models\Konsul;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Str;

class Table extends DataTableComponent
{
    public $category, $is_admin;
    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make('Judul', 'title')
                ->format(function ($title) {
                    return Str::limit($title, 30);
                })
                ->searchable(),
            Column::make('status')
                ->format(function ($value, $column, $row) {
                    return view('mahasiswa.konsultasi.column.status')->with('konsul', $row);
                })->sortable(),
            Column::make('Tanggal Dibuat', 'created_at')
                ->format(function ($created_at) {
                    return $created_at->format('d-M H:i');
                })
                ->sortable(),
            Column::make('Aktivitas Terakhir', 'updated_at')
                ->format(function ($updated_at) {
                    return $updated_at->format('d-M H:i');
                })
                ->sortable(),
            Column::make('Aksi')->format(function ($value, $column, $row) {
                return view('mahasiswa.konsultasi.column.action')->with('konsul', $row);
            }),
        ];
    }

    public function query(): Builder
    {
        return Konsul::konsulType($this->category)
            ->where('user_id', auth()->user()->id);
    }
}
