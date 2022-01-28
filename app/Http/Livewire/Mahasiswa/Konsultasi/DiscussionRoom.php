<?php

namespace App\Http\Livewire\Mahasiswa\Konsultasi;

use App\Constants\AppKonsul;
use App\Models\Konsul;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class DiscussionRoom extends Component
{
    public $konsul;
    protected $listeners = ['openRoom'];

    public function mount($konsul)
    {
        try {
            $this->konsul = Konsul::findOrFail($konsul);
        } catch (\Exception $e) {
            abort(404);
        }

        if ($this->konsul->user_id != auth()->user()->id) abort(404);
        if (Request::segment(3) != $this->konsul->category) abort(404);
    }

    public function closeRoom()
    {
        if ($this->konsul->status == AppKonsul::STATUS_PROGRESS) {
            $this->konsul->status = AppKonsul::STATUS_DONE;
            $this->konsul->done_at = now();
            $this->konsul->save();
            $this->emit('success', "Success to close this konsultasi. Do you want to publish your konsultasi?");
        } else
            $this->emit('error', "Something wrong, you can't close this konsultasi");
    }

    public function openRoom()
    {
        if ($this->konsul->status == AppKonsul::STATUS_DONE) {
            $this->konsul->status = AppKonsul::STATUS_PROGRESS;
            $this->konsul->done_at = null;
            $this->konsul->save();
            $this->emit('success', "Success to open konsultasi");
        } else
            $this->emit('error', "Something wrong, you can't open this konsultasi");
    }

    public function publishKonsultasi()
    {
        if ($this->konsul->status == AppKonsul::STATUS_DONE) {
            $this->konsul->is_publish = true;
            $this->konsul->published_at = now();
            $this->konsul->save();
            $this->emit('success', "Success to publish this konsultasi");
        } else
            $this->emit('error', "Something wrong, you can't publish this konsultasi");
    }

    public function unpublishKonsultasi()
    {
        if ($this->konsul->status == AppKonsul::STATUS_DONE) {
            $this->konsul->is_publish = false;
            $this->konsul->published_at = null;
            $this->konsul->save();
            $this->emit('success', "Success to unpublish this konsultasi");
        } else
            $this->emit('error', "Something wrong, you can't unpublish this konsultasi");
    }

    public function render()
    {
        $this->konsul->markUnreadMessage(true);
        return view('mahasiswa.konsultasi.discussion-room');
    }
}
