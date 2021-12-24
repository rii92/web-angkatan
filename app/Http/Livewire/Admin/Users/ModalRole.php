<?php

namespace App\Http\Livewire\Admin\Users;

use App\Constants\AppPermissions;
use App\Http\Livewire\GuardsAgainstAccess;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ModalRole extends ModalComponent
{
    use GuardsAgainstAccess;

    private $permissionGuard = AppPermissions::ADMIN_ACCESS;

    public $user;
    public $user_id;

    public $all_roles;
    public $roles = [];

    public $all_permissions;
    public $userPermissions = [];
    public $permission;

    public function mount()
    {
        $this->user = User::find($this->user_id);

        $this->all_roles = Role::all()->pluck('name');
        $this->roles = $this->user->roles->pluck('name');
        $this->refreshPermissions();
    }

    public function refreshPermissions()
    {
        $this->all_permissions = Permission::all()->pluck('name');
        $this->userPermissions = $this->user->permissions->pluck('name');
        $this->all_permissions = $this->all_permissions->diff($this->userPermissions);
    }

    /**
     * add certain permission to user
     *
     * @return void
     */
    public function addPermission()
    {
        $this->validate(['permission' => 'required']);
        
        try {
            $this->user->givePermissionTo($this->permission);
            $this->emit('success', "Success add new permission to {$this->user->name}");
            $this->reset('permission');
        } catch (\Exception $e) {
            $this->emit('error', "Failed to add a new permission to {$this->user->name}");
        } finally {
            $this->refreshPermissions();
        }
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
            $this->emit('success', "Success revoke {$permission}");
        } catch (\Exception $e) {
            $this->emit('error', 'Failed to revoke permission');
        } finally {
            $this->refreshPermissions();
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
        return view('admin.users.modal-role');
    }
}
