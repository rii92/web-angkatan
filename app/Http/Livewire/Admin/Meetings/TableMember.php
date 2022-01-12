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
        "bulkUpdate('" . AppMeetings::PRESENT . "')" => 'Update Hadir',
        "bulkUpdate('" . AppMeetings::HAS_PERMISSION . "')" => 'Update Izin',
        "bulkUpdate('" . AppMeetings::NOT_PRESENT . "')" => 'Update Tidak Hadir'
    ];

    public function columns(): array
    {
        return [
            Column::make('nama', 'user.name')
                ->searchable(),
            Column::make('email', 'user.email')
                ->searchable(),
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
        $count = $this->selectedRowsQuery->count();
        if (!$count) return $this->emit('error', "Please select row first");

        try {
            $this->selectedRowsQuery()->delete();
            $this->resetBulk();
            $this->emit('success', "Success delete {$count} rows");
        } catch (\Throwable $th) {
            return $this->emit('error', "Somethings wrong, I can feel it");
        } finally {
            return $this->emit('reloadComponents', 'admin.meetings.table');
        }
    }

    public function bulkUpdate($status)
    {
        $count = $this->selectedRowsQuery->count();
        if (!$count) return $this->emit('error', "Please select row first");

        try {
            switch ($status) {
                case AppMeetings::PRESENT:
                    $this->selectedRowsQuery()->update(['status' => AppMeetings::PRESENT]);
                    break;
                case AppMeetings::NOT_PRESENT:
                    $this->selectedRowsQuery()->update(['status' => AppMeetings::NOT_PRESENT]);
                    break;
                default:
                    $this->selectedRowsQuery()->update(['status' => AppMeetings::HAS_PERMISSION]);
                    break;
            }
            $this->resetBulk();
            $this->emit('success', "Success update {$count} rows");
        } catch (\Throwable $th) {
            return $this->emit('error', "Somethings wrong, I can feel it");
        } finally {
            return $this->emit('reloadComponents', 'admin.meetings.table');
        }
    }
}
