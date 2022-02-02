<?php

namespace App\Http\Livewire\Konsultasi;

use App\Models\Konsul;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Table extends Component
{
    use WithPagination;

    private const page = 10;
    private $konsuls;

    public $search, $user_id;

    protected $updatedQueryString = ['search', ['except' => '']];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        $this->konsuls = Konsul::with('user');
        if ($this->user_id) $this->konsuls->where('user_id', $this->user_id);
        if (Str::of($this->search)->trim()->isNotEmpty()) {
            $this->konsuls->where('title', 'like', '%' . $this->search . '%')
            ->orWhere('category', 'like', '%' .  $this->search . '%')
            ->orWhere('description', 'like', '%' .  $this->search . '%')
            ->orWhere('name', 'like', '%' .  $this->search . '%');
        }

        // dd($this->konsuls->get()->toArray());
        return view('guest.konsultasi', ['konsuls' => $this->konsuls->latest()->paginate(self::page)]);
    }
}
