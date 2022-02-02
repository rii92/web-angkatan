<?php

namespace App\Http\Livewire\Konsultasi;

use App\Constants\AppKonsul;
use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Konsul;
use LivewireUI\Modal\ModalComponent;

class ModalDetail extends ModalComponent
{
    use GuardsAgainstAccess;
    private $permissionGuard = AppPermissions::MAKE_KONSULTASI;

    public $konsul;

    public function mount(Konsul $konsul)
    {
        $this->konsul = $konsul;
    }

    public function render()
    {
        return view('mahasiswa.konsultasi.discussion-room');
    }
}
