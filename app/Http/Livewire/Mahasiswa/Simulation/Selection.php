<?php

namespace App\Http\Livewire\Mahasiswa\Simulation;

use App\Models\Simulations;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserFormations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Selection extends Component
{
    public string $BASED_ON = "jurusan"; // jurusan or peminatan

    public User $user;

    public Simulations $simulation;

    public UserFormations $formation;

    public $max_rank;

    public $session;

    public function mount()
    {
        $this->user = User::with('details')->find(Auth::id());

        $this->max_rank = Cache::rememberForever("MAX_RANK_" . $this->user->details[$this->BASED_ON], function () {
            return UserDetails::where($this->BASED_ON, $this->user->details[$this->BASED_ON])->max("rank_" . $this->BASED_ON);
        });

        $times = $this->simulation->times;

        $this->session = $times[floor(($this->user->details["rank_" . $this->BASED_ON] - 1) / $this->max_rank * $times->count())];
    }

    public function render()
    {
        return view('mahasiswa.simulation.selection');
    }
}
