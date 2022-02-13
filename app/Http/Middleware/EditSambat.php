<?php

namespace App\Http\Middleware;

use App\Models\Sambat;
use Closure;
use Illuminate\Http\Request;

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

        if (auth()->check() and $sambat and auth()->id() == $sambat->user_id) {
            return $next($request);
        }

        return abort(404);
    }
}
