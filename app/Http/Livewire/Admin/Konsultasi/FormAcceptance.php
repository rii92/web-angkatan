<?php

namespace App\Http\Livewire\Admin\Konsultasi;

use App\Constants\AppActivity;
use App\Constants\AppKonsul;
use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Konsul;
use App\Models\User;
use App\Notifications\BellNotification;
use App\Notifications\EmailNotifications;
use Illuminate\Notifications\Messages\MailMessage;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;

class FormAcceptance extends Component
{
    use GuardsAgainstAccess;

    public $status, $note, $konsul;
    protected $permissionGuard;
    protected $listeners = ['submitForm'];

    public function rules()
    {
        return [
            'status' => 'required'
        ];
    }

    public function mount(Konsul $konsul)
    {
        $this->konsul = $konsul;
        $this->permissionGuard = $this->konsul->category == AppKonsul::TYPE_UMUM ? AppPermissions::REPLY_KONSULTASI_UMUM : AppPermissions::REPLY_KONSULTASI_AKADEMIK;
    }

    /**
     * send bell notification to asker
     *
     * @return void
     */
    private function sendNotification()
    {
        $penanya = User::find($this->konsul->user_id);
        $title = Str::limit($this->konsul->title, 40);

        if ($this->status == AppKonsul::STATUS_PROGRESS) {
            $message = "Konsultasimu yang berjudul <b>{$title}</b> diterima. Silahkan tunggu jawaban dari konselor atau follow up lagi pertanyaanmu";
            $subject = "Pengajuan Konsultasi Diterima";
        }

        if ($this->status == AppKonsul::STATUS_REJECT) {
            $message = "Sorry, konsultasimu yang berjudul <b>{$title}</b> tidak diterima. Cek alasannya";
            $subject = "Pengajuan Konsultasi Tidak Diterima";
        }

        $url = route("user.konsultasi.{$this->konsul->category}.room", $this->konsul->id);
        $penanya->notify(new BellNotification($message, $url));

        if ($penanya->details && $penanya->details->setting_send_email_accept_konsultasi)
            $penanya->notify(new EmailNotifications((new MailMessage)
                ->subject("PA60 - {$subject}")
                ->greeting("Halo {$penanya->name},")
                ->line(new HtmlString($message))
                ->action("Discussion Room", $url)
                ->line("Regards,")
                ->salutation("Tim Akademik 60")));
    }

    public function submitForm($note)
    {
        $this->validate();
        // Jika ditolak maka wajib ada notenya
        if ($this->status == AppKonsul::STATUS_REJECT) {
            $this->note = $note;
            $this->validate(['note' => 'required']);
        }

        try {
            $this->konsul->update([
                'status' => $this->status,
                'note' => $this->note,
                'acc_rej_at' => now()
            ]);

            $this->sendNotification();

            $view = view('components.konsultasi.status', ['status' => $this->konsul->status]);
            $this->konsul->activity()->attach(auth()->user(), [
                'title' => "<b>Admin</b> mengubah status konsultasi menjadi {$view}",
                'icon' => AppActivity::TYPE_ADMIN,
                'note' => $this->note ? strip_tags(Str::markdown($this->note)) : null
            ]);

            $this->emit('success', "Success to change status konsultasi");
            $this->emit('reloadComponents', 'admin.konsultasi.discussion-room');
        } catch (\Exception $e) {
            $this->emit('error', "Failed to change status konsultasi");
        }
    }


    public function render()
    {
        return view('admin.konsultasi.form-acceptance');
    }
}
