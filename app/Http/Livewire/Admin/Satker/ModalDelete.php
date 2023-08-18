<?php

namespace App\Http\Livewire\Admin\Satker;

use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Satker;
use LivewireUI\Modal\ModalComponent;

class ModalDelete extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::SIMULATION_MANAGEMENT;

    public $satker_id;

    public function handleForm()
    {
        try {
            $satker = Satker::find($this->satker_id);
            $satker->delete();

            $this->emit('success', "Berhasil menghapus Satker");
        } catch (\Exception $e) {
            $this->emit('error', "Gagal menghapus satker");
        } finally {
            $this->emit('reloadComponents', 'admin.satker.table');
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('admin.satker.modal-delete');
    }
}
