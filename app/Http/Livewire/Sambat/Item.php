<?php

namespace App\Http\Livewire\Sambat;

use App\Models\Sambat;
use App\Models\SambatComment;
use App\Models\SambatVote;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Item extends Component
{
    use WithPagination;

    public Sambat $sambat;
    public $sambat_vote;

    public function mount()
    {
        if(Auth::check()){
            $this->sambat_vote = SambatVote::where('user_id', Auth::user()->id)
                                        ->where('sambat_id', $this->sambat->id)
                                        ->first();
        }
    }

    public function upvote()
    {
        if(Auth::check()){
            $this->sambat_vote = SambatVote::where('user_id', Auth::user()->id)
                                        ->where('sambat_id', $this->sambat->id)
                                        ->first();
            
            if($this->sambat_vote){
                if($this->sambat_vote->votes === 1){
                    $this->sambat_vote->votes = 0;
                    $this->sambat_vote->save();
                    return $this->emit('success', 'Sukses Hapus Vote');
                }else{
                    $this->sambat_vote->votes = 1;
                    $this->sambat_vote->save();
                }
            } else{
                $this->sambat_vote = SambatVote::create([
                    'user_id' => Auth::user()->id,
                    'sambat_id' => $this->sambat->id,
                    'votes' => 1
                ]);
            }
            return $this->emit('success', 'Sukses Upvote');
        }else{
            return $this->emit('error', 'Login Dulu Yaa');
        }
    }
    
    public function downvote()
    {
        if(Auth::check()){
            $this->sambat_vote = SambatVote::where('user_id', Auth::user()->id)
                                        ->where('sambat_id', $this->sambat->id)
                                        ->first();
            if($this->sambat_vote){
                if($this->sambat_vote->votes === -1){
                    $this->sambat_vote->votes = 0;
                    $this->sambat_vote->save();
                    return $this->emit('success', 'Sukses Hapus Vote');
                }else{
                    $this->sambat_vote->votes = -1;
                    $this->sambat_vote->save();
                }
            } else{
                $this->sambat_vote = SambatVote::create([
                    'user_id' => Auth::user()->id,
                    'sambat_id' => $this->sambat->id,
                    'votes' => -1
                ]);
            }
            return $this->emit('success', 'Sukses Downvote');
        }else{
            return $this->emit('error', 'Login Dulu Yaa');
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
