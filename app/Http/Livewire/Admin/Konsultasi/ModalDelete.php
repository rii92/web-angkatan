<?php

namespace App\Http\Livewire\Admin\Konsultasi;

use App\Constants\AppKonsul;
use App\Constants\AppPermissions;
use App\Models\Konsul;
use App\Models\User;
use App\Notifications\BellNotification;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;

class ModalDelete extends ModalComponent
{
    public $konsul_id, $category, $alasan;

    public function handleForm()
    {
        // alasannya akan dikirim lewat bell notification
        $this->validate(["alasan" => 'required']);

        $konsul = Konsul::find($this->konsul_id);
        $permission = $this->category == AppKonsul::TYPE_UMUM ? AppPermissions::REPLY_KONSULTASI_UMUM : AppPermissions::REPLY_KONSULTASI_AKADEMIK;

        if (auth()->user()->can($permission)) {
            try {
                $konsul->tags()->detach();
                $konsul->chats()->detach();
                $konsul->delete();

                $title = Str::limit($konsul->title, 40);
                $message = "Konsultasimu yang berjudul <b>{$title}</b> dihapus konseler karena {$this->alasan}.";
                User::find($konsul->user_id)->notify(new BellNotification($message));

                $this->emit('success', "Success delete konsultasi");
            } catch (\Exception $e) {
                $this->emit('error', "Failed to delete konsultasi");
            } finally {
                $this->emit('reloadComponents', 'admin.konsultasi.table');
            }
        } else
            $this->emit('error', "You don't have access to delete this konsultasi");

        $this->emit('closeModal');
    }

    public function render()
    {
        return view('admin.konsultasi.modal-delete');
    }
}
