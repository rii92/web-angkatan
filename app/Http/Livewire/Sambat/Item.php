<?php

namespace App\Http\Livewire\Sambat;

use App\Models\Sambat;
use App\Models\SambatVote;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Item extends Component
{
    use WithPagination;

    public Sambat $sambat;

    public function upvote($sambat_id)
    {
        $sambat_vote = SambatVote::where('user_id', Auth::user()->id)
                                    ->where('sambat_id', $sambat_id)
                                    ->first();
        
        if($sambat_vote){
            if($sambat_vote->votes === 1){
                SambatVote::where('user_id', Auth::user()->id)
                                    ->where('sambat_id', $sambat_id)
                                    ->update(['votes' => 0]);
                return $this->emit('success', 'Sukses Hapus Vote');
            }else{
                SambatVote::where('user_id', Auth::user()->id)
                                    ->where('sambat_id', $sambat_id)
                                    ->update(['votes' => 1]);
            }
        } else{
            SambatVote::create([
                'user_id' => Auth::user()->id,
                'sambat_id' => $sambat_id,
                'votes' => 1
            ]);
        }
        return $this->emit('success', 'Sukses Upvote');
    }
    
    public function downvote($sambat_id)
    {
        $sambat_vote = SambatVote::where('user_id', Auth::user()->id)
                                    ->where('sambat_id', $sambat_id)
                                    ->latest()
                                    ->first();
        if($sambat_vote){
            if($sambat_vote->votes === -1){
                SambatVote::where('user_id', Auth::user()->id)
                                    ->where('sambat_id', $sambat_id)
                                    ->update(['votes' => 0]);
                return $this->emit('success', 'Sukses Hapus Vote');
            }else{
                SambatVote::where('user_id', Auth::user()->id)
                                    ->where('sambat_id', $sambat_id)
                                    ->update(['votes' => -1]);
            }
        } else{
            SambatVote::create([
                'user_id' => Auth::user()->id,
                'sambat_id' => $sambat_id,
                'votes' => -1
            ]);
        }

        return $this->emit('success', 'Sukses Downvote');
    }

    public function render()
    {
        return view('components.card.sambat', [
            'votes_sum' => SambatVote::where('sambat_id', $this->sambat->id)->sum('votes')
        ]);
    }
}
