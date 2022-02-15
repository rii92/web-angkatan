<?php

namespace App\Http\Livewire\Guest\Sambat;

use App\Constants\AppPermissions;
use LivewireUI\Modal\ModalComponent;
use App\Models\Sambat;
use App\Models\User;
use App\Notifications\BellNotification;
use App\Notifications\EmailNotifications;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;

class ModalDelete extends ModalComponent
{
    public $sambat_id, $route, $alasan;

    public function handleForm()
    {
        $sambat = Sambat::find($this->sambat_id);

        if (auth()->id() != $sambat->user_id and !auth()->user()->can(AppPermissions::DELETE_SAMBAT))
            return $this->emit('error', "Gagal menghapus sambat");

        if ($this->route == 'admin') $this->validate(['alasan' => 'required']);

        try {
            $sambat->delete();

            $this->emit('success', "Sukses menghapus sambat");

            switch ($this->route) {
                case 'admin':
                    $this->sendNotification($sambat);
                    $this->emit('reloadComponents', 'admin.sambat.table');
                    break;
                case 'user':
                    $this->emit('reloadComponents', 'mahasiswa.sambat.table');
                    break;
                default:
                    $this->emit('reloadComponents', 'guest.sambat.lists');
                    $this->emit('reloadComponents', 'mahasiswa.sambat.table'); //close anything
                    $this->emit('reloadComponents', 'admin.sambat.table'); //close anything
                    break;
            }
        } catch (\Exception $e) {
            $this->emit('error', "Gagal menghapus sambat");
        } finally {
            $this->skipPreviousModal(1)->destroySkippedModals()->closeModal();
        }
    }

    private function sendNotification($sambat)
    {
        $message = "Sambatanmu pada tanggal {$sambat->created_at->format('d-M-Y H:i')} dihapus oleh admin karena <b>{$this->alasan}</b>";

        // bell notification
        $user = User::find($sambat->user_id);
        $user->notify(new BellNotification($message));

        // email notification
        $name = $sambat->is_anonim ?  $user->details->anonim_name_value : $user->name;
        $user->notify(new EmailNotifications((new MailMessage)
            ->subject("PA60 - Sambatanmu di-takedown")
            ->greeting("Halo {$name},")
            ->line(new HtmlString($message))
            ->line(new HtmlString("<small><i>Untuk kedepannya diharapkan lebih memperhatikan sambatan yang dibuat. Sambatan yang  akan ditake down adalah sambatan yang mengandung<b>kebencian, hoax, sara, dan pornografi</b></i></small>"))
            ->line("Regards,")
            ->salutation("Tim Humas 60")));
    }

    public function render()
    {
        return view('guest.sambat.modal-delete');
    }
}
