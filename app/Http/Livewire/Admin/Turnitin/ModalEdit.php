<?php

namespace App\Http\Livewire\Admin\Turnitin;

use App\Constants\AppActivity;
use App\Constants\AppPermissions;
use App\Constants\AppTurnitins;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\User;
use App\Models\UserTurnitin;
use App\Notifications\BellNotification;
use App\Notifications\EmailNotifications;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;
use LivewireUI\Modal\ModalComponent;

class ModalEdit extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::TURNITIN_MANAGEMENT;
    public $turnitin, $turnitin_id, $note, $status;

    public function rules()
    {
        $rules = [];
        if (in_array($this->turnitin->status, [AppTurnitins::STATUS_PROGRESS, AppTurnitins::STATUS_DONE]))
            $rules['turnitin.link_hasil'] = 'required|url';
        else
            $rules['status'] = 'required';

        if (in_array($this->status, [AppTurnitins::STATUS_REVISI_LINK, AppTurnitins::STATUS_REJECT]))
            $rules['note'] = 'required';
        return $rules;
    }

    public function mount()
    {
        $this->turnitin = UserTurnitin::find($this->turnitin_id);
    }

    private function saveUpdated($status)
    {
        $this->turnitin->status = $status;
        $this->turnitin->save();
    }

    private function sendBellNotification($message)
    {
        $user = User::find($this->turnitin->user_id);
        $user->notify(new BellNotification($message, route('user.turnitin.table')));
        return $user;
    }

    private function addActivity($status, $note = null)
    {
        $view = view('components.turnitin.status', ['status' => $status, 'display' => 'inline']);
        $this->turnitin->activity()->attach(auth()->user(), [
            'title' => "<b>Admin</b> mengubah status pengajuan menjadi {$view}",
            'icon' => AppActivity::TYPE_ADMIN,
            'note' => $note ? $note : $this->note
        ]);
    }

    /**
     * fungsi yang dijalankan ketika status berbah ke revisi link, reject, dan progress
     *
     * @param  mixed $status
     * @return void
     */
    private function statusChange($status)
    {
        $this->saveUpdated($status);

        if ($status == AppTurnitins::STATUS_REJECT)
            $this->sendBellNotification("Pengajuan Turnitin-mu ditolak oleh admin. Segera cek alasannya");
        else if ($status == AppTurnitins::STATUS_REVISI_LINK)
            $this->sendBellNotification("Pengajuan Turnitin-mu berubah statusnya menjadi <b>Revisi Link</b>. Segera lakukan revisi link agar admin dapat segera memproses pengajuanmu");

        $this->addActivity($status);
    }

    /**
     * fungsi yang dijalankan ketika status akan berubah jadi done
     * dipisahkan karena ada pengiriman email dan notes yang berbeda pada activity
     *
     * @return void
     */
    private function done()
    {
        $this->saveUpdated(AppTurnitins::STATUS_DONE);
        $user = $this->sendBellNotification("Pengajuan Turnitin-mu telah selesai. Yuk lihat hasilnya");

        $note = "Kalimat yang ditandai/diberikan highlights dalam file hasil pemeriksaan dideteksi oleh turnitin sebagai plagiarisme. Kamu bisa melakukan langkah perbaikan pada bagian tesebut seperti dengan melakukan parafrase dsb.";
        $this->addActivity(AppTurnitins::STATUS_DONE, 'File hasil pemeriksaan berada <a target="_blank" class="underline text-blue-600" href="' . $this->turnitin->link_hasil . '">disini</a>. ' . $note);

        $user->notify(new EmailNotifications((new MailMessage)
            ->subject("PA60 - Pemeriksaan Turnitin Telah Selesai")
            ->greeting("Halo {$user->name},")
            ->line("Pengecekan filemu menggunakan turnitin telah selesai. Segera cek hasilnya!")
            ->line(new HtmlString("<b>Notes: {$note}</b>"))
            ->action("Hasil Pemeriksaan", route('user.turnitin.table'))
            ->line("Regards,")
            ->salutation("Tim Turnitin Angkatan 60")));
    }

    /**
     * fungsi yang dijalankan ketika status sudah done dan terjadi perubahan link hasil pengecekan
     *
     * @return void
     */
    private function edit()
    {
        if ($this->turnitin->isDirty('link_hasil')) {
            $this->turnitin->save();
            $this->turnitin->activity()->attach(auth()->user(), [
                'title' => "<b>Admin</b> mengubah link file hasil pemeriksaan",
                'icon' => AppActivity::TYPE_ADMIN,
                'note' => 'File hasil pemeriksaan sekarang berada <a target="_blank" class="underline text-blue-600" href="' . $this->turnitin->link_hasil . '">disini</a>'
            ]);
        }
    }


    /**
     * handleForm
     *
     * @return void
     */
    public function handleForm()
    {
        $this->validate();
        try {
            if (in_array($this->status, [AppTurnitins::STATUS_REVISI_LINK, AppTurnitins::STATUS_PROGRESS, AppTurnitins::STATUS_REJECT])) $this->statusChange($this->status);
            else if ($this->turnitin->status == AppTurnitins::STATUS_PROGRESS) $this->done();
            else if ($this->turnitin->status == AppTurnitins::STATUS_DONE) $this->edit();

            $this->emit('success', "Success to change status!");
            $this->emit('closeModal');
            $this->status = null;
        } catch (\Exception $e) {
            $this->emit('error', "Failed to add change status");
        } finally {
            $this->emit('reloadComponents', 'admin.turnitin.table');
        }
    }

    public function render()
    {
        return view('admin.turnitin.modal-edit');
    }
}
