<?php

namespace App\Http\Livewire\Konsultasi;

use App\Models\Konsul;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Item extends Component
{
    use WithPagination;

    public Konsul $konsul;

    public function mount()
    {

    }

    // public function upvote()
    // {
    //     if (!Auth::check())  return $this->emit('error', 'Login Dulu Yaa');

    //     if ($this->sambat_vote) {
    //         $this->sambat_vote->votes = $this->sambat_vote->votes === self::UPVOTE ? self::NO_ACTION : self::UPVOTE;
    //         $this->sambat_vote->save();
    //     } else {
    //         $this->sambat_vote = SambatVote::create([
    //             'user_id' => Auth::user()->id,
    //             'sambat_id' => $this->sambat->id,
    //             'votes' => 1
    //         ]);
    //     }
    // }

    public function render()
    {
        return view('components.card.konsul', [
            'konsul_id'=>$this->konsul
            // 'votes_sum' => SambatVote::where('sambat_id', $this->konsul->id)->sum('votes'),
            // 'comments_count' => SambatComment::where('sambat_id', $this->konsul->id)->count()
        ]);
    }
}
