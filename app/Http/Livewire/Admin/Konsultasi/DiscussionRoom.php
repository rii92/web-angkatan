<?php

namespace App\Http\Livewire\Admin\Konsultasi;

use App\Models\Konsul;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class DiscussionRoom extends Component
{
    public $konsul;

    public function mount(Konsul $konsul)
    {
        $category = Request::segment(3);
        $this->konsul = $konsul;
        if ($this->konsul->category != $category) abort(404);
    }

    public function render()
    {
        return view('admin.konsultasi.discussion-room');
    }
}
