<?php

namespace App\Http\Livewire\Admin\Timelines;

use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Timeline;
use LivewireUI\Modal\ModalComponent;

class ModalDelete extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::TIMELINE_MANAGEMENT;

    public $timeline_id;

    public function handleForm()
    {
        try {
            $timeline = Timeline::find($this->timeline_id);
            $timeline->delete();

            $this->emit('success', "Success delete timeline");
        } catch (\Exception $e) {
            $this->emit('error', "Failed to delete timeline");
        } finally {
            $this->emit('reloadComponents', 'admin.timelines.table');
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('admin.timelines.modal-delete');
    }
}
