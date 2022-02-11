<?php

namespace App\Http\Livewire\Mahasiswa\Skripsi;

use App\Models\UserDetails;
use LivewireUI\Modal\ModalComponent;

class ModalDetail extends ModalComponent
{

    public $user_id;
    public UserDetails $user_details;

    public function mount()
    {
        $this->user_details = UserDetails::where('user_id', $this->user_id)->first();
    }

    public function render()
    {
        return view('mahasiswa.skripsi.modal-detail');
    }
}
