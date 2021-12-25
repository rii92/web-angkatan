<?php

namespace App\Http\Livewire\Admin\Meetings;

use App\Constants\AppMeetings;
use App\Models\MeetingMember;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class TableMember extends DataTableComponent
{
    public string $defaultSortColumn = 'id';
    public string $defaultSortDirection = 'desc';

    public $meeting_id;

    public array $bulkActions = [
        'bulkDelete' => 'Delete Selected',
    ];

    public function columns(): array
    {
        return [
            Column::make('nama', 'user.name')
                ->format(fn ($value, $column, $row) => $row->user->name),
            Column::make('kehadiran', 'attend_at')
                ->sortable()
                ->format(function ($value, $column, $row) {
                    return $row->attend_at ? $row->attend_at->format('d M Y h:i A') : null;
                }),
            Column::make('status')
                ->format(function ($value) {
                    return view('admin.meetings.column.status-member')->with('status', $value);
                }),
            Column::make('Action')
                ->format(function ($value, $column, $row) {
                    return view('admin.meetings.column.action-member')->with('meeting_member', $row);
                }),
        ];
    }

    public function query(): Builder
    {
        return MeetingMember::where('meeting_id', $this->meeting_id)
            ->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status));
    }

    public function filters(): array
    {
        return [
            'status' => Filter::make('Status')
                ->select(array_merge(['' => 'All'], AppMeetings::allStatus()))
        ];
    }

    public function bulkDelete()
    {
        if ($this->selectedRowsQuery->count() == 0) return $this->emit('error', "Please select data");

        try {
            $count = $this->selectedRowsQuery->count();
            $this->selectedRowsQuery()->delete();
            $this->emit('success', "Success delete {$count} rows");
        } catch (\Throwable $th) {
            return $this->emit('error', "Somethings wrong, I can feel it");
        } finally {
            return $this->emit('reloadComponents', 'admin.meetings.table');
        }
    }
}
