<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Periksa apakah user tidak ada atau tidak memiliki role yang sesuai
        if (!$request->user() || !$request->user()->hasRole($role)) {
            // Redirect dengan pesan error
            return redirect('/')->with('error', 'You do not have the required permissions to access this page.');
        }

        // Jika lolos, lanjutkan permintaan ke controller
        return $next($request);
    }
}
