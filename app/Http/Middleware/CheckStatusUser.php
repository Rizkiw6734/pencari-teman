<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckStatusUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

    // Jangan redirect jika sudah berada di halaman banned atau suspend
    if ($request->route()->named('user.banned') && $user->status === 'banned') {
        return $next($request);
    }

    if ($request->route()->named('user.suspend') && $user->status === 'suspend') {
        return $next($request);
    }

    if ($request->route()->named('banding.create') || $request->route()->named('banding.store')) {
        return $next($request);
    }

    // Redirect berdasarkan status pengguna
    if ($user->status === 'banned') {
        return redirect()->route('user.banned')->with('error', 'Akun Anda Terbanned');
    }

    if ($user->status === 'suspend') {
        return redirect()->route('user.suspend')->with('error', 'Akun Anda TerSuspend');
    }

    return $next($request);
    }
}
