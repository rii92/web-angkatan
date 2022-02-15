<?php

namespace App\Http\Livewire\Konsultasi;

use App\Constants\AppKonsul;
use App\Models\KonsulChat;
use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;


class ModalDeleteChat extends ModalComponent
{
    public $chat_id, $route;
    public KonsulChat $chat;

    public function mount()
    {
        $this->chat = KonsulChat::find($this->chat_id);
    }

    public function handleForm()
    {
        try {
            if ($this->chat->type == AppKonsul::TYPE_CHAT_IMAGE)
                Storage::disk('public')->delete($this->chat->chat);

            $this->chat->delete();

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
