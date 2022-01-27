<?php

namespace App\Http\Livewire\Mahasiswa\Konsultasi;

use App\Constants\AppKonsul;
use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Konsul;
use LivewireUI\Modal\ModalComponent;

class ModalDelete extends ModalComponent
{
    use GuardsAgainstAccess;
    private $permissionGuard = AppPermissions::MAKE_KONSULTASI;

    public $konsul_id;

    public function handleForm()
    {
        $konsul = Konsul::find($this->konsul_id);

        // user hanya bisa hapus ketika statusnya reject atau wait
        if (($konsul->user_id == auth()->user()->id) && in_array($konsul->status, [AppKonsul::STATUS_WAIT, AppKonsul::STATUS_REJECT])) {
            try {
                $konsul->tags()->detach();
                $konsul->delete();
                $this->emit('success', "Success delete konsultasi");
            } catch (\Exception $e) {
                $this->emit('error', "Failed to delete konsultasi");
            }
        } else
            $this->emit('error', "You don't have access to delete this konsultasi");

        $this->emit('reloadComponents', 'mahasiswa.konsultasi.table');
        $this->emit('closeModal');
    }

    public function render()
    {
        return view('mahasiswa.konsultasi.modal-delete');
    }
}
