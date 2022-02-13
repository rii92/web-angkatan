<?php

namespace App\Http\Livewire\Guest\Sambat;

use App\Constants\AppPermissions;
use LivewireUI\Modal\ModalComponent;
use App\Models\Sambat;
use Illuminate\Support\Facades\Storage;

class ModalDelete extends ModalComponent
{
    public $sambat_id;

    public function handleForm()
    {
        $sambat = Sambat::find($this->sambat_id);
        if (auth()->id() != $sambat->user_id and !auth()->user()->can(AppPermissions::DELETE_SAMBAT))
            return $this->emit('error', "Gagal menghapus sambat");

        try {
            $sambat->tags()->detach();
            $sambat->comments()->delete();
            $sambat->votes()->delete();
            foreach ($sambat->images as $image) Storage::disk('public')->delete($image->url);
            $sambat->images()->delete();
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
