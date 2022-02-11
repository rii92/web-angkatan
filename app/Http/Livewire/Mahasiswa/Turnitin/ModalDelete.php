<?php

namespace App\Http\Livewire\Mahasiswa\Turnitin;

use App\Constants\AppPermissions;
use App\Constants\AppTurnitins;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\UserTurnitin;
use LivewireUI\Modal\ModalComponent;

class ModalDelete extends ModalComponent
{
    use GuardsAgainstAccess;
    private $permissionGuard = AppPermissions::MAKE_TURNITIN;

    public $turnitin_id;

    public function handleForm()
    {
        $turnitin = UserTurnitin::find($this->turnitin_id);

        // user hanya bisa hapus ketika statusnya reject atau wait
        if (($turnitin->user_id == auth()->user()->id) && in_array($turnitin->status, [AppTurnitins::STATUS_WAIT, AppTurnitins::STATUS_REJECT])) {
            try {
                $turnitin->activity()->detach();
                $turnitin->delete();
                $this->emit('success', "Success delete turnitin submission");
            } catch (\Exception $e) {
                $this->emit('error', "Failed to delete turnitin submission");
            }
        } else
            $this->emit('error', "You don't have access to delete this turnitin submission");

        $this->emit('reloadComponents', 'mahasiswa.turnitin.table');
        $this->emit('closeModal');
    }

    public function render()
    {
        return view('mahasiswa.turnitin.modal-delete');
    }
}
