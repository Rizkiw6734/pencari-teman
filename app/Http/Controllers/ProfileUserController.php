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
    return Redirect::route('user.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updateFotoProfile(Request $request)
    {
    // Validasi input untuk foto_profile
    $request->validate([
        'foto_profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Ambil data user yang sedang login
    $user = auth()->user();

    // Hapus file foto_profile lama jika ada
    if ($user->foto_profile) {
        Storage::delete($user->foto_profile);
    }

    // Simpan file foto_profile baru
    $fotoProfilePath = $request->file('foto_profile')->store('foto_profiles');

    // Update foto_profile di database
    $user->update(['foto_profile' => $fotoProfilePath]);

    // Redirect ke halaman profil dengan pesan sukses
    return Redirect::route('user.profile')->with('success', 'Foto profil berhasil diperbarui.');
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
