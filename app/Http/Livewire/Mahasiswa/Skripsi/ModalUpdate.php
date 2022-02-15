<?php

namespace App\Http\Livewire\Mahasiswa\Skripsi;

use LivewireUI\Modal\ModalComponent;

class ModalUpdate extends ModalComponent
{
    public $user_details;

    protected $rules = [
        'user_details.skripsi_dosbing' => 'required|string',
        'user_details.skripsi_judul' => 'nullable|string',
        'user_details.skripsi_metode' => 'nullable|string',
        'user_details.skripsi_variabel_dependent' => 'nullable|string',
        'user_details.skripsi_variabel_independent' => 'nullable|string',
    ];

    public function mount()
    {
        $this->user_details = auth()->user()->details;
    }

    public function handleForm()
    {
        $this->validate();

        auth()->user()->details()->save($this->user_details);

        $this->emit('success', "Success update your data");
        $this->emit('closeModal');
    }

    public function render()
    {
        return view('mahasiswa.skripsi.modal-update');
    }
}
