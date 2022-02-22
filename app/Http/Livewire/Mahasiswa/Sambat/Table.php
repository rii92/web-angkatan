<?php

namespace App\Http\Livewire\Mahasiswa\Sambat;

use App\Constants\AppSambat;
use App\Models\Sambat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Str;

class Table extends DataTableComponent
{
    public string $defaultSortColumn = 'updated_at';
    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('mahasiswa.sambat.column.actions')->with('sambat', $row);
                }),
            Column::make('Isi', 'description')
                ->format(fn ($description) => view('mahasiswa.sambat.column.text')->with('value', Str::limit(strip_tags(Str::markdown($description)), 100, '...')))
                ->searchable(),
            Column::make('Komentar', 'jumlah_comments')
                ->sortable(),
            Column::make('Upvote', 'jumlah_upvote')
                ->sortable(),
            Column::make('Downvote', 'jumlah_downvote')
                ->sortable(),
            Column::make('Komentar Terakhir', 'latestComment')
                ->format(fn ($lastComment) => $lastComment ? Carbon::createFromTimeString($lastComment->created_at)->format('d-M H:i') : '-')
                ->sortable(),
            Column::make('Vote Terakhir', 'latestVote')
                ->format(fn ($lastVote) => $lastVote ? Carbon::createFromTimeString($lastVote->created_at)->format('d-M H:i') : '-')
                ->sortable(),
            Column::make('Dibuat Pada', 'created_at')
                ->format(fn ($created_at) => $created_at->format('d-M H:i'))
                ->sortable(),
            Column::make('Diedit Pada', 'updated_at')
                ->format(fn ($updated_at) => $updated_at->format('d-M H:i'))
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return Sambat::with(['user', 'userdetails', 'latestComment', 'latestVote'])
            ->withCount([
                'comments as jumlah_comments',
                'votes as jumlah_upvote' => fn (Builder $query) => $query->where('votes', AppSambat::UPVOTE),
                'votes as jumlah_downvote' => fn (Builder $query) => $query->where('votes', AppSambat::DOWNVOTE),
            ])
            ->where('user_id', auth()->id());
    }
}
