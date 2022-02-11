<?php

namespace App\Http\Livewire\Guest\Sambat;

use LivewireUI\Modal\ModalComponent;
use App\Models\Sambat;

class ModalDelete extends ModalComponent
{
    public $sambat_id;

    public function handleForm()
    {
        try {
            $meeting = Sambat::find($this->sambat_id);
            $meeting->delete();

            $this->emit('success', "Sukses menghapus sambat");
        } catch (\Exception $e) {
            $this->emit('error', "Gagal menghapus sambat");
        } finally {
            $this->emit('reloadComponents', 'sambat.table');
            $this->skipPreviousModal(2);
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('guest.sambat.modal-delete');
    }
}
