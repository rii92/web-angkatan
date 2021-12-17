<?php

namespace App\Http\Livewire\Admin\Roles;

use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ModalPermission extends ModalComponent
{

    public $role_id;
    public $role;
    public $all_permission;
    public $permissionToAdd;

    public function mount()
    {
        $this->role = Role::find($this->role_id);
        $this->all_permission = Permission::get();
    }

    public function addPermission()
    {
        if ($this->permissionToAdd) {
            try {
                $this->role->givePermissionTo($this->permissionToAdd);
                $this->emit('success', 'Permission berhasil ditambah');
                $this->reset('permissionToAdd');
                $this->emitSelf('$refresh');
            } catch (\Exception $e) {
                $this->emit('success', 'Permission gagal ditambahkan');
            }
        } else
            $this->emit('error', 'Silahkan pilih permission');
    }

    public function revokePermission($permission)
    {
        $this->role->revokePermissionTo($permission);
        $this->emit('success', 'Permission berhasil direvoke');
    }

    public function render()
    {
        $rolePermissions = $this->role->getPermissionNames();

        // Mengambil hanya permission yang belum dimiliki role
        $permissions = $this->all_permission->filter(function ($p, $key) use ($rolePermissions) {
            return !$rolePermissions->contains($p->name);
        });

        return view('admin.roles.modal-permission', [
            'rolePermission' => $rolePermissions,
            'permissions' => $permissions
        ]);
    }
}
