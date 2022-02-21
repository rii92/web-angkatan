<?php

namespace App\Http\Livewire\Guest\Konsultasi;

use App\Constants\AppKonsul;
use App\Models\Konsul;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class KonsulList extends Component
{
    use WithPagination;

    private const PAGE = 7;
    private $konsuls;

    public $user_id;
    public $search, $category, $jurusan, $searchInfo;

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'jurusan' => ['except' => '']
    ];

    protected $listeners = [
        'selectTag' => 'selectTag'
    ];

    public function paginationView()
    {
        return 'pagination.dark';
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function selectTag($tag = null)
    {
        $this->resetPage();
        $this->search = $tag;
    }

    private function search()
    {
        $query = Konsul::with(['userdetails', 'user', 'tags'])
            ->publish()->orderBy('published_at', 'desc');

        // category filter
        $this->category && in_array($this->category, [AppKonsul::TYPE_AKADEMIK, AppKonsul::TYPE_UMUM])
            ? $query->KonsulType($this->category)
            : '';

        // jurusan filter
        $this->jurusan && in_array($this->jurusan, AppKonsul::allJurusan())
            ? $query->whereHas('userdetails', fn (Builder $query) => $query->where('kelas', "like", "%{$this->jurusan}%"))
            : '';

        if ($this->search) {
            // if search by tag
            if (substr($this->search, 0, 1) == "#") {
                $tag = substr($this->search, 1);
                $query->whereHas('tags', fn (Builder $query) => $query->where('name', $tag));
                $this->searchInfo = view('components.search-info', [
                    'message' => "Hasil pencarian hashtag : ",
                    'tag' => $tag
                ])->render();
            } else {
                $query->where('description', 'like', "%{$this->search}%");
                $this->searchInfo = view('components.search-info', [
                    'message' => "Hasil pencarian berdasarkan kata kunci : ",
                    'keyword' => $this->search
                ])->render();
            }
        } else
            $this->searchInfo = null;

        return $query->paginate(self::PAGE);
    }

    public function render()
    {
        return view('guest.konsultasi.list', ['konsuls' => $this->search()]);
    }
}
