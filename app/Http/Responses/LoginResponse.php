<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as ContractsLoginResponse;

class LoginResponse implements ContractsLoginResponse
{
    public function toResponse($request)
    {
        // if (auth()->user()->hasRole('admin')) return redirect()->to('admin');
        return redirect()->intended('/');
    }
}
