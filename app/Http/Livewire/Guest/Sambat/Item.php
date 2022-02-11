<?php

namespace App\Http\Livewire\Guest\Sambat;

use App\Models\Sambat;
use App\Models\SambatComment;
use App\Models\SambatVote;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Item extends Component
{
    use WithPagination;

    const UPVOTE = 1;
    const DOWNVOTE = -1;
    const NO_ACTION = 0;

    public Sambat $sambat;
    public $sambat_vote;
    public $hideCommentButton = false;

    public function mount()
    {
        if (Auth::check()) {
            $this->sambat_vote = SambatVote::where('user_id', Auth::user()->id)
                ->where('sambat_id', $this->sambat->id)
                ->first();
        }
    }

    public function upvote()
    {
        if (!Auth::check())  return $this->emit('error', 'Login Dulu Yaa');

        if ($this->sambat_vote) {
            $this->sambat_vote->votes = $this->sambat_vote->votes === self::UPVOTE ? self::NO_ACTION : self::UPVOTE;
            $this->sambat_vote->save();
        } else {
            $this->sambat_vote = SambatVote::create([
                'user_id' => Auth::user()->id,
                'sambat_id' => $this->sambat->id,
                'votes' => 1
            ]);
        }
    }

    public function downvote()
    {
        if (!Auth::check())  return $this->emit('error', 'Login Dulu Yaa');

        if ($this->sambat_vote) {
            $this->sambat_vote->votes = $this->sambat_vote->votes === self::DOWNVOTE ? self::NO_ACTION : self::DOWNVOTE;
            $this->sambat_vote->save();
        } else {
            $this->sambat_vote = SambatVote::create([
                'user_id' => Auth::user()->id,
                'sambat_id' => $this->sambat->id,
                'votes' => -1
            ]);
        }
    }

    public function render()
    {
        return view('components.card.sambat', [
            'votes_sum' => SambatVote::where('sambat_id', $this->sambat->id)->sum('votes'),
            'comments_count' => SambatComment::where('sambat_id', $this->sambat->id)->count()
        ]);
    }
}
