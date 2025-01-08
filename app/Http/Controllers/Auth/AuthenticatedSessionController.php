<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string'
    ], [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Password wajib diisi.'
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return back()->with('error', 'Login gagal, email atau password salah.');
    }

    $request->session()->regenerate();

    $user = Auth::user();

    if ($user->hasRole('Admin')) {
        return redirect()->route('dashboard')
            ->with('success', 'Selamat datang Admin ' . $user->name . '!');
    } elseif ($user->hasRole('User')) {
        return redirect()->route('user.home')
            ->with('success', 'Selamat datang ' . $user->name . '!');
    }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
