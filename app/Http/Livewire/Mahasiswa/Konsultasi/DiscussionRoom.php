<?php

namespace App\Http\Livewire\Mahasiswa\Konsultasi;

use App\Models\Konsul;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class DiscussionRoom extends Component
{
    public $konsul;

    public function mount(Konsul $konsul)
    {
        $this->konsul = $konsul;
        if ($this->konsul->user_id != auth()->user()->id) abort(404);
        if (Request::segment(3) != $this->konsul->category) abort(404);
    }

    public function render()
    {
        return view('mahasiswa.konsultasi.discussion-room');
    }
}
