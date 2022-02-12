<?php

namespace App\Http\Middleware;

use App\Models\Sambat;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditSambat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $sambat = Sambat::find($request->route('sambat_id'));

        if (Auth::check() and Auth::user()->id === $sambat->user->id) {
            return $next($request);
        }

        return redirect('sambat');
    }
}
