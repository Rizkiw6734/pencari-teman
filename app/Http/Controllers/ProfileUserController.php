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
        // Ambil data user yang sedang login
        $user = auth()->user();

        // Tampilkan view profile dengan data user
        return view('user.profile', compact('user'));
    }

    public function edit() {
        $user = auth()->user();

        return view('user.profile', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
    // Ambil data user yang sedang login
    $user = auth()->user();

    // Validasi input
    $validated = $request->only([
        'name',
        'last_name',
        'gender',
        'umur',
        'email',
        'hobi',
        'bio'
    ]);
    // Update data user
    $user->update($validated);

    // Redirect ke halaman profil dengan pesan sukses
    return Redirect::route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePhoto(Request $request)
{
    // Validasi file
    $request->validate([
        'foto_profil' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    // Cek apakah user sudah memiliki foto profil sebelumnya
    if ($request->user()->foto_profil) {
        // Hapus foto lama
        Storage::disk('public')->delete($request->user()->foto_profil);
    }

    // Simpan file baru
    $path = $request->file('foto_profil')->store('profile_pictures', 'public');

    // Update foto profil di database
    $request->user()->update([
        'foto_profil' => 'profile_pictures/' . basename($path),
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('profile.index')->with('success', 'Foto profil berhasil diupdate!');
}


    public function updateLocation(Request $request)
{
    // Validasi data yang diterima (latitude dan longitude)
    $validated = $request->validate([
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    // Ambil user yang sedang login
    $user = auth()->user();

    // Perbarui lokasi pengguna
    $user->latitude = $validated['latitude'];
    $user->longitude = $validated['longitude'];

    // Simpan perubahan ke database
    $user->save();

    return response()->json(['message' => 'Lokasi berhasil diperbarui!'], 200);
}
}
