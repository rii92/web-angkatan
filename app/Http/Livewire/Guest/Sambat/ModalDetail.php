<?php

namespace App\Http\Livewire\Guest\Sambat;

use App\Models\Sambat;
use App\Models\SambatComment;
use LivewireUI\Modal\ModalComponent;

class ModalDetail extends ModalComponent
{
    public $sambat_id, $sambatComment, $comments;
    public Sambat $sambat;

    protected $listeners = [
        'submitForm' => 'addComments',
        'modalClosed' => 'refreshItemSambat'
    ];


    public static function closeModalOnClickAway(): bool
    {
        return true;
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public static function dispatchCloseEvent(): bool
    {
        return true;
    }

    public function refreshItemSambat()
    {
        $this->emit('refresh-item-sambat-' . $this->sambat_id);
    }

    private function getComments()
    {
        $this->comments = SambatComment::with('user')
            ->where('sambat_id', $this->sambat_id)
            ->get();
    }

    public function mount()
    {
        $this->sambat = Sambat::withSum('votes', 'votes')
            ->find($this->sambat_id);
        $this->getComments();
    }

    public function addComments()
    {
        $this->validate(['sambatComment' => "required"]);

        try {
            $this->sambat->comments()->create([
                'user_id' => auth()->id(),
                'description' => $this->sambatComment
            ]);
            $this->sambatComment = '';
            $this->getComments();
            $this->emit('success', "Komentar berhasil dibuat");
        } catch (\Exception $th) {
            $this->emit('error', "Gagal menambah komentar!");
        }
    }

    public function deleteComments($comment_id)
    {
        try {
            SambatComment::destroy($comment_id);
            $this->getComments();
            $this->emit('success', "Komentar berhasil dihapus!");
        } catch (\Exception $th) {
            $this->emit('error', "Gagal mengahapus komentar!");
        }
    }

    public function render()
    {
        return view('guest.sambat.modal-detail');
    }
}
