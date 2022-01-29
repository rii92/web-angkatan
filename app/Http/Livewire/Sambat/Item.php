<?php

namespace App\Http\Livewire\Sambat;

use App\Models\Sambat;
use Livewire\Component;
use Livewire\WithPagination;

class Item extends Component
{
    use WithPagination;

    public Sambat $sambat;

    public function upvote()
    {
        return $this->emit('success', 'mantap jiwa');
    }
    
    public function downvote()
    {
        return $this->emit('error', 'mantap jiwa');
    }

    public function render()
    {
        return view('components.card.sambat');
    }
}
