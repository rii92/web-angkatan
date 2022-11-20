<?php

namespace App\Http\Livewire\Admin\Satker;

use App\Models\Satker;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Table extends DataTableComponent
{

    public string $defaultSortColumn = 'location_id';
    public string $defaultSortDirection = 'desc';

    public bool $columnSelect = true;

    public array $bulkActions = [
        'bulkDelete' => 'Bulk Delete',
    ];

    public function columns(): array
    {
        return [
            Column::make('Action')
                ->format(fn ($value, $column, $row) => view('admin.satker.column.action')->with('satker', $row)),
            Column::make("name")
                ->searchable()
                ->excludeFromSelectable(),
            Column::make("location")
                ->format(fn ($value, $column, $row) => $row->location ? $row->location->full_location : ""),
            Column::make("d3", "d3")
                ->excludeFromSelectable(),
            Column::make("ks", "ks")
                ->excludeFromSelectable(),
            Column::make("st", "st")
                ->excludeFromSelectable(),
            Column::make("se", "se"),
            Column::make("sk", "sk"),
            Column::make("si", "si"),
            Column::make("sd", "sd"),
        ];
    }

    public function bulkDelete()
    {
        if ($this->selectedRowsQuery->count() == 0) return $this->emit('error', "Pilih Row Terlebih Dahulu");

        try {
            $this->selectedRowsQuery()->delete();

            $this->resetBulk();

            return $this->emit('success', "Berhasil menghapus satker terpilih");
        } catch (\Exception $e) {
            return $this->emit('error', "Gagal menghapus satker terpilih");
        }
    }

    public function query()
    {
        return Satker::with('location');
    }
}
