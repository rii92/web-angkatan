<?php

namespace App\Http\Livewire\Profile;

use App\Models\UserDetails;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Details extends Component
{
    public UserDetails $details;



    protected function rules()
    {
        return [
            'details.nim' => 'nullable|numeric|digits:9',
            'details.kelas' => 'nullable|string|size:4',
            'details.no_hp' => 'nullable|numeric|digits_between:10,14',
            'details.no_hp_ayah' => 'nullable|numeric|digits_between:10,14',
            'details.no_hp_ibu' => 'nullable|numeric|digits_between:10,14',
            'details.no_hp_wali' => 'nullable|numeric|digits_between:10,14',
            'details.jenis_kelamin' => 'nullable|string',
            'details.anonim_name' => 'required|alpha_dash|max:60|unique:users_details,anonim_name,' . $this->details->id
        ];
    }

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

        $this->emit('success', "Success update your information details");
    }

    public function render()
    {
        return view('profile.details');
    }
}
