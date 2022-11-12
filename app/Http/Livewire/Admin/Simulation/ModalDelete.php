<?php

namespace App\Http\Livewire\Admin\Simulation;

use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Simulations;
use LivewireUI\Modal\ModalComponent;

class ModalDelete extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::SIMULATION_MANAGEMENT;

    public $simulation_id;

    public function handleForm()
    {
        try {
            Simulations::destroy($this->simulation_id);

            $this->emit('success', "Success delete simulation");
        } catch (\Exception $e) {
            $this->emit('error', "Failed to delete simulation");
        } finally {
            $this->emit('reloadComponents', 'admin.simulation.table');
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('admin.simulation.modal-delete');
    }
}
