<?php

namespace App\Http\Livewire\Admin\Simulasi\Satker;

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
                ->format(fn ($value, $column, $row) => view('admin.simulasi.satker.column.action')->with('satker', $row)),
            Column::make("name")
                ->searchable()
                ->excludeFromSelectable(),
            Column::make("location")
                ->format(function ($value, $column, $row) {
                    if (!$row->location) return "";
                    return $row->location->kabupaten . ", " . $row->location->provinsi;
                }),
            Column::make("d3", "d3_formation")
                ->excludeFromSelectable(),
            Column::make("ks", "ks_formation")
                ->excludeFromSelectable(),
            Column::make("st", "st_formation")
                ->excludeFromSelectable(),
            Column::make("se", "se_formation"),
            Column::make("sk", "sk_formation"),
            Column::make("si", "si_formation"),
            Column::make("sd", "sd_formation"),
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
            return $this->emit('error', $e->getMessage());
        }
    }

    public function query()
    {
        return Satker::with('location');
    }
}
