<?php

namespace App\Http\Livewire\Sambat;

use App\Models\Sambat;
use LivewireUI\Modal\ModalComponent;

class CreateSambat extends ModalComponent
{
    public function render()
    {
        return view('sambat.create-sambat');
    }
}
