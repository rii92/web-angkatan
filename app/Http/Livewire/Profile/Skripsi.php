<?php

namespace App\Http\Livewire\Profile;

use App\Models\UserDetails;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Skripsi extends Component
{
    public UserDetails $details;

    protected $rules = [
        'details.skripsi_dosbing' => 'nullable|string',
        'details.skripsi_judul' => 'nullable|string',
        'details.skripsi_metode' => 'nullable|string',
        'details.skripsi_variabel_dependent' => 'nullable|string',
        'details.skripsi_variabel_independent' => 'nullable|string',
    ];

    public function mount()
    {
        $this->details =  Auth::user()->details ?? new UserDetails();
    }

    public function handleForm()
    {
        $this->validate();

        Auth::user()->details()->save($this->details);

        $this->emit('success', "Success update your data");
    }

    public function render()
    {
        return view('profile.skripsi');
    }
}
