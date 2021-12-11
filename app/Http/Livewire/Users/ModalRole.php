<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

class ModalRole extends ModalComponent
{
    use GuardsAgainstAccess;

    private $role = "admin";

    public $user;
    public $user_id;
    
    public $all_roles;
    public $roles = [];

    public function mount()
    {
        $this->user = User::find($this->user_id);
        $this->all_roles = Role::all()->pluck('name');
        $this->roles = $this->user->roles->pluck('name');
    }

    public function render()
    {
        return view('dashboard.users.modal-role');
    }

    public function handleForm()
    {
        $this->user->syncRoles($this->roles);
        $this->emit('reloadComponents', 'users.table');
        $this->emit('success', "Success update {$this->user->name} roles");
        return $this->emit('closeModal');
    }
}
