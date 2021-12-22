<?php

namespace App\Http\Livewire\Admin\Meetings;

use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Meeting;
use LivewireUI\Modal\ModalComponent;

class ModalDelete extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::MEETING_MANAGEMENT;

    public $meeting_id;

    public function handleForm()
    {
        try {
            $meeting = Meeting::find($this->meeting_id);
            $meeting->delete();

            $this->emit('success', "Success delete meeting");
        } catch (\Exception $e) {
            $this->emit('error', "Failed to delete meeting");
        } finally {
            $this->emit('reloadComponents', 'admin.meetings.table');
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('admin.meetings.modal-delete');
    }
}
