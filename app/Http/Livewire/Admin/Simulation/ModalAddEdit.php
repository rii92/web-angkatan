<?php

namespace App\Http\Livewire\Admin\Simulation;

use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Jobs\CreateUserSimulations;
use App\Models\Simulations;
use App\Models\SimulationsTime;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Database\Eloquent\Collection;

class ModalAddEdit extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::SIMULATION_MANAGEMENT;

    public $sesi_count;

    public $sesi_count_prev;

    public $simulation_id;

    public $simulation_times;

    public Simulations $simulation;

    public function rules()
    {
        $rules['simulation.title'] = 'required';
        $rules['sesi_count'] = 'integer|gt:0';
        $rules['simulation_times.*.start_time'] = 'required|date';
        $rules['simulation_times.*.end_time'] = 'required|date|after:simulation_times.*.start_time';

        return  $rules;
    }

    public function mount()
    {
        $this->simulation = $this->simulation_id ? Simulations::find($this->simulation_id) : new Simulations();

        $this->simulation_times = $this->simulation_id ? $this->simulation->times : new Collection();

        $this->sesi_count = $this->simulation_id ? $this->simulation_times->count() : 0;

        $this->sesi_count_prev = $this->sesi_count;
    }

    public function updated()
    {
        $selisih = $this->sesi_count - $this->sesi_count_prev;

        if ($selisih >= 0)
            for ($i = 0; $i < $selisih; $i++)
                $this->simulation_times->push(new SimulationsTime());
        else
            for ($i = 0; $i < -1 * $selisih; $i++)
                $this->simulation_times->pop();

        $this->sesi_count_prev = $this->sesi_count;
    }


    public function handleForm()
    {
        $this->validate();

        DB::beginTransaction();

        try {

            $this->simulation->save();

            foreach ($this->simulation_times as $time) {
                $time->simulations_id = $this->simulation->id;
                $time->save();
            }

            if (!$this->simulation_id)
                CreateUserSimulations::dispatchSync($this->simulation);

            DB::commit();
            $this->emit('success', "Berhasil menambahkan simulasi baru");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->emit("error", $e->getMessage());
            // $this->emit('error', "Gagal menambahkan simulasi baru");
        } finally {
            $this->emit('reloadComponents', 'admin.simulation.table');
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('admin.simulation.modal-add-edit');
    }
}
