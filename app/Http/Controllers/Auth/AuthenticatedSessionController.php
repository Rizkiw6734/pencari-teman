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
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Proses autentikasi menggunakan email dan password
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->with('error', 'Login gagal, email atau password salah.');
        }

        // Regenerasi session setelah berhasil login
        $request->session()->regenerate();

        $user = Auth::user();

        // Update status user menjadi online
        $user->update(['is_online' => true]);

        // Membuat token API jika login berhasil
        $token = $user->createToken('PencariTeman')->plainTextToken;

        // Cek peran user (Admin atau User)
        if ($user->hasRole('Admin')) {
            return redirect()->route('dashboard')
                ->with('success', 'Selamat datang Admin ' . $user->name . '!')
                ->with('user', $user)
                ->with('token', $token);
        } elseif ($user->hasRole('User')) {
            return redirect()->route('user.home')
                ->with('success', 'Selamat datang ' . $user->name . '!')
                ->with('user', $user)
                ->with('token', $token);
        }

        return back()->with('error', 'Role tidak ditemukan.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();

        if ($user) {
            // Set user offline saat logout
            $user->update(['is_online' => false]);
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
