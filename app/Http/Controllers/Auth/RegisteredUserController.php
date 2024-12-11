<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.unique' => 'Nama telah digunakan oleh admin lain, silakan gunakan nama yang berbeda.',
            'name.string' => 'Nama harus berupa string.',
            'name.min' => 'Nama harus memiliki minimal setidaknya 5 karakter.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'name.regex' => 'Nama hanya boleh terdiri dari huruf.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus valid.',
            'email.unique' => 'Email telah digunakan, silakan gunakan email yang berbeda.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Password konfirmasi tidak sesuai.'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('User');

        Auth::login($user);

        return redirect()->route('home')->with('success','Registrasi berhasil, selamat datang!');
    }
}
