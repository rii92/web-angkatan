<?php

namespace App\Http\Livewire\Guest\Sambat;

use LivewireUI\Modal\ModalComponent;
use App\Models\Sambat;
use Illuminate\Support\Facades\Storage;

class ModalDelete extends ModalComponent
{
    public $sambat_id;

    public function handleForm()
    {
        try {
            $sambat = Sambat::find($this->sambat_id);
            $sambat->tags()->detach();
            $sambat->comments()->delete();
            $sambat->votes()->delete();

            foreach ($sambat->images as $image) Storage::disk('public')->delete($image->url);
            $sambat->delete();

            $this->emit('success', "Sukses menghapus sambat");
        } catch (\Exception $e) {
            $this->emit('error', "Gagal menghapus sambat");
        } finally {
            $this->emit('reloadComponents', 'guest.sambat.lists');
            // $this->skipPreviousModal(2);
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('guest.sambat.modal-delete');
    }
}
