<?php

namespace App\Http\Livewire\Admin\Konsultasi;

use App\Models\Konsul;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Str;

class Table extends DataTableComponent
{
    public $category;
    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make('nama', 'name')
                ->searchable(),
            Column::make('Judul', 'title')
                ->format(function ($title) {
                    return Str::limit($title, 30);
                })
                ->searchable(),
            Column::make('Jurusan', 'userdetails.kelas')
                ->format(function ($kelas) {
                    return substr($kelas, 1, 2);
                }),
            Column::make('status')
                ->format(function ($value, $column, $row) {
                    return view('admin.konsultasi.column.status')->with('konsul', $row);
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
            Column::make('Aksi')->format(function ($value, $column, $konsul) {
                return view('admin.konsultasi.column.action')->with(['konsul' => $konsul]);
            }),
        ];
    }

    public function query(): Builder
    {
        return Konsul::with('userdetails')->konsulType($this->category);
    }
}
