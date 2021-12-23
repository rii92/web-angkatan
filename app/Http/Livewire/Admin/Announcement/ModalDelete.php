<?php

namespace App\Http\Livewire\Admin\Announcement;

use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Announcement;
use LivewireUI\Modal\ModalComponent;

class ModalDelete extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::ANNOUNCEMENT_MANAGEMENT;

    public $announcement_id;

    public function handleForm()
    {
        try {
            $meeting = Announcement::find($this->announcement_id);
            $meeting->delete();

            $this->emit('success', "Success delete announcement");
        } catch (\Exception $e) {
            $this->emit('error', "Failed to delete announcement");
        } finally {
            $this->emit('reloadComponents', 'admin.announcement.table');
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('admin.announcement.modal-delete');
    }
}
