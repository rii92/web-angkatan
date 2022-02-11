<?php

namespace App\Http\Livewire\Mahasiswa\Skripsi;

use App\Constants\AppRoles;
use App\Exports\SkripsiExport;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class Table extends DataTableComponent
{

    public bool $columnSelect = true;

    public array $bulkActions = [
        'exportSelected' => 'Export Excel',
    ];

    public function columns(): array
    {
        return [
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('mahasiswa.skripsi.column.actions')->with('user', $row);
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
                ->format(fn ($value) => view('mahasiswa.skripsi.column.text')->with('value', $value)),
            Column::make('Metode', 'details.skripsi_metode')
                ->searchable()
                ->format(fn ($value) => view('mahasiswa.skripsi.column.text')->with('value', Str::limit($value, 100))),
            Column::make('Variabel Dependen', 'details.skripsi_variabel_dependent')
                ->searchable()
                ->format(fn ($value) => view('mahasiswa.skripsi.column.text')->with('value', Str::limit($value, 100))),
            Column::make('Variabel Independen', 'details.skripsi_variabel_independent')
                ->searchable()
                ->format(fn ($value) => view('mahasiswa.skripsi.column.text')->with('value', Str::limit($value, 100))),
        ];
    }

    public function query()
    {
        return User::role([AppRoles::USERS, AppRoles::D3_61])
            ->with('details')
            ->when($this->getFilter('jurusan'), function ($query, $jurusan) {
                $query->whereHas('details', function (Builder $query) use ($jurusan) {
                    $first = true;
                    foreach ($jurusan as $j) {
                        if ($first) {
                            $query->where('kelas', "like", "%{$j}%");
                            $first = false;
                        } else
                            $query->orWhere('kelas', "like", "%{$j}%");
                    }
                });
            })
            ->when($this->getFilter('kelas'), function ($query, $kelas) {
                $query->whereHas('details', function (Builder $query) use ($kelas) {
                    $query->whereIn('kelas', $kelas);
                });
            });
    }

    /**
     * export to xlsx file
     *
     * @return void
     */
    public function exportSelected()
    {
        if ($this->selectedRowsQuery->count() == 0) return $this->emit('error', "Pilih Row Terlebih Dahulu");

        try {
            return (new SkripsiExport($this->selectedRowsQuery()))->download("Data-Skripsi " . now()->format('d-M-Y H-i') . ".xlsx");
        } catch (\Throwable $th) {
            return $this->emit('error', "Somethings Wrong, I can feel It");
        }
    }

    public function filters(): array
    {
        $allKelas = UserDetails::select('kelas')
            ->orderBy('kelas')
            ->where('kelas', '!=', 'Alum')
            ->distinct()
            ->get()
            ->pluck('kelas')
            ->toArray();

        $kelas = [];
        foreach ($allKelas as $k) {
            $kelas[$k] = $k;
        }

        return [
            'jurusan' => Filter::make('Jurusan')
                ->multiSelect([
                    'SD' => 'SD',
                    'SI' => 'SI',
                    'SK' => 'SK',
                    'SE' => 'SE',
                    'D3' => 'D3 61'
                ]),
            'kelas' => Filter::make('Kelas')
                ->multiSelect($kelas),
        ];
    }
}
