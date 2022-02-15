<?php

namespace App\Http\Livewire\Konsultasi;

use App\Constants\AppKonsul;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Konsul;
use App\Models\KonsulChat;

class UploadImage extends Component
{
    use WithFileUploads;
    public $konsul, $image, $reloadComponent, $is_admin;

    public function mount(Konsul $konsul, $route)
    {
        $this->konsul = $konsul;
        
        $this->reloadComponent = $route == "user"
            ? 'mahasiswa.konsultasi.discussion-room'
            : 'admin.konsultasi.discussion-room';

        $this->is_admin = $route == "admin";
    }

    public function updatedImage()
    {
        if ($this->konsul->status != AppKonsul::STATUS_PROGRESS) return $this->emit('error', "You can't send image to this konsultasi");

        $this->validate(['image' => 'image|max:2048']);

        $url = $this->image->storePublicly('konsultasi', ['disk' => 'public']);

        $this->konsul->chats()->save(new KonsulChat([
            'user_id' => auth()->id(),
            'is_admin' => $this->is_admin,
            'type' => AppKonsul::TYPE_CHAT_IMAGE,
            'chat' => $url
        ]));

        $this->konsul->update(['updated_at' => now()]);

        $this->emit('success', "Image send!");
        $this->emit('reloadComponents', $this->reloadComponent);

        $this->reset('image');
    }


    public function render()
    {
        return view('components.konsultasi.upload-image');
    }
}
