<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;

trait GuardsAgainstAccess
{
    public function initializeGuardsAgainstAccess()
    {
        if (isset($this->role)) abort_unless(Auth::user()->hasRole($this->role), 401, 'Unauthorized');

        if (isset($this->permission)) abort_unless(Auth::user()->can($this->permission), 401, 'Unauthorized');
    }
}
