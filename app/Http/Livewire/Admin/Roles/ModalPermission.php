<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Http\Livewire\Admin\GuardsAgainstAccess;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ModalPermission extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = PERMISSION_AKSES_ADMINISTRATOR;

    public $role_id;
    public $role;
    public $all_permission;
    public $permissionToAdd;

    public function mount()
    {
        $this->role = Role::find($this->role_id);
        $this->all_permission = Permission::get();
    }

    /**
     * add certain permission to role
     *
     * @return void
     */
    public function addPermission()
    {
        if ($this->permissionToAdd) {
            try {
                $this->role->givePermissionTo($this->permissionToAdd);
                $this->emit('success', 'Permission berhasil ditambah');
                $this->reset('permissionToAdd');
            } catch (\Exception $e) {
                $this->emit('success', 'Permission gagal ditambahkan');
            }
        } else
            $this->emit('error', 'Silahkan pilih permission');
    }

    /**
     * revokePermission from role
     *
     * @param  mixed $permission
     * @return void
     */
    public function revokePermission($permission)
    {
        try {
            $this->role->revokePermissionTo($permission);
            $this->emit('success', 'Permission berhasil direvoke');
        } catch (\Exception $e) {
            $this->emit('error', 'Permission gagal direvoke');
        }
    }

    public function render()
    {
        // get all permission of role
        $rolePermissions = $this->role->getPermissionNames();

        // get only permission that the role doesn't already have
        $permissions = $this->all_permission->filter(function ($p, $key) use ($rolePermissions) {
            return !$rolePermissions->contains($p->name);
        });

        return view('admin.roles.modal-permission', [
            'rolePermissions' => $rolePermissions,
            'permissions' => $permissions
        ]);
    }
}
