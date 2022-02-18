<?php

namespace App\Http\Livewire\Guest\Sambat;

use App\Models\Sambat;
use Livewire\Component;
use Livewire\WithPagination;


class Lists extends Component
{
    use WithPagination;

    private const PAGE = 8;

    public $search;
    protected $updatedQueryString = ['search', ['except' => '']];

    private function getSambat()
    {
        if(request('tag')){
            return Sambat::with(['tags', 'images', 'user', 'userdetails', 'myvote'])
                ->whereHas('tags', fn ($query) => $query->where('name', '=', request('tag')))
                ->withCount('comments')
                ->withSum('votes', 'votes')
                ->latest();
        }else{
            return Sambat::with(['tags', 'images', 'user', 'userdetails', 'myvote'])
                ->withCount('comments')
                ->withSum('votes', 'votes')
                ->latest();
        }
    }

    public function render()
    {
        return view('guest.sambat.lists', ['sambats' => $this->getSambat()->paginate(self::PAGE)]);
    }
}
