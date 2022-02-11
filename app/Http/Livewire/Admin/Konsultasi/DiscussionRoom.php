<?php

namespace App\Http\Livewire\Admin\Konsultasi;

use App\Constants\AppActivity;
use App\Constants\AppKonsul;
use App\Models\Konsul;
use App\Models\User;
use App\Notifications\BellNotification;
use Livewire\Component;
use Illuminate\Support\Str;

class DiscussionRoom extends Component
{
    public Konsul $konsul;

    public $asker, $category, $adminName;

    public function mount()
    {
        if ($this->category != $this->konsul->category) abort(404);

        $this->konsul->load(['chats.userdetails', 'chats.user']);
        $this->asker = User::find($this->konsul->user_id);
        $this->adminName = auth()->user()->details->admin_name;
    }

    private function sendNotification($message, $link = null)
    {
        $message = "Konsultasimu yang berjudul <b>" . Str::limit($this->konsul->title, 40) . "</b> {$message}";

        if (!$link) $link = route("user.konsultasi.{$this->konsul->category}.room",  $this->konsul->id);

        $this->asker->notify(new BellNotification($message, $link));
    }

    private function addActivity($message, $status = null, $note = null)
    {
        $view = $status ? view('components.konsultasi.status', ['status' => $status]) : '';
        $this->konsul->activity()->attach(auth()->user(), [
            'title' => "<b>{$this->adminName}</b> {$message} {$view}",
            'icon' => AppActivity::TYPE_ADMIN,
            'note' => $note
        ]);
    }

    public function closeRoom()
    {
        if ($this->konsul->status != AppKonsul::STATUS_PROGRESS)
            return $this->emit('error', "Something wrong, you can't close this konsultasi");

        $this->konsul->status = AppKonsul::STATUS_DONE;
        $this->konsul->done_at = now();
        $this->konsul->save();
        $this->sendNotification("telah diakhiri oleh konselor");
        $this->addActivity('mengakhiri konsultasi dan mengubah statusnya menjadi', $this->konsul->status);

        return $this->emit('success', "Success to close this konsultasi");
    }

    public function openRoom()
    {
        if ($this->konsul->status != AppKonsul::STATUS_DONE || $this->konsul->is_publish)
            return $this->emit('error', "Something wrong, you can't open this konsultasi");

        $this->konsul->status = AppKonsul::STATUS_PROGRESS;
        $this->konsul->acc_publish_admin = false;
        $this->konsul->acc_publish_user = false;
        $this->konsul->done_at = null;
        $this->konsul->save();
        $this->addActivity('membuka kembali konsultasi dan mengubah statusnya menjadi', $this->konsul->status);

        return $this->emit('success', "Success to open konsultasi");
    }

    public function publish()
    {
        if ($this->konsul->status != AppKonsul::STATUS_DONE || $this->konsul->acc_publish_admin)
            return $this->emit('error', "Something wrong, try again!");

        $this->konsul->acc_publish_admin = true;

        // kalau penanya sudah setuju juga berarti sudah dipublish
        if ($this->konsul->acc_publish_user) {
            $this->konsul->publishKonsul();
            $link = route('konsultasi.detail', ['slug' => $this->konsul->slug]);
            $this->sendNotification('telah disetujui konselor untuk dipublish. Sekarang konsultasimu sudah bisa diakses oleh siapa saja', $link);
            $this->addActivity('menyetujui untuk mempublish konsultasi', false, 'Konsultasi dipublish <a target="_blank" class="underline text-blue-600" href="' . $link . '"> disini</a>');
            $message = "Success to publish konsultasi";
        } else {
            $this->sendNotification('telah disetujui konselor untuk dipublish. Apakah kamu bersedia juga untuk mempublishnya?');
            $this->addActivity('bersedia untuk mempublish konsultasi ini');
            $message = "Success to take this action";
        }

        $this->konsul->save();
        return  $this->emit('success', $message);
    }

    public function unpublish()
    {
        if ($this->konsul->status != AppKonsul::STATUS_DONE || !$this->konsul->acc_publish_admin)
            return $this->emit('error', "Something wrong, try again!");

        $this->konsul->acc_publish_admin = false;

        // jika user awalnya sudah setuju hapus berarti awalnya
        // konsultasi sudah bisa diakses dari luar sehingga perlu
        // dihapus slugnya sehingga tidak bisa diakses dari luar
        if ($this->konsul->acc_publish_user) $this->konsul->unpublishKonsul();

        $this->konsul->save();
        $this->addActivity('tidak bersedia untuk mempublish konsultasi ini');
        return  $this->emit('success', "Success to take this action");
    }

    public function render()
    {
        $this->konsul->markUnreadMessage(false);
        return view('admin.konsultasi.discussion-room')
            ->layout('layouts.dashboard', ['title' => "Discussion Room"]);
    }
}
