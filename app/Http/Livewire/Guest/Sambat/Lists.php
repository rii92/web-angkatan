<?php

namespace App\Http\Livewire\Guest\Sambat;

use App\Models\Sambat;
use Livewire\Component;
use Livewire\WithPagination;


class Lists extends Component
{
    use WithPagination;

    private const page = 8;
    public $search;

    protected $updatedQueryString = ['search', ['except' => '']];

    private function getSambat()
    {
        return Sambat::with(['tags', 'images', 'user', 'userdetails', 'myvote'])
            ->withCount('comments')
            ->withSum('votes', 'votes')
            ->latest();
    }

    public function render()
    {
        return view('guest.sambat.lists', ['sambats' => $this->getSambat()->paginate(self::page)]);
    }
}
