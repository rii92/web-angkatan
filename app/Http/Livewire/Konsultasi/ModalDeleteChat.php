<?php

namespace App\Http\Livewire\Konsultasi;

use App\Constants\AppKonsul;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;


class ModalDeleteChat extends ModalComponent
{
    public $chat_id, $route, $chatType;
    const TABLE = "konsul_chats";

    public function mount($chatType)
    {
        $this->chatType = $chatType == AppKonsul::TYPE_CHAT_IMAGE ? 'gambar' : 'pesan';
    }

    public function handleForm()
    {
        $chat = DB::table(self::TABLE)->find($this->chat_id);
        try {
            if ($chat->type == AppKonsul::TYPE_CHAT_IMAGE)
                Storage::disk('public')->delete($chat->chat);

            DB::table(self::TABLE)->delete($chat->id);

            $this->emit('success', "Success to delete");
        } catch (\Exception $e) {
            $this->emit('error', "Failed to delete");
        } finally {
            $this->emit('reloadComponents', "{$this->route}.konsultasi.discussion-room");
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('components.konsultasi.modal-delete-chat');
    }
}
