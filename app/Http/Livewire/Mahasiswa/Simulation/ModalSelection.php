<?php

namespace App\Http\Livewire\Mahasiswa\Simulation;

use App\Constants\AppPermissions;
use App\Constants\AppSimulation;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Satker;
use App\Models\UserFormations;
use Illuminate\Database\Eloquent\Builder;
use LivewireUI\Modal\ModalComponent;


class ModalSelection extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::SIMULATION_ACCESS;

    public UserFormations $userFormation;

    public $satkers;

    public $confirm;

    public $rules = [
        'userFormation.satker_1' => 'required|numeric|different:userFormation.satker_2|different:userFormation.satker_3',
        'userFormation.satker_2' => 'required|numeric|different:userFormation.satker_1|different:userFormation.satker_3',
        'userFormation.satker_3' => 'required|numeric|different:userFormation.satker_1|different:userFormation.satker_2',
        'confirm' => 'accepted',
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
            'session_time'
        ])
            ->find($user_formation_id);

        $userFormation = $this->userFormation;

        $this->satkers = Satker::withCount([
            'formation_final' => function (Builder $query) use ($userFormation) {
                $query->where('simulations_id', $userFormation->simulations_id);
                $query->where('based_on', strtolower($this->userFormation->based_on));
            }
        ])
            ->where(strtolower($this->userFormation->based_on), '!=', 0)->get();
    }


    public function handleForm()
    {
        if (!($this->userFormation->session_time->start_time <= now() && $this->userFormation->session_time->end_time >= now())) {
            $this->emit('error', "Waktu telah habis");

            $this->emit('closeModal');

            return $this->emit('reloadComponents', 'mahasiswa.simulation.selection');
        }

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
