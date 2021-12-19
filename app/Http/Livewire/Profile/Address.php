<?php

namespace App\Http\Livewire\Profile;

use App\Models\Location;
use App\Models\UserDetails;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Address extends Component
{

    public UserDetails $details;

    public $kabupaten;
    public $locations;

    protected $rules = [
        'details.alamat_rumah' => 'nullable|string',
        'details.alamat_kos' => 'nullable|string',
        'kabupaten' => 'nullable|exists:locations,kabupaten'
    ];

    public function selectLocation($kabupaten)
    {
        $this->kabupaten = $kabupaten;
        $this->reset('locations');
    }


    public function mount()
    {
        $this->details =  Auth::user()->details ?? new UserDetails();

        // don't use Null Safe operator (somevariable?->someatrribute), it's PHP 8.0 features not < 8.0
        $location = $this->details->location;
        $this->kabupaten = $location ? $location->kabupaten : null;
    }

    public function handleForm()
    {
        $this->validate();

        // udpate location to users
        if ($this->kabupaten) {
            $location = Location::where('kabupaten', $this->kabupaten)->first();
            $this->details->location_id = $location->id;
        } else {
            $this->details->location_id = null;
        }

        Auth::user()->details()->save($this->details);

        $this->handleResponse();
    }

    private function handleResponse()
    {
        $this->emit('success', "Success update your address");
        $this->emit('reloadComponents', 'profile.details');
        $this->emit('reloadComponents', 'profile.skripsi');
    }


    public function render()
    {
        $search = '%' . $this->kabupaten . '%';

        $this->locations = $this->kabupaten !== ''
            ? Location::where(function ($query) use ($search) {
                $query->where('kabupaten', 'ilike', $search);
            })->limit(3)->get()
            : [];

        return view('profile.address');
    }
}
