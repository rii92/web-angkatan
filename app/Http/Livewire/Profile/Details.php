<?php

namespace App\Http\Livewire\Profile;

use App\Models\UserDetails;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Details extends Component
{
    public UserDetails $details;

    protected $rules = [
        'details.nim' => 'nullable|numeric|digits:9',
        'details.kelas' => 'nullable|string|size:4',
        'details.no_hp' => 'nullable|numeric|digits_between:10,14',
        'details.jenis_kelamin' => 'nullable|string',
    ];

    public function mount()
    {
        $this->details =  Auth::user()->details ?? new UserDetails();
    }

    public function handleForm()
    {
        if ($this->details->jenis_kelamin == '')
            $this->details->jenis_kelamin = null;

        $this->validate();

        Auth::user()->details()->save($this->details);

        $this->handleResponse();
    }

    private function handleResponse()
    {
        $this->emit('success', "Success update your information details");
        $this->emit('reloadComponents', 'profile.address');
        $this->emit('reloadComponents', 'profile.skripsi');
    }

    public function render()
    {
        return view('profile.details');
    }
}
