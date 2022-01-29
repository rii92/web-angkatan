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

    public function upvote()
    {
        if(Auth::check()){
            $sambat_vote = SambatVote::where('user_id', Auth::user()->id)
                                        ->where('sambat_id', $this->sambat->id)
                                        ->first();
            
            if($sambat_vote){
                if($sambat_vote->votes === 1){
                    $sambat_vote->votes = 0;
                    $sambat_vote->save();
                    return $this->emit('success', 'Sukses Hapus Vote');
                }else{
                    $sambat_vote->votes = 1;
                    $sambat_vote->save();
                }
            } else{
                SambatVote::create([
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
            $sambat_vote = SambatVote::where('user_id', Auth::user()->id)
                                        ->where('sambat_id', $this->sambat->id)
                                        ->latest()
                                        ->first();
            if($sambat_vote){
                if($sambat_vote->votes === -1){
                    $sambat_vote->votes = 0;
                    $sambat_vote->save();
                    return $this->emit('success', 'Sukses Hapus Vote');
                }else{
                    $sambat_vote->votes = -1;
                    $sambat_vote->save();
                }
            } else{
                SambatVote::create([
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
            'votes_sum' => SambatVote::where('sambat_id', $this->sambat->id)->sum('votes')
        ]);
    }
}
