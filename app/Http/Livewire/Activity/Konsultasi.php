<?php

namespace App\Http\Livewire\Activity;

use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Konsul;
use LivewireUI\Modal\ModalComponent;

class Konsultasi extends ModalComponent
{
    use GuardsAgainstAccess;

    public $konsul_id, $konsul;

    public function mount()
    {
        $this->konsul = Konsul::find($this->konsul_id);
    }

    public function render()
    {
        return view('activity.konsultasi');
    }
}
