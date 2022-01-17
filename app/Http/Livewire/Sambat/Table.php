<?php

namespace App\Http\Livewire\Sambat;

use App\Models\Sambat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{

    use WithPagination;

    public $search, $is_admin;
    public $limitPerPage = 5;
    protected $updatedQueryString = ['search', ['except' => '']];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        if ($this->is_admin) {
            return view('sambat.table', [
                'sambat' => $this->search === null ?
                Sambat::latest()->paginate($this->limitPerPage) :
                Sambat::where('description','like', '%' . $this->search . '%')
                ->latest()->paginate($this->limitPerPage),
                'is_admin' => $this->is_admin
            ]);
        } else {
            return view('sambat.table', [
                'sambat' => $this->search === null ?
                Sambat::latest()->where('user_id', '=', Auth::id())->paginate($this->limitPerPage) :
                Sambat::where('description','like', '%' . $this->search . '%')->where('user_id', '=', Auth::id())
                ->latest()->paginate($this->limitPerPage),
                'is_admin' => $this->is_admin
            ]);
        }
        
    }
}