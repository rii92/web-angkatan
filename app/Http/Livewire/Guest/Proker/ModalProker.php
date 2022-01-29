<?php

namespace App\Http\Livewire\Guest\Proker;

use App\Constants\AppProker;
use LivewireUI\Modal\ModalComponent;

class ModalProker extends ModalComponent
{
  public $proker;
  public $proker_index;

  public function mount()
  {
    $this->proker = AppProker::all()[$this->proker_index];
  }

  public function render()
  {
    return view('guest.proker.modal-proker');
  }
}
