<?php

namespace App\Http\Livewire\Profile;

use App\Models\UserDetails;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Setting extends Component
{
    public UserDetails $details;

    protected $rules = [
        'details.setting_send_email_accept_konsultasi' => 'required',
        'details.setting_send_email_reply_konsultasi' => 'required|numeric|min:0',
    ];

    public function mount()
    {
        $this->details =  Auth::user()->details ?? new UserDetails();
    }

    public function handleForm()
    {
        $this->validate();
        Auth::user()->details()->save($this->details);
        $this->emit('success', "Success update your account setting");
    }

    public function render()
    {
        return view('profile.setting');
    }
}
