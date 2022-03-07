<?php

namespace App\Http\Livewire\Admin\Meetings;

use App\Constants\AppMeetings;
use App\Models\Meeting;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class Table extends DataTableComponent
{
    public string $defaultSortColumn = 'started_at';
    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make('Action')
                ->format(function ($value, $column, $row) {
                    return view('admin.meetings.column.action')->with('meeting', $row);
                }),
            Column::make('name')
                ->searchable()
                ->sortable()
                ->format(function ($value) {
                    return Str::limit($value, 40);
                }),
            Column::make('Open', 'is_open')
                ->format(function ($value) {
                    return view('admin.meetings.column.open')->with('is_open', $value);
                }),
            Column::make('mulai', 'started_at')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return $row->started_at->format('d M Y h:i A');
                }),
            Column::make('hadir', 'present'),
            Column::make('izin', 'has_permission'),
            Column::make('tidak_hadir', 'not_present'),
            Column::make('description')
                ->format(function ($value) {
                    return Str::limit($value, 40);
                }),
        ];
    }

    public function query(): Builder
    {
        return Meeting::withCount([
            'members as present' => function ($query) {
                $query->where('status', AppMeetings::PRESENT);
            },
            'members as has_permission' => function ($query) {
                $query->where('status', AppMeetings::HAS_PERMISSION);
            },
            'members as not_present' => function ($query) {
                $query->where('status', AppMeetings::NOT_PRESENT);
            }
        ])->when($this->getFilter('open'), fn ($query, $is_open) => $query->where('is_open', $is_open));
    }

    public function filters(): array
    {
        return [
            'open' => Filter::make('Open')
                ->select([
                    '' => 'All',
                    1 => 'Open',
                ])
        ];
    }
}
