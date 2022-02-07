<?php

namespace App\Http\Livewire\Activity;

use App\Constants\AppActivity;
use App\Constants\AppPermissions;
use App\Constants\AppTurnitins;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\UserTurnitin;
use LivewireUI\Modal\ModalComponent;

class Turnitin extends ModalComponent
{
    use GuardsAgainstAccess;
    private $permissionGuard = AppPermissions::MAKE_TURNITIN;

    public $turnitin_id, $turnitin, $isAdmin, $komentar;

    public function mount()
    {
        $this->turnitin = UserTurnitin::find($this->turnitin_id);
    }

    /**
     * handleForm
     *
     * @return void
     */
    public function handleForm()
    {
        $this->validate(['komentar' => 'required']);

        try {
            if ($this->turnitin->status == AppTurnitins::STATUS_REVISI_LINK || ($this->turnitin->status == AppTurnitins::STATUS_PROGRESS && $this->isAdmin)) {
                $name = $this->isAdmin ? "Admin" : auth()->user()->name;
                $this->turnitin->activity()->attach(auth()->user(), [
                    'title' => "<b>{$name}</b> menambah komentar",
                    'icon' => $this->isAdmin ? AppActivity::TYPE_ADMIN : AppActivity::TYPE_PHOTO,
                    'note' => $this->komentar
                ]);
                $this->turnitin->update(['updated_at' => now()]);
                $this->turnitin->refresh();
            } else
                throw new \Exception("Don't have access to add komentar");

            $this->emit('success', "Success to add komentar");
        } catch (\Exception $e) {
            $this->emit('error', "Failed to add komentar");
        } finally {
            $component = $this->isAdmin ? 'admin.turnitin.table' : 'mahasiswa.turnitin.table';
            $this->emit('reloadComponents', $component);
            $this->komentar = null;
        }
    }


    public function render()
    {
        return view('activity.turnitin');
    }
}
