<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Admin\GuardsAgainstAccess;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

class ModalRole extends ModalComponent
{
    use GuardsAgainstAccess;

    private $role = ROLE_ADMIN;

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
        return view('admin.users.modal-role');
    }

    public function handleForm()
    {
        $this->user->syncRoles($this->roles);
        $this->emit('reloadComponents', 'admin.users.table');
        $this->emit('success', "Success update {$this->user->name} roles");
        return $this->emit('closeModal');
    }
}
