<?php

namespace App\Http\Livewire\Guest\Sambat;

use App\Constants\AppSambat;
use App\Models\Sambat;
use App\Models\SambatVote;
use Livewire\Component;
use Illuminate\Support\Str;

class Item extends Component
{
    public Sambat $sambat;
    public $sambat_vote, $description;
    public $hideCommentButton = false;
    public $votes_sum, $comments_count;

    protected function getListeners()
    {
        return ['refresh-item-sambat-' . $this->sambat->id => 'refreshVotes'];
    }

    public function mount()
    {
        if (auth()->check()) $this->sambat_vote = $this->sambat->myvote->count() == 0 ? null : $this->sambat->myvote[0];
        $this->votes_sum = $this->sambat->votes_sum_votes ?? 0;
        $this->comments_count = $this->sambat->comments_count;
        $this->description = Str::markdown($this->sambat->description);
    }

    public function refreshVotes()
    {
        $this->votes_sum = $this->sambat->votes()->sum('votes');
        $this->comments_count = $this->sambat->comments()->count();
    }

    public function upvote()
    {
        if (!auth()->check()) return $this->emit('error', 'Login Dulu Yaa');
        if ($this->sambat_vote) {
            $this->sambat_vote->votes = $this->sambat_vote->votes == AppSambat::UPVOTE
                ? AppSambat::NO_VOTE
                : AppSambat::UPVOTE;

            $this->sambat_vote->save();
        } else
            $this->sambat_vote = SambatVote::create([
                'user_id' => auth()->id(),
                'sambat_id' => $this->sambat->id,
                'votes' => AppSambat::UPVOTE
            ]);

        $this->refreshVotes();
    }

    public function downvote()
    {
        if (!auth()->check()) return $this->emit('error', 'Login Dulu Yaa');
        if ($this->sambat_vote) {
            $this->sambat_vote->votes = $this->sambat_vote->votes === AppSambat::DOWNVOTE
                ? AppSambat::NO_VOTE
                : AppSambat::DOWNVOTE;

            $this->sambat_vote->save();
        } else
            $this->sambat_vote = SambatVote::create([
                'user_id' => auth()->id(),
                'sambat_id' => $this->sambat->id,
                'votes' => AppSambat::DOWNVOTE
            ]);

        $this->refreshVotes();
    }

    public function render()
    {
        return view('components.sambat.item');
    }
}
