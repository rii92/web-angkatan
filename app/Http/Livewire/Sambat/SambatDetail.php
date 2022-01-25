<?php

namespace App\Http\Livewire\Sambat;

use App\Models\Sambat;
use App\Models\SambatComment;
use App\Models\SambatVote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class SambatDetail extends ModalComponent
{
    public $sambat_id, $description, $vote, $user_id;
    public Sambat $sambat;
    protected $listeners = ['submitComment' => 'store', 'delete' => 'deleteComment'];

    use WithPagination;

    public function mount()
    {
        $this->sambat = Sambat::where('id', $this->sambat_id)->first();
        $this->vote = new SambatVote();
        $this->user_id = Auth::user()->id;
    }

    public function rules()
    {
        return [
            'description' => 'required'
        ];
    }

    public function render()
    {
        return view('sambat.sambat-detail',[
            'sambat_comment' => SambatComment::where('sambat_id', $this->sambat_id)
                                ->orderBy('created_at')
                                ->paginate(2),
            'is_voted' => SambatVote::where('user_id', Auth::user()->id)
                                    ->where('sambat_id', $this->sambat_id)->first()
        ]);
    }

    public function store($description)
    {
        $comment = new SambatComment();
        $this->description = $description;
        $this->validate();

        $comment->description = $this->description;
        $comment->sambat_id = $this->sambat_id;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        $this->description = '';
        $this->emit('reloadComponents', 'sambat.sambat-detail');
    }

    public function deleteComment($comment_id)
    {
        DB::table('sambat_comments')->where('id', '=', $comment_id)->delete();

        $this->emit('reloadComponents', 'sambat.sambat-detail');
    }

    public function vote($is_upvote)
    {
        try {
            $voting = SambatVote::where('sambat_id', $this->sambat_id)
                        ->where('user_id', Auth::user()->id)
                        ->first();
            if($voting){
                if($voting->is_upvote == $is_upvote){
                    SambatVote::where('id', $voting->id)
                    ->where('sambat_id', $this->sambat_id)
                    ->where('user_id', $this->user_id)
                    ->delete();
                } else {
                    SambatVote::where('id', $voting->id)
                    ->where('sambat_id', $this->sambat_id)
                    ->where('user_id', $this->user_id)
                    ->update(['is_upvote' => $is_upvote]);
                }
            }else{
                $this->vote->user_id = Auth::user()->id;
                $this->vote->sambat_id = $this->sambat_id;
                $this->vote->is_upvote = $is_upvote;
        
                $this->vote->save();
            }


            $this->emit('reloadComponents', 'sambat.sambat-detail');
            
        } catch (\Exception $e) {
            $this->emit('error', "Maaf, vote gagal");
        }
    }
} 