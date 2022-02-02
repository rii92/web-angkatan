<?php

namespace App\Http\Livewire\Sambat;

use App\Models\Sambat;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Lists extends Component
{
    use WithPagination;

    private const page = 10;
    private $sambats;

    public $search, $user_id;

    protected $updatedQueryString = ['search', ['except' => '']];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {

        $this->sambats = $this->user_id
            ? Sambat::where('user_id', $this->user_id)->with('tags', 'image', 'user')
            : Sambat::with('tags', 'image');

        $this->sambats = Str::of($this->search)->trim()->isNotEmpty()
            ? $this->sambats->where('description', 'like', '%' . $this->search . '%')
            : $this->sambats;

        return view('sambat.lists', ['sambats' => $this->sambats->latest()->paginate(self::page)]);
    }
}
