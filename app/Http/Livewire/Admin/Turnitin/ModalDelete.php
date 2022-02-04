<?php

namespace App\Http\Livewire\Admin\Turnitin;

use App\Constants\AppPermissions;
use App\Models\User;
use App\Models\UserTurnitin;
use App\Notifications\BellNotification;
use LivewireUI\Modal\ModalComponent;

class ModalDelete extends ModalComponent
{
    public $turnitin_id, $alasan;

    public function handleForm()
    {
        // alasannya akan dikirim lewat bell notification
        $this->validate(["alasan" => 'required']);

        $turnitin = UserTurnitin::find($this->turnitin_id);

        if (auth()->user()->can(AppPermissions::TURNITIN_MANAGEMENT)) {
            try {
                $turnitin->activity()->detach();
                $turnitin->delete();

                $message = "Pengajuan Turnitin-mu pada tanggal <b>{$turnitin->created_at}</b> dihapus oleh admin karena {$this->alasan}.";
                User::find($turnitin->user_id)->notify(new BellNotification($message));

                $this->emit('success', "Success delete turnitin submission");
            } catch (\Exception $e) {
                $this->emit('error', "Failed to delete turnitin submission");
            } finally {
                $this->emit('reloadComponents', 'admin.turnitin.table');
            }
        } else
            $this->emit('error', "You don't have access to delete this turnitin submission");

        $this->emit('closeModal');
    }

    public function render()
    {
        return view('admin.turnitin.modal-delete');
    }
}
