<?php

namespace App\Http\Livewire\Admin\Konsultasi;

use App\Constants\AppKonsul;
use App\Constants\AppPermissions;
use App\Models\Konsul;
use App\Models\User;
use App\Notifications\BellNotification;
use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;

class ModalDelete extends ModalComponent
{
    public $konsul_id, $category, $alasan;

    public function handleForm()
    {
        // alasannya akan dikirim lewat bell notification
        $this->validate(["alasan" => 'required']);

        $konsul = Konsul::find($this->konsul_id);
        $permission = $this->category == AppKonsul::TYPE_UMUM ? AppPermissions::REPLY_KONSULTASI_UMUM : AppPermissions::REPLY_KONSULTASI_AKADEMIK;

        if (auth()->user()->can($permission)) {
            $konsul->tags()->detach();

            $chatWithImage = $konsul->chats()->where('konsul_chats.type', AppKonsul::TYPE_CHAT_IMAGE)->get();

            foreach ($chatWithImage as $chat) Storage::disk('public')->delete($chat->chat);

            $konsul->chats()->delete();
            $konsul->activity()->detach();

            $konsul->delete();

            $title = Str::limit($konsul->title, 40);
            $message = "Konsultasimu yang berjudul <b>{$title}</b> dihapus konselor karena {$this->alasan}.";
            User::find($konsul->user_id)->notify(new BellNotification($message));

            $this->emit('success', "Success delete konsultasi");

            try {
            } catch (\Exception $e) {
                $this->emit('error', "Failed to delete konsultasi");
            } finally {
                $this->emit('reloadComponents', 'admin.konsultasi.table');
            }
        } else
            $this->emit('error', "You don't have access to delete this konsultasi");

        $this->emit('closeModal');
    }

    public function render()
    {
        return view('admin.konsultasi.modal-delete');
    }
}
