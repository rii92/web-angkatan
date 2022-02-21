<?php

namespace App\Http\Livewire\Guest\Sambat;

use App\Models\Sambat;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;


class Lists extends Component
{
    use WithPagination;

    private const PAGE = 8;

    public $search, $searchInfo;
    protected $queryString = ['search' => ['except' => '']];

    protected $listeners = ['selectTag' => 'selectTag'];

    public function selectTag($tag = null)
    {
        $this->resetPage();
        $this->search = $tag;
    }

    private function getSambat()
    {
        $query = Sambat::with(['tags', 'images', 'user', 'userdetails', 'myvote'])
            ->withCount('comments')
            ->withSum('votes', 'votes')
            ->latest();

        if ($this->search) {
            // if search by tag
            if (substr($this->search, 0, 1) == "#") {
                $tag = substr($this->search, 1);
                $query->whereHas('tags', fn (Builder $query) => $query->where('name', $tag));
                $this->searchInfo = view('components.search-info', ['message' => "Hasil pencarian hashtag : ", 'tag' => $tag])->render();
            } else {
                $query->where('description', 'like', "%{$this->search}%");
                $this->searchInfo = view('components.search-info', ['message' => "Hasil pencarian berdasarkan kata kunci : ", 'keyword' => $this->search])->render();
            }
        } else
            $this->searchInfo = null;

        return $query->paginate(self::PAGE);
    }

    public function render()
    {
        return view('guest.sambat.lists', ['sambats' => $this->getSambat()]);
    }
}
