<?php

namespace App\Http\Livewire\Mahasiswa\Simulation;

use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\UserFormations;
use LivewireUI\Modal\ModalComponent;


class UserDetail extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::SIMULATION_ACCESS;
    public UserFormations $user;

    public function mount($user_formation_id)
    {
        $this->user = UserFormations::with([
            'user',
            'user.details',
            'user.details.location',
            'satker1',
            'satker1.location',
            'satker2',
            'satker2.location',
            'satker3',
            'satker3.location',
            'satkerfinal',
            'satkerfinal.location',
            'session_time'
        ])
            ->find($user_formation_id);
    }

    public function render()
    {
        return view('mahasiswa.simulation.modal-user-detail');
    }
}
