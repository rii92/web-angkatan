<?php

namespace App\Http\Livewire\Admin\Satker;

use App\Constants\AppSimulation;
use App\Models\Satker;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Str;

class Table extends DataTableComponent
{
    public string $defaultSortColumn = 'location_id';

    public string $defaultSortDirection = 'desc';

    public array $bulkActions = [
        'bulkDelete' => 'Bulk Delete',
    ];

    public function columns(): array
    {
        $centeredColumnFormat = fn ($value) => view("admin.satker.column.center", ['value' => $value]);

        $formationColumns = [];

        foreach (AppSimulation::BASED_ON() as $key => $value)
            array_push($formationColumns, Column::make(Str::upper($key), $key)->format($centeredColumnFormat));

        return array_merge([
            Column::make('Action')
                ->format(fn ($value, $column, $row) => view('admin.satker.column.action')->with('satker', $row)),
            Column::make("Kode Wilayah", "kode_wilayah")
                ->searchable()
                ->sortable()
                ->format($centeredColumnFormat),
            Column::make("name")
                ->searchable(),
            Column::make("location")
                ->format(fn ($value, $column, $row) => $row->location ? $row->location->full_location : ""),
        ], $formationColumns);
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
