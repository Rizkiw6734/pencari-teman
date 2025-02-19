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
        $followers = $user->followers()->with('follower')->get()->map(function ($follow) {
            return [
                'id' => $follow->id,
                'follower_id' => $follow->follower_id,
                'name' => $follow->follower->name ?? null,
                'email' => $follow->follower->email ?? null,
                'foto_profil' => $follow->follower->foto_profil
            ? asset('storage/' . $follow->follower->foto_profil)
            : asset('images/marie.jpg'),
               'created_at' => $follow->created_at,
            ];
        });

        $following = $user->following()->with('user')->get()->map(function ($follow) {
            return [
                'id' => $follow->id,
                'following_id' => $follow->following_id,
                'name' => $follow->user->name ?? null,
                'email' => $follow->user->email ?? null,
                'photo_profile' => $follow->user->foto_profil
                    ? asset('storage/' . $follow->user->foto_profil)
                    : asset('images/marie.jpg'),
                'created_at' => $follow->created_at,
            ];
        });



        return view('user.profile', compact('user', 'provinces', 'regencies', 'districts', 'villages','followersCount', 'followingCount','followers','following'));
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
        $provinceId = $request->input('province_id');

        if (!$provinceId) {
            return response()->json(['error' => 'Province ID is required'], 400);
        }

        $regencies = Regencies::where('province_id', $provinceId)->get();
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

    public function show($id, Request $request)
    {
        $user = User::findOrFail($id);
        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();

        $userLogin = auth()->user();
        $latitudeUser = $userLogin->latitude;
        $longitudeUser = $userLogin->longitude;

        $query = User::where('id', '!=', $user->id)
            ->where('id', '!=', $userLogin->id)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereDoesntHave('followers', function ($query) use ($userLogin) {
                $query->where('follower_id', $userLogin->id);
            })
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            });

        $penggunaLain = $query->get()->map(function ($pengguna) use ($latitudeUser, $longitudeUser) {
            $pengguna->distance = round($this->haversineGreatCircleDistance(
                $latitudeUser,
                $longitudeUser,
                $pengguna->latitude,
                $pengguna->longitude
            ), 2);
            return $pengguna;
        });

        $penggunaLain = $penggunaLain->filter(function ($pengguna) {
            return $pengguna->distance <= 25;
        })->sortBy('distance')->values();

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data pengguna ditemukan',
                'users' => $penggunaLain
            ]);
        }

        return view('user.profile_orang_lain', compact('user', 'followersCount', 'followingCount', 'penggunaLain'));
    }

    private function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371)
    {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $angle * $earthRadius;
    }
}
