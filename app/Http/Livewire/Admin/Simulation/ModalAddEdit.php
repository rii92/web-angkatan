<?php

namespace App\Http\Livewire\Admin\Simulation;

use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Simulations;
use App\Models\SimulationsTime;
use App\Models\UserFormations;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Database\Eloquent\Collection;

class ModalAddEdit extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::SIMULATION_MANAGEMENT;

    public $sesi_count, $sesi_count_prev, $simulation_id, $simulation_times;
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

    public function updated($propertyName)
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

    private function initializeUserFormation()
    {
        try {
            $users = Simulations::getUserSession('jurusan', $this->sesi_count);
            $users->each(function ($user, $key) {
                $user->simulations_id = $this->simulation->id;
                $user->simulations_time_id = $this->simulation_times[$user->sesi]->id;
                $user->created_at = now();
                $user->updated_at = now();
                $user->setAppends([]);
                unset($user->sesi);
            });

            UserFormations::insert($users->toArray());
        } catch (\Exception $e) {
            throw $e;
        }
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

            if (!$this->simulation_id) $this->initializeUserFormation();

            DB::commit();
            $this->emit('success', "You're data success to store");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->emit('error', "Somethings Wrong, I can feel it");
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
