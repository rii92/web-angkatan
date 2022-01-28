<?php

namespace App\Http\Livewire\Konsultasi;

use App\Constants\AppKonsul;
use App\Models\Konsul;
use Livewire\Component;

class InputChat extends Component
{
    public $konsul, $chat, $route, $reloadComponent, $is_admin;
    protected $listeners = ['submitFormChat'];

    public function mount(Konsul $konsul, $route)
    {
        $this->konsul = $konsul;
        $this->route = route($route . '.konsultasi.' . $konsul->category . '.table');
        $this->reloadComponent = $route == "user" ? 'mahasiswa.konsultasi.discussion-room' : 'admin.konsultasi.discussion-room';
        $this->is_admin = $route == "admin";
    }

    public function submitFormChat($chat)
    {
        if ($this->konsul->status == AppKonsul::STATUS_PROGRESS) {
            $this->chat = $chat;
            $this->validate(['chat' => 'required']);
            $this->konsul->chats()->attach(auth()->user(), [
                'is_admin' => $this->is_admin,
                'type' => AppKonsul::TYPE_CHAT_TEXT,
                'chat' => $this->chat
            ]);
            $this->konsul->update(['updated_at' => now()]);
        } else
            $this->emit('error', "You can't send message to this konsultasi");

        $this->emit('reloadComponents', $this->reloadComponent);
        $this->emit('clearChatEditor');
    }

    public function render()
    {
        return view('components.konsultasi.input-chat');
    }
}
