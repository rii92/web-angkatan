<?php

namespace App\Http\Livewire\Admin\Konsultasi;

use App\Constants\AppKonsul;
use App\Models\Konsul;
use App\Models\User;
use App\Notifications\BellNotification;
use Livewire\Component;
use Illuminate\Support\Str;

class DiscussionRoom extends Component
{
    public Konsul $konsul;

    public $asker, $category;

    public function mount()
    {
        if ($this->category != $this->konsul->category) abort(404);

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
        if ($this->konsul->status != AppKonsul::STATUS_PROGRESS) return $this->emit('error', "Something wrong, you can't close this konsultasi");

        $this->konsul->status = AppKonsul::STATUS_DONE;
        $this->konsul->done_at = now();
        $this->konsul->save();
        $this->sendNotification("telah diakhiri oleh konselor");
        return $this->emit('success', "Success to close this konsultasi");
    }

    public function openRoom()
    {
        if ($this->konsul->status == AppKonsul::STATUS_DONE) return $this->emit('error', "Something wrong, you can't open this konsultasi");

        $this->konsul->status = AppKonsul::STATUS_PROGRESS;
        $this->konsul->done_at = null;
        $this->konsul->save();
        return $this->emit('success', "Success to open konsultasi");
    }

    public function askToPublish()
    {
        if (($this->konsul->status == AppKonsul::STATUS_DONE) && (!$this->konsul->is_publish)) {
            $this->sendNotification('disarankan oleh konselor untuk mempublishnya');
            return  $this->emit('success', "Success to send notification");
        } else
            return $this->emit('error', "Failed to send notification");
    }

    public function render()
    {
        // ini pivot kok banyak masalah kayaknya, semua query yang berhubungan sama pivot disini ga bisa???
        // $this->konsul->markUnreadMessage(false);
        return view('admin.konsultasi.discussion-room')
            ->layout('layouts.dashboard', ['title' => "Discussion Room"]);
    }
}
