<?php

namespace App\Http\Livewire\Profile;

use App\Models\Location;
use App\Models\UserDetails;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class Address extends Component
{

    public UserDetails $details;

    public $kabupaten;
    public $locations;

    protected $rules = [
        'details.alamat_rumah' => 'nullable|string',
        'details.alamat_kos' => 'nullable|string',
        'kabupaten' => 'nullable|exists:locations,kabupaten',
        'details.link_map_kosan' => 'nullable|url',
        'details.tanggal_ke_jakarta' => 'nullable|date'
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
        $this->emit('success', "Success update your address");
    }


    public function render()
    {
        $search = '%' . $this->kabupaten . '%';

        $this->locations = Str::of($this->kabupaten)->trim()->isNotEmpty()
            ? Location::where('kabupaten', 'like', $search)->limit(3)->get()
            : [];

        return view('profile.address');
    }
}
