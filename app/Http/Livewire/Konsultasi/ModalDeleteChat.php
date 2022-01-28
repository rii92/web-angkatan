<?php

namespace App\Http\Livewire\Konsultasi;

use App\Constants\AppKonsul;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;


class ModalDeleteChat extends ModalComponent
{
    public $chat_id, $route;
    const TABLE = "konsul_chats";

    public function handleForm()
    {
        $chat = DB::table(self::TABLE)->find($this->chat_id);
        try {
            // if ($chat->type == AppKonsul::TYPE_CHAT_IMAGE)
            DB::table(self::TABLE)->delete($chat->id);

            $this->emit('success', "Success to delete chat");
        } catch (\Exception $e) {
            $this->emit('error', "Failed to delete chat");
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
