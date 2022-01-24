<?php

namespace App\Http\Livewire\Admin\Konsultasi;

use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Konsul;
use LivewireUI\Modal\ModalComponent;

class ModalDelete extends ModalComponent
{
    use GuardsAgainstAccess;

    public $konsul_id;

    public function handleForm()
    {
        try {
            $konsul = Konsul::find($this->konsul_id);
            $konsul->delete();

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
        return view('konsultasi.modal-delete');
    }
}
