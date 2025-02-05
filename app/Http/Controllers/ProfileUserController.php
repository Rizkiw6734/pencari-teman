<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Pest\Arch\Objects\FunctionDescription;
use App\Model\User;

class ProfileUserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();

        return view('user.profile', compact('user'));
    }

    public function edit() {
        $user = auth()->user();

        return view('user.profile', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
    $user = auth()->user();


    $validated = $request->validate([
        'name'      => 'requiredp|max:255',
        'last_name' => 'required|string|max:255',
        'gender'    => 'required|in:male,female,other',
        'umur'      => 'required|integer|min:1|max:80',
        'email'     => 'required|email|unique:users,email',
        'hobi'      => 'nullable|string|max:255', 
        'bio'       => 'nullable|string|max:1000',
    ], [
        'name.required'      => 'Nama awal harus diisi.',
        'name.max'           => 'Nama awal tidak boleh lebih dari 255 karakter.',
        'last_name.required' => 'Nama belakang harus diisi.',
        'last_name.string'   => 'Nama belakang harus berupa teks.',
        'last_name.max'      => 'Nama belakang tidak boleh lebih dari 255 karakter.',
        'gender.required'    => 'Jenis kelamin harus dipilih.',
        'gender.in'          => 'Jenis kelamin harus salah satu dari: male, female, atau other.',
        'umur.required'      => 'Umur harus diisi.',
        'umur.integer'       => 'Umur harus berupa angka.',
        'umur.min'           => 'Umur minimal 1 tahun.',
        'umur.max'           => 'Umur maksimal 80 tahun.',
        'email.required'     => 'Email harus diisi.',
        'email.email'        => 'Email tidak valid.',
        'email.unique'       => 'Email sudah terdaftar.',
        'hobi.string'        => 'Hobi harus berupa teks.',
        'hobi.max'           => 'Hobi tidak boleh lebih dari 255 karakter.',
        'bio.string'         => 'Bio harus berupa teks.',
        'bio.max'            => 'Bio tidak boleh lebih dari 1000 karakter.',
    ]);
    $user->update($validated);

    return Redirect::route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePhoto(Request $request)
{
    $request->validate([
        'foto_profil' => 'required|image|mimes:jpg,jpeg,png,gif|max:5048',
    ]);

    if ($request->user()->foto_profil) {
        Storage::disk('public')->delete($request->user()->foto_profil);
    }

    $path = $request->file('foto_profil')->store('profile_pictures', 'public');

    $request->user()->update([
        'foto_profil' => 'profile_pictures/' . basename($path),
    ]);

    return redirect()->route('profile.index')->with('success', 'Foto profil berhasil diupdate!');
}


    public function updateLocation(Request $request)
{
    $validated = $request->validate([
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    $user = auth()->user();

    $user->latitude = $validated['latitude'];
    $user->longitude = $validated['longitude'];

    $user->save();

    return response()->json(['message' => 'Lokasi berhasil diperbarui!'], 200);
}
}
