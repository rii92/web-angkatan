<?php

namespace App\Http\Livewire\Admin\Konsultasi;

use App\Constants\AppKonsul;
use App\Constants\AppRoles;
use App\Models\Konsul;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class Table extends DataTableComponent
{
    public $category;
    public string $defaultSortColumn = 'updated_at';
    public string $defaultSortDirection = 'desc';
    public array $filters = [
        'status' => [AppKonsul::STATUS_WAIT, AppKonsul::STATUS_PROGRESS],
    ];

    public function mount()
    {
        // jika rolenya akademik, auto filter ke jurusan konselernya
        $user = auth()->user();
        if ($user->hasRole(AppRoles::AKADEMIK))
            $this->filters  += ['jurusan' => [$user->details->jurusan]];
    }

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
            Column::make('Jurusan', 'userdetails.jurusan'),
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
        return Konsul::with('userdetails')
            ->konsulType($this->category)
            ->when($this->getFilter('status'), function ($query, $status) {
                $query->whereIn('status', $status);
            })
            ->when($this->getFilter('is_anonim'), fn ($query, $is_anonim) => $query->where('is_anonim', $is_anonim))
            ->when($this->getFilter('is_publish'), fn ($query, $is_publish) => $query->where('is_publish', $is_publish))
            ->when($this->getFilter('need_publish'), function ($query, $needPublish) {
                if ($needPublish)
                    $query->where('is_publish', false)->where('status', AppKonsul::STATUS_DONE);
            })
            ->when($this->getFilter('jurusan'), function ($query, $jurusan) {
                $query->whereHas('userdetails', function (Builder $query) use ($jurusan) {
                    $first = true;
                    foreach ($jurusan as $j) {
                        if ($first) {
                            $query->where('kelas', "like", "%{$j}%");
                            $first = false;
                        } else
                            $query->orWhere('kelas', "like", "%{$j}%");
                    }
                });
            });
    }

    public function filters(): array
    {
        return [
            'jurusan' => Filter::make('Jurusan')
                ->multiSelect([
                    'SD' => 'SD',
                    'SI' => 'SI',
                    'SK' => 'SK',
                    'SE' => 'SE',
                ]),
            'status' => Filter::make('Status')
                ->multiSelect(AppKonsul::allStatus(true)),
            'need_publish' => Filter::make('Need Publish')
                ->select([
                    false => 'All',
                    true => 'Ya',
                ]),
            'is_anonim' => Filter::make('Is Anonim')
                ->select([
                    '' => 'All',
                    1 => 'Ya',
                ]),
            'is_publish' => Filter::make('Is Publish')
                ->select([
                    '' => 'All',
                    1 => 'Ya',
                ])
        ];
    }
}
