<?php

namespace App\Http\Livewire\Admin\Konsultasi;

use App\Constants\AppKonsul;
use App\Models\Konsul;
use App\Models\User;
use App\Notifications\BellNotification;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Illuminate\Support\Str;

class DiscussionRoom extends Component
{
    public $konsul, $asker;

    public function mount($konsul)
    {
        try {
            $this->konsul = Konsul::findOrFail($konsul);
        } catch (\Exception $e) {
            abort(404);
        }

        $category = Request::segment(3);
        if ($this->konsul->category != $category) abort(404);
        $this->asker = User::find($this->konsul->user_id);
    }

    private function sendNotification($message, $link = null)
    {
        $message = "Konsultasimu yang berjudul <b>" . Str::limit($this->konsul->title, 40) . "</b> {$message}";
        if (!$link) $link = route("user.konsultasi.{$this->konsul->category}.room", ['konsul_id' => $this->konsul->id]);
        $this->asker->notify(new BellNotification($message, $link));
    }

    public function closeRoom()
    {
        if ($this->konsul->status == AppKonsul::STATUS_PROGRESS) {
            $this->konsul->status = AppKonsul::STATUS_DONE;
            $this->konsul->done_at = now();
            $this->konsul->save();
            $this->sendNotification("telah diakhiri oleh konseler");
            $this->emit('success', "Success to close this konsultasi");
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

    public function askToPublish()
    {
        if (($this->konsul->status == AppKonsul::STATUS_DONE) && (!$this->konsul->is_publish)) {
            $this->sendNotification('disarankan oleh konseler untuk mempublishnya');
            $this->emit('success', "Success to send notification");
        } else
            $this->emit('error', "Failed to send notification, konsultasi has been published");
    }

    public function render()
    {
        $this->konsul->markUnreadMessage(false);
        return view('admin.konsultasi.discussion-room');
    }
}
