<?php

namespace App\Http\Livewire\Admin\Meetings;

use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\MeetingMember;
use LivewireUI\Modal\ModalComponent;

class ModalEditMember extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::MEETING_MANAGEMENT;

    public $meeting_member_id;
    public $meetingMember;

    public static function closeModalOnClickAway(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'meetingMember.status' => 'required',
        ];
    }

    public function mount()
    {
        $this->meetingMember = MeetingMember::find($this->meeting_member_id);
    }

    public function handleStatus()
    {
        $this->validate();
        try {
            $this->meetingMember->save();
            $this->emit('success', "Success delete member");
        } catch (\Exception $e) {
            $this->emit('error', "Failed to delete member");
        } finally {
            $this->emit('reloadComponents', 'admin.meetings.table-member');
            $this->emit('closeModal');
        }
    }

    public function handleDelete()
    {
        try {
            $this->meetingMember->delete();
            $this->emit('success', "Success delete member");
        } catch (\Exception $e) {
            $this->emit('error', "Failed to delete member");
        } finally {
            $this->emit('reloadComponents', 'admin.meetings.table-member');
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('admin.meetings.modal-edit-member');
    }
}
