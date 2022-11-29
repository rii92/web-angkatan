<?php

namespace App\Http\Livewire\Mahasiswa\Simulation;

use App\Constants\AppSimulation;
use App\Models\Simulations;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserFormations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Selection extends Component
{
    public User $user;

    public Simulations $simulation;

    public UserFormations $formation;

    public $max_rank;

    public function mount()
    {
        $this->user = User::with('details')->find(Auth::id());

        $this->formation = UserFormations::with(['satker1', 'satker2', 'satker3', 'satkerfinal', 'session_time'])
            ->where('simulations_id', $this->simulation->id)
            ->where('user_id', Auth::id())
            ->first();

        $this->max_rank = Cache::get("MAX_RANK_" . $this->user->details[AppSimulation::BASED_ON], function () {
            return UserDetails::where(AppSimulation::BASED_ON, $this->user->details[AppSimulation::BASED_ON])
                ->max("rank_" . AppSimulation::BASED_ON);
        });
    }

    public function render()
    {
        return view('mahasiswa.simulation.selection');
    }
}
