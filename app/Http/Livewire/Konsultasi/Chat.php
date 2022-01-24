<?php

namespace App\Http\Livewire\Konsultasi;

use App\Models\Konsul;
use Livewire\Component;

class Chat extends Component
{
    public $konsul_id;
    private $konsul, $konsulChat;

    public function mount()
    {
        $this->konsul = Konsul::find($this->konsul_id)->first();
        $this->konsulChat = $this->konsul->chat();
    }

    public function render()
    {
        // ddd($this->konsulChat->get()->toArray());
        return view('konsultasi.chat', [
            'konsul' => $this->konsul,
            'chats' => $this->konsulChat
        ]);
    }
}
