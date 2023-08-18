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

    public array $filters = [];

    public function mount()
    {
        // jika rolenya akademik, auto filter ke jurusan konselornya
        $user = auth()->user();
        // kecuali untuk Sindu (koor akademik), dia sendiri yang minta seperti itu
        if ($user->hasRole(AppRoles::AKADEMIK) and $user->email != "211810500@stis.ac.id")
            $this->filters  += [
                'jurusan' => [
                    $user->details->jurusan_short
                ],
            ];

        if ($user->email != "211810500@stis.ac.id")
            $this->filters  += [
                'status' => [
                    AppKonsul::STATUS_WAIT,
                    AppKonsul::STATUS_PROGRESS
                ]
            ];
    }

    public function columns(): array
    {
        return [
            Column::make('Aksi')->format(function ($value, $column, $konsul) {
                return view('admin.konsultasi.column.action')->with(['konsul' => $konsul]);
            }),
            Column::make('nama', 'name')
                ->searchable(),
            Column::make('Judul', 'title')
                ->format(fn ($title) => Str::limit($title, 30))
                ->searchable(),
            Column::make('Jurusan', 'userdetails.jurusan'),
            Column::make('status')
                ->format(function ($value, $column, $row) {
                    return view('admin.konsultasi.column.status')->with('konsul', $row);
                })->sortable(),
            Column::make('Aktivitas Terakhir', 'updated_at')
                ->format(fn ($updated_at) => $updated_at->format('d-M H:i'))
                ->sortable(),
            Column::make('Tanggal Dibuat', 'created_at')
                ->format(fn ($created_at) => $created_at->format('d-M H:i'))
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return Konsul::with('userdetails')->withCount([
            'chats as unread_chats' => function (Builder $query) {
                $query->where('konsul_chats.is_seen', false)->where('konsul_chats.is_admin', false); // get unread message from user;;
            },
        ])
            ->konsulType($this->category)
            ->when($this->getFilter('status'), function ($query, $status) {
                $query->whereIn('status', $status);
            })
            ->when($this->getFilter('is_anonim'), fn ($query, $is_anonim) => $query->where('is_anonim', $is_anonim))
            ->when($this->getFilter('is_publish'), fn ($query, $is_publish) => $query->publish())
            ->when($this->getFilter('need_publish'), function ($query, $needPublish) {
                if ($needPublish)
                    $query->where('status', AppKonsul::STATUS_DONE)
                        ->where(function ($query) {
                            $query->where('acc_publish_admin', false)
                                ->orWhere('acc_publish_user', false);
                        });
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
                ->multiSelect(AppKonsul::allJurusan(true)),
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
