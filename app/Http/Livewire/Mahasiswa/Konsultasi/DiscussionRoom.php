<?php

namespace App\Http\Livewire\Mahasiswa\Konsultasi;

use App\Constants\AppKonsul;
use App\Models\Konsul;
use Livewire\Component;

class DiscussionRoom extends Component
{
    public Konsul $konsul;
    public $category;

    protected $listeners = [
        'openRoom'
    ];

    public function mount()
    {
        if ($this->konsul->user_id != auth()->id()) abort(404);
        if ($this->category != $this->konsul->category) abort(404);
    }

    public function closeRoom()
    {
        if ($this->konsul->status != AppKonsul::STATUS_PROGRESS)
            return $this->emit('error', "Something wrong, you can't close this konsultasi");

        $this->konsul->status = AppKonsul::STATUS_DONE;
        $this->konsul->done_at = now();
        $this->konsul->save();
        
        return $this->emit('success', "Success to close this konsultasi. Do you want to publish your konsultasi?");
    }

    public function openRoom()
    {
        if ($this->konsul->status != AppKonsul::STATUS_DONE)
            return $this->emit('error', "Something wrong, you can't open this konsultasi");

        $this->konsul->status = AppKonsul::STATUS_PROGRESS;
        $this->konsul->done_at = null;
        $this->konsul->save();

        return $this->emit('success', "Success to open konsultasi");
    }

    public function publishKonsultasi()
    {
        if ($this->konsul->status != AppKonsul::STATUS_DONE)
            return $this->emit('error', "Something wrong, you can't publish this konsultasi");

        $this->konsul->is_publish = true;
        $this->konsul->published_at = now();
        $this->konsul->save();

        return $this->emit('success', "Success to publish this konsultasi");
    }

    public function unpublishKonsultasi()
    {
        if ($this->konsul->status != AppKonsul::STATUS_DONE)
            return $this->emit('error', "Something wrong, you can't unpublish this konsultasi");

        $this->konsul->is_publish = false;
        $this->konsul->published_at = null;
        $this->konsul->save();

        return $this->emit('success', "Success to unpublish this konsultasi");
    }

    public function render()
    {
        $this->konsul->markUnreadMessage(true);
        return view('mahasiswa.konsultasi.discussion-room')
            ->layout('layouts.dashboard', ['title' => "Discussion Room"]);
    }
}
