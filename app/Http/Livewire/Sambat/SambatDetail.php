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
    public $sambat_id, $description, $is_upvote, $vote;
    public Sambat $sambat;
    protected $listeners = ['submitComment' => 'store', 'delete' => 'deleteComment'];

    use WithPagination;

    public function mount()
    {
        $this->sambat = Sambat::where('id', $this->sambat_id)->first();
        $this->vote = new SambatVote();
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
            'sambat_comment' => DB::table('sambat_comments')
                                ->join('users', 'sambat_comments.user_id', '=', 'users.id')
                                ->select('sambat_comments.*', 'users.name')
                                ->where('sambat_id', $this->sambat_id)
                                ->orderBy('created_at')
                                ->paginate(2)
        ]);
    }

    private function resetCommentForm()
    {
        $this->description = '';
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

        $this->resetCommentForm();
        $this->emit('reloadComponents', 'sambat.sambat-detail');
    }

    public function deleteComment($comment_id)
    {
        DB::table('sambat_comments')->where('id', '=', $comment_id)->delete();

        $this->emit('reloadComponents', 'sambat.sambat-detail');
    }

    public function vote()
    {
        try {
            $this->vote->user_id = Auth::user()->id;
            $this->vote->sambat_id = $this->sambat_id;
            $this->vote->is_upvote = $this->is_upvote;
            $this->vote->created_at = $this->vote->created_at ?? now();
    
            $this->vote->save();

            if ($this->sambat_id) return $this->emit('success', "Sambatanmu berhasil diubah!");
            return redirect()->route('sambat')->with('message', 'Sambatanmu berhasil dibuat!');

            
        } catch (\Exception $e) {
            $this->emit('error', "Maaf, sambatanmu gagal dibuat" . $e);
        }
    }
} 