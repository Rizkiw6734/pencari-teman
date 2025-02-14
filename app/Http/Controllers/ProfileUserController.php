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
use App\Models\User;
use App\Models\Provinces;
use App\Models\Regencies;
use App\Models\Districts;
use App\Models\Villages;
use Illuminate\Validation\Rule;

class ProfileUserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        $provinsi = $user->provinsi_id ?? null;
        $kabupaten = $user->kabupaten_id ?? null;
        $kecamatan = $user->kecamatan_id ?? null;

        // Ambil semua provinsi
        $provinces = Provinces::all();

        // Ambil data berdasarkan relasi
        $regencies = $provinsi ? Regencies::where('province_id', $provinsi)->get() : [];
        $districts = $kabupaten ? Districts::where('regency_id', $kabupaten)->get() : [];
        $villages = $kecamatan ? Villages::where('district_id', $kecamatan)->get() : [];

        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();

        return view('user.profile', compact('user', 'provinces', 'regencies', 'districts', 'villages','followersCount', 'followingCount'));
    }

    public function edit() {
        $user = auth()->user();
        $provinces = Provinces::all();
        $regencies = Regencies::all();
        $districts = Districts::all();
        $villages = Villages::all();

        return view('user.profile', compact('user', 'provinces', 'regencies', 'districts', 'villages'));
    }


    public function update(ProfileUpdateRequest $request)
    {
    $user = auth()->user();


    $validated = $request->validate([
        'name'      => 'required|max:255',
        'last_name' => 'required|string|max:255',
        'gender'    => ['nullable', Rule::in(['L', 'P'])], 
        'umur'      => 'required|integer|min:1|max:80',
        'email'     => [
            'required',
            'email',
            Rule::unique('users', 'email')->ignore($user->id),
        ],
        'hobi'      => 'nullable|string|max:255',
        'bio'       => 'nullable|string|max:1000',
    ], [
        'name.required'      => 'Nama awal harus diisi.',
        'name.max'           => 'Nama awal tidak boleh lebih dari 255 karakter.',
        'last_name.required' => 'Nama belakang harus diisi.',
        'last_name.string'   => 'Nama belakang harus berupa teks.',
        'last_name.max'      => 'Nama belakang tidak boleh lebih dari 255 karakter.',
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

public function updateAddress(Request $request)
    {
        $validated = $request->validate([
            'provinsi_id'  => 'required|exists:reg_provinces,id',
            'kabupaten_id' => 'required|exists:reg_regencies,id',
            'kecamatan_id' => 'required|exists:reg_districts,id',
            'desa_id'      => 'required|exists:reg_villages,id',
        ], [
            'provinsi_id.required'  => 'Provinsi harus dipilih.',
            'provinsi_id.exists'    => 'Provinsi yang dipilih tidak valid.',
            'kabupaten_id.required' => 'Kabupaten harus dipilih.',
            'kabupaten_id.exists'   => 'Kabupaten yang dipilih tidak valid.',
            'kecamatan_id.required' => 'Kecamatan harus dipilih.',
            'kecamatan_id.exists'   => 'Kecamatan yang dipilih tidak valid.',
            'desa_id.required'      => 'Desa harus dipilih.',
            'desa_id.exists'        => 'Desa yang dipilih tidak valid.',
        ]);

        $user = User::findOrFail($request->id);
        $user->update($validated);

        return redirect()->route('profile.index')->with('success', 'Alamat berhasil diperbarui!');
    }

    public function getRegencies(Request $request)
{
    $regencies = Regencies::where('province_id', $request->province_id)->get();
    return response()->json($regencies);
}

public function getDistricts(Request $request)
{
    $districts = Districts::where('regency_id', $request->regency_id)->get();
    return response()->json($districts);
}

public function getVillages(Request $request)
{
    $villages = Villages::where('district_id', $request->district_id)->get();
    return response()->json($villages);
}

public function show($id)
    {
        $user = User::findOrFail($id);  // Mengambil user berdasarkan ID
        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();
        return view('user.profile_orang_lain', compact('user','followersCount', 'followingCount'));  // Tampilkan ke view
    }

}
