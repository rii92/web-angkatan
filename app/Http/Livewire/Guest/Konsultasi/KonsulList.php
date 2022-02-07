<?php

namespace App\Http\Livewire\Guest\Konsultasi;

use App\Models\Konsul;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class KonsulList extends Component
{
    use WithPagination;

    private const page = 10;
    public $konsuls;

    public $user_id;
    public $search, $category, $jurusan;
    public $tags = [];

    public function mount()
    {
        $this->konsuls = Konsul::with(['userdetails', 'user', 'tags'])
            ->publish()->orderBy('published_at', 'desc')->get();
    }

    public function handleSearch()
    {
        dd($this->category, $this->jurusan);
    }

    public function render()
    {
        return view('guest.konsultasi.list');
    }
}
