<?php

namespace App\Http\Livewire\Admin\Konsultasi;

use App\Constants\AppKonsul;
use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\Konsul;
use App\Models\User;
use App\Notifications\BellNotification;
use Livewire\Component;
use Illuminate\Support\Str;

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

        if ($this->status == AppKonsul::STATUS_PROGRESS)
            $message = "Konsultasimu yang berjudul <b>{$title}</b> diterima. Silahkan tunggu jawaban dari konseler atau follow up lagi pertanyaanmu";

        if ($this->status == AppKonsul::STATUS_REJECT)
            $message = "Sorry, konsultasimu yang berjudul <b>{$title}</b> tidak diterima. Cek disini alasannya";

        $url = route("user.konsultasi.{$this->konsul->category}.room", $this->konsul->id);
        $penanya->notify(new BellNotification($message, $url));
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
                'note' => $this->note
            ]);

            $this->sendNotification();
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
