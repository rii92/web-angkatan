<?php

namespace App\Http\Livewire\Guest\Landing;

use App\Models\Timeline as ModelsTimeline;
use Livewire\Component;

class Timeline extends Component
{
    public $events = [];

    public function mount()
    {
        $this->events = ModelsTimeline::orderBy('end_date')->get()->toArray();
    }

    public function render()
    {
        return view('components.calendar.timeline');
    }
}
