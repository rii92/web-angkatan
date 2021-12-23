<?php

namespace App\Http\Livewire\Admin\Announcement;

use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Announcement;
use LivewireUI\Modal\ModalComponent;

class ModalPublishNow extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::ANNOUNCEMENT_MANAGEMENT;

    public $announcement_id;

    public function handleForm()
    {
        try {
            Announcement::find($this->announcement_id)->update(['published_at' => now()]);

            $this->emit('success', "Success to publish announcement");
        } catch (\Exception $e) {
            $this->emit('error', "Failed to publish announcement");
        } finally {
            $this->emit('reloadComponents', 'admin.announcement.table');
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('admin.announcement.modal-publish-now');
    }
}
