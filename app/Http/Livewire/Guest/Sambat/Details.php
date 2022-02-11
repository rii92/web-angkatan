<?php

namespace App\Http\Livewire\Guest\Sambat;

use App\Models\Sambat;
use App\Models\SambatComment;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class Details extends ModalComponent
{
    use WithPagination;

    private const COMMENT_PAGINATE = 2;

    public $sambat_id, $sambat_comments;
    public Sambat $sambat;

    protected $listeners = [
        'submitForm' => 'addComments'
    ];

    public function mount()
    {
        $this->sambat = Sambat::where('id', $this->sambat_id)->first();
    }

    public function addComments($description)
    {
        $this->sambat_comments = new SambatComment();
        $this->sambat_comments->description = $description;

        $this->validate([
            'sambat_comments.description' => "required"
        ]);

        $this->sambat_comments->sambat_id = $this->sambat_id;
        $this->sambat_comments->user_id = Auth::user()->id;
        $this->sambat_comments->save();

        $this->sambat_comments->description = '';

        $this->emit('success', "Komentar berhasil dibuat");
    }

    public function deleteComments($comment_id)
    {
        try {
            SambatComment::where('id', $comment_id)->delete();
            $this->emit('success', "Komentar berhasil dihapus!");
        } catch (\Exception $th) {
            $this->emit('error', "Gagal mengahapus komentar!");
        }
    }

    public function render()
    {
        return view('guest.sambat.details', [
            'comments' => SambatComment::where('sambat_id', $this->sambat_id)
                ->orderBy('created_at')
                ->paginate(self::COMMENT_PAGINATE),
        ]);
    }
}
