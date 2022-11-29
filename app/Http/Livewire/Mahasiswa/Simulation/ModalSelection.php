<?php

namespace App\Http\Livewire\Mahasiswa\Simulation;

use App\Constants\AppPermissions;
use App\Constants\AppSimulation;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Satker;
use App\Models\UserFormations;
use LivewireUI\Modal\ModalComponent;


class ModalSelection extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::SIMULATION_ACCESS;

    public UserFormations $userFormation;

    public $satkers;

    public $rules = [
        'userFormation.satker_1' => 'required|numeric|different:userFormation.satker_2|different:userFormation.satker_3',
        'userFormation.satker_2' => 'required|numeric|different:userFormation.satker_1|different:userFormation.satker_3',
        'userFormation.satker_3' => 'required|numeric|different:userFormation.satker_1|different:userFormation.satker_2',
    ];

    public function mount($user_formation_id)
    {
        $this->userFormation = UserFormations::with([
            'user',
            'user.details',
            'satker1',
            'satker1.location',
            'satker2',
            'satker2.location',
            'satker3',
            'satker3.location',
            'satkerfinal',
            'satkerfinal.location',
        ])
            ->find($user_formation_id);

        $this->satkers = Satker::where(strtolower($this->userFormation->based_on), '!=', 0)->get();
    }


    public function handleForm()
    {
        $this->validate();

        try {
            $this->userFormation->satker_final = null;

            $this->userFormation->satker_final_updated_at = null;
            $this->userFormation->satker_final_keterangan = null;
            $this->userFormation->user_selection_at = now();
            $this->userFormation->status_pilihan = AppSimulation::STATUS_PILIHAN_MENUNGGU;

            $this->userFormation->save();

            $this->emit('success', "Berhasil Mengupdate pilihan Satuan Kerja");
        } catch (\Exception $e) {
            $this->emit('error', "Gagal Mengupdate pilihan Satuan Kerja");
        } finally {
            $this->emit('closeModal');
            $this->emit('reloadComponents', 'mahasiswa.simulation.selection');
        }
    }


    public function render()
    {
        return view('mahasiswa.simulation.modal-selection');
    }
}
