<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Admin\GuardsAgainstAccess;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ModalRole extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = PERMISSION_AKSES_ADMINISTRATOR;

    public $user;
    public $user_id;

    public $all_roles;
    public $all_permission;
    public $permissionToAdd;
    public $roles = [];

    public function mount()
    {
        $this->user = User::find($this->user_id);
        $this->all_roles = Role::all()->pluck('name');
        $this->roles = $this->user->roles->pluck('name');
        $this->all_permission = Permission::get();
    }

    /**
     * add certain permission to user
     *
     * @return void
     */
    public function addPermission()
    {
        if ($this->permissionToAdd) {
            try {
                $this->user->givePermissionTo($this->permissionToAdd);
                $this->emit('success', 'Permission berhasil ditambah');
                $this->reset('permissionToAdd');
                $this->emitSelf('$refresh');
            } catch (\Exception $e) {
                $this->emit('success', 'Permission gagal ditambahkan');
            }
        } else
            $this->emit('error', 'Silahkan pilih permission');
    }

    /**
     * revokePermission from user
     *
     * @param  mixed $permission
     * @return void
     */
    public function revokePermission($permission)
    {
        try {
            $this->user->revokePermissionTo($permission);
            $this->emit('success', 'Permission berhasil direvoke');
        } catch (\Exception $e) {
            $this->emit('error', 'Permission gagal direvoke');
        }
    }

    /**
     * handleForm to update roles of user
     *
     * @return void
     */
    public function handleForm()
    {
        $this->user->syncRoles($this->roles);
        $this->emit('reloadComponents', 'admin.users.table');
        $this->emit('success', "Success update {$this->user->name} roles");
    }

    public function render()
    {
        // get all permission of user
        $userPermissions = $this->user->getPermissionNames();

        // only get permsission that user doesn't already have
        $permissions = $this->all_permission->filter(function ($p, $key) use ($userPermissions) {
            return !$userPermissions->contains($p->name);
        });

        return view('admin.users.modal-role', [
            'userPermissions' => $userPermissions,
            'permissions' => $permissions
        ]);
    }
}
