<?php

use App\Models\User;

if (!function_exists('getRoleUser')) {
    /**
     * to get role of user
     *
     * @param  string $permission
     * @return bool
     */
    function getRoleUser(User $user)
    {
        if ($user->hasRole(ROLE_ADMIN)) return ROLE_ADMIN;
        if ($user->hasRole(ROLE_BPH)) return ROLE_BPH;
        if ($user->hasRole(ROLE_HUMAS)) return ROLE_HUMAS;
        if ($user->hasRole(ROLE_AKADEMIK)) return ROLE_AKADEMIK;
    }
}
