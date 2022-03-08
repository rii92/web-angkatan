<?php

namespace App\Http\Livewire\Mahasiswa\Turnitin;

use App\Constants\AppActivity;
use App\Constants\AppPermissions;
use App\Constants\AppTurnitins;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\User;
use App\Models\UserTurnitin;
use App\Notifications\EmailNotifications;
use Illuminate\Notifications\Messages\MailMessage;
use LivewireUI\Modal\ModalComponent;

class ModalAddEdit extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::MAKE_TURNITIN;

    public $turnitin;
    public $turnitin_id;
    public $user;

    public function rules()
    {
        return [
            'turnitin.link_file' => 'required|url',
        ];
    }

    public function mount()
    {
        $this->turnitin = $this->turnitin_id ? UserTurnitin::find($this->turnitin_id) : new UserTurnitin();
        $this->user = $this->turnitin_id ? User::find($this->turnitin->user_id) : auth()->user();

        if ($this->user->id != auth()->id()) abort(404);
    }

    private function sendEmailToPJTurnitin()
    {
        $nimPJ = '211810302'; # PJ Turnitin Fayadh Abiyyi
        $user  = User::where('email', $nimPJ . '@stis.ac.id')->first();

        $user->notify(new EmailNotifications((new MailMessage)
            ->subject("PA60 - Terdapat Pengajuan Turnitin Baru")
            ->greeting("Halo {$user->name},")
            ->line("{$this->user->name} baru saja melakukan pengajuan jasa pengecekan Turnitin")
            ->action("Halaman Turnitin", route('admin.turnitin.table'))
            ->line("Regards,")
            ->salutation("Tim TI Angkatan 60")));
    }

    private function add()
    {
        $this->turnitin->user()->associate($this->user);
        $this->turnitin->save();
        $this->turnitin->activity()->attach($this->user, [
            'title' => "<b>{$this->user->name}</b> melakukan pengajuan penggunaan jasa pengecekan Turnitin",
            'icon' => AppActivity::TYPE_PHOTO,
            'note' => 'File yang akan dicek berada <a target="_blank" class="underline text-blue-600" href="' . $this->turnitin->link_file . '">disini</a>'
        ]);
        $this->emit('success', "Success to add new turnitins submission");
        $this->sendEmailToPJTurnitin();
    }

    private function update()
    {
        if ($this->turnitin->isDirty('link_file') && in_array($this->turnitin->status, [AppTurnitins::STATUS_WAIT, AppTurnitins::STATUS_REVISI_LINK])) {
            $this->turnitin->save();
            $this->turnitin->activity()->attach($this->user, [
                'title' => "<b>{$this->user->name}</b> merubah link file pengajuan",
                'icon' => AppActivity::TYPE_PHOTO,
                'note' => 'File yang akan dicek sekarang berada <a target="_blank" class="underline text-blue-600" href="' . $this->turnitin->link_file . '">disini</a>'
            ]);
        }
        $this->emit('success', "Saved Changes!");
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
            if ($this->turnitin_id) $this->update();
            else $this->add();
        } catch (\Exception $e) {
            $this->emit('error', "Failed to add new turnitins");
        } finally {
            $this->emit('closeModal');
            $this->emit('reloadComponents', 'mahasiswa.turnitin.table');
        }
    }

    public function render()
    {
        return view('mahasiswa.turnitin.modal-add-edit');
    }
}
