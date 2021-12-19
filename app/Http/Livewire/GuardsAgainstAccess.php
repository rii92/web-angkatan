<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;

trait GuardsAgainstAccess
{
    /**
     * protect class, so it can only be accessed by certain role or permission
     *
     * @return void
     */
    public function initializeGuardsAgainstAccess()
    {
        if (isset($this->roleGuard)) abort_unless(Auth::user()->hasRole($this->roleGuard), 401, 'Unauthorized');

        if (isset($this->permissionGuard)) abort_unless(Auth::user()->can($this->permissionGuard), 401, 'Unauthorized');
    }
}
