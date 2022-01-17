<?php

namespace App\Http\Livewire\Sambat;

use App\Models\Sambat as ModelsSambat;
use App\Models\Tag;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Sambat extends Component
{
    public $search, $tag_id, $user_id;
    protected $queryString = ['search'];
    public $limitPerPage = 5;

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        $tags = Tag::all();
        if ($this->tag_id) {
            return view('sambat.sambat', [
                'tag' => $this->search === null ? Tag::find([$this->tag_id]) : 
                ModelsSambat::where('description','like', '%' . $this->search . '%')
                ->get(),
                'tags' => $tags,
                'tag_id' => $this->tag_id
            ]);
        } else{
            if ($this->user_id) {
                return view('sambat.sambat',[
                    'user' => $this->search === null ? 
                    User::find([$this->user_id]) :
                    ModelsSambat::where('description','like', '%' . $this->search . '%')
                    ->get(),
                    'tags' => $tags,
                    'user_id' => $this->user_id
                ]);
            } else{
                return view('sambat.sambat', [
                    'sambat' => $this->search === null ?
                    ModelsSambat::all() :
                    ModelsSambat::where('description','like', '%' . $this->search . '%')
                    ->get(),
                    'tags' => $tags,
                    'search' => $this->search
                ]);
            }
        }
    }
}
