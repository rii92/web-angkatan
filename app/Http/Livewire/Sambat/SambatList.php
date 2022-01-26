<?php

namespace App\Http\Livewire\Sambat;

use App\Models\Sambat;
use Livewire\Component;
use Livewire\WithPagination;

class SambatList extends Component
{
    use WithPagination;

    public $search;
    public $limitPerPage = 5;
    protected $queryString = ['search'=> ['except' => '']];

    public function render()
    {
        $sambat = Sambat::latest()->paginate($this->limitPerPage);

        if ($this->search !== null) {
            $sambat = Sambat::where('description','like', '%' . $this->search . '%')
            ->latest()->paginate($this->limitPerPage);
        }
        return view('sambat.sambat-list', [
            'sambat' => $sambat,
        ]);
    }
}
