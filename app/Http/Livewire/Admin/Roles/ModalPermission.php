<?php

namespace App\Http\Livewire\Admin\Roles;

use Exception;
use App\Constants\AppPermissions;
use App\Constants\AppRoles;
use App\Http\Livewire\GuardsAgainstAccess;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ModalPermission extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::ADMIN_ACCESS;

    public $role;
    public $role_id;

    public $all_permissions;
    public $rolePermissions;
    public $permission;

    public function mount()
    {
        $this->role = Role::find($this->role_id);
        $this->refreshPermissions();
    }

    public function refreshPermissions()
    {
        $this->all_permissions = Permission::all()->pluck('name');
        $this->rolePermissions = $this->role->permissions->pluck('name');
        $this->all_permissions = $this->all_permissions->diff($this->rolePermissions);
    }

    /**
     * add certain permission to role
     *
     * @return void
     */
    public function addPermission()
    {
        $this->validate(['permission' => 'required']);
        
        try {
            $this->role->givePermissionTo($this->permission);
            $this->emit('success', "Success add new permission");
            $this->reset('permission');
        } catch (\Exception $e) {
            $this->emit('error', "Failed to add a new permission");
        } finally {
            $this->refreshPermissions();
        }
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
            if ($this->role->name == AppRoles::ADMIN) {
                if ($permission == AppPermissions::ADMIN_ACCESS) throw new Exception("Failed to remove");
                if ($permission == AppPermissions::DASHBOARD_ACCESS) throw new Exception("Failed to remove");
            }

            $this->role->revokePermissionTo($permission);
            $this->emit('success', "Success revoke {$permission}");
        } catch (\Exception $e) {
            $this->emit('error', 'Failed to revoke permission');
        } finally {
            $this->refreshPermissions();
        }
    }

    public function render()
    {
        return view('admin.roles.modal-permission');
    }
}
