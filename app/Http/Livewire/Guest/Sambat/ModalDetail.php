<?php

namespace App\Http\Livewire\Guest\Sambat;

use App\Constants\AppPermissions;
use App\Models\Sambat;
use App\Models\SambatComment;
use App\Models\User;
use App\Notifications\BellNotification;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;

class ModalDetail extends ModalComponent
{
    public $sambat_id, $sambatComment, $isAnonim = false, $route;
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
        switch ($this->route) {
            case 'user':
                return $this->emit('reloadComponents', 'mahasiswa.sambat.table');
            case 'admin':
                return $this->emit('reloadComponents', 'admin.sambat.table');
            default:
                return $this->emit('refresh-item-sambat-' . $this->sambat_id);
        }
    }

    public function mount()
    {
        $this->sambat = Sambat::with('userdetails')
            ->withSum('votes', 'votes')
            ->find($this->sambat_id);
    }

    private function getComments()
    {
        return SambatComment::with(['user', 'userdetails'])
            ->where('sambat_id', $this->sambat_id)
            ->get();
    }

    public function addComments()
    {
        if (!auth()->check())
            return $this->emit('error', "Login dulu ya baru bisa komen");

        $this->validate(['sambatComment' => "required"]);

        try {
            $this->sambat->comments()->create([
                'user_id' => auth()->id(),
                'description' => $this->sambatComment,
                'is_anonim' => $this->isAnonim
            ]);
            $this->sambatComment = '';
            $this->emit('success', "Komentar berhasil dibuat");
        } catch (\Exception $th) {
            $this->emit('error', "Gagal menambah komentar!");
        }
    }

    public function deleteComments($comment_id)
    {
        if (!auth()->check())
            return $this->emit('error', "Login dulu ya baru bisa hapus komentar");

        $comment = SambatComment::find($comment_id);
        if (auth()->id() != $comment->user_id and !auth()->user()->can(AppPermissions::DELETE_SAMBAT))
            return $this->emit('error', "Gagal menghapus komentar");

        try {
            $comment->delete();
            $this->emit('success', "Komentar berhasil dihapus!");

            // jika berbeda maka yang hapus adalah admin
            // kirim bell notifikasi ke user yang membuat komentar
            if ($comment->user_id != auth()->id()) {
                $user = User::find($comment->user_id);
                $description = Str::limit($comment->description);
                $message = "Komentarmu <b>{$description}</b> pada tanggal {$comment->created->at} dihapus oleh admin.";
                $user->notify(new BellNotification($message));
            }
        } catch (\Exception $th) {
            $this->emit('error', "Gagal mengahapus komentar!");
        }
    }

    public function render()
    {
        return view('guest.sambat.modal-detail', ['comments' => $this->getComments()]);
    }
}
