<?php

namespace App\Http\Livewire\Konsultasi;

use App\Constants\AppKonsul;
use App\Models\Konsul;
use App\Models\KonsulChat;
use App\Models\User;
use App\Notifications\EmailNotifications;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class InputChat extends Component
{
    public $konsul, $chat, $routeBack, $reloadComponent, $is_admin;

    protected $listeners = [
        'submitFormChat'
    ];

    public function mount(Konsul $konsul, $route)
    {
        $this->konsul = $konsul;

        $this->reloadComponent = $route == "user"
            ? 'mahasiswa.konsultasi.discussion-room'
            : 'admin.konsultasi.discussion-room';

        $this->is_admin = $route == "admin";
        $this->routeBack = $route == "admin"
            ? route("admin.konsultasi.{$this->konsul->category}.table")
            : route("user.konsultasi.{$this->konsul->category}.table");
    }

    public function submitFormChat($chat)
    {
        if ($this->konsul->status != AppKonsul::STATUS_PROGRESS) {
            $this->emit('reloadComponents', $this->reloadComponent);
            return $this->emit('error', "You can't send message to this konsultasi");
        }

        $this->chat = $chat;

        $this->validate([
            'chat' => 'required'
        ]);

        $this->konsul->chats()->save(new KonsulChat([
            'user_id' => auth()->id(),
            'is_admin' => $this->is_admin,
            'type' => AppKonsul::TYPE_CHAT_TEXT,
            'chat' => $this->chat,
        ]));

        $this->konsul->update(['updated_at' => now()]);

        // send email notification
        if ($this->is_admin) $this->sendEmailToAsker();
        else if ($this->konsul->category == AppKonsul::TYPE_AKADEMIK) $this->sendEmailToAdmin();

        $this->emit('reloadComponents', $this->reloadComponent);
        $this->emit('clearChatEditor');
    }

    private function sendEmailToAsker()
    {
        $lastChat = $this->konsul->chats()->latest()->skip(1)->first();
        $lastChatTime = $lastChat ? $lastChat->created_at : $this->konsul->acc_rej_at;

        $penanya = User::find($this->konsul->user_id);
        $interval = $penanya->details->setting_send_email_reply_konsultasi ?? 0;

        // kalau settingannya bernilai 0 maka notifikasi email tidak dinyalakan untuk reply konsultasi
        // jika tidak bernilai 0 maka angka tersebut maksudnya adalah selisih jam dengan last chat dari user
        if ($interval != 0 && $lastChatTime < now()->subHours($interval)) {
            $message = "Ada pesan baru pada konsultasimu yang berjudul <b>{$this->konsul->title}</b>. Cek sekarang!";
            $url = route("user.konsultasi.{$this->konsul->category}.room", $this->konsul->id);

            $penanya->notify(new EmailNotifications((new MailMessage)
                ->subject("PA60 - Pesan Baru pada Konsultasi")
                ->greeting("Halo {$penanya->name},")
                ->line(new HtmlString($message))
                ->action("Discussion Room", $url)
                ->line("Regards,")
                ->salutation("Tim Akademik 60")));
        }
    }

    private function sendEmailToAdmin()
    {
        $lastChat = $this->konsul->chats()->latest()->skip(1)->first();
        $lastChatTime = $lastChat ? $lastChat->created_at : $this->konsul->acc_rej_at;

        // send an email if the last chat was 20 minutes ago
        if ($lastChatTime < now()->subMinutes(20)) {
            $konselor = AppKonsul::getKonselor(now()->dayOfWeek, $this->konsul->userdetails->jurusan_short);

            $message = "Terdapat balasan pada konsultasi \"<b>{$this->konsul->title}</b>\" Yuk segera ditanggapi!!";

            $url = route("admin.konsultasi.{$this->konsul->category}.room", $this->konsul->id);

            foreach ($konselor as $nim) {
                $user  = User::where('email', $nim . '@stis.ac.id')->first();
                $user->notify(new EmailNotifications((new MailMessage)
                    ->subject("PA60 - Pesan Baru pada Konsultasi")
                    ->greeting("Halo {$user->name},")
                    ->line(new HtmlString($message))
                    ->action("Discussion Room", $url)
                    ->line("Regards,")
                    ->salutation("Tim TI Angkatan 60")));
            }
        }
    }

    public function render()
    {
        return view('components.konsultasi.input-chat');
    }
}
