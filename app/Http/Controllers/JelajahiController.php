<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Regencies;
use Illuminate\Support\Facades\Auth;

class JelajahiController extends Controller
{
    /**
     * Tampilkan halaman jelajahi dengan daftar kabupaten dan pengguna selain admin serta user yang sedang login.
     */
    public function index()
    {
        // Ambil semua kabupaten
        $kabupatens = Regencies::all();

        // Ambil pengguna selain admin dan user yang sedang login
        $penggunaLain = User::where('id', '!=', Auth::id())
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin'); // Cek pengguna yang bukan admin
            })
            ->get();

        return view('user.jelajahi', compact('kabupatens', 'penggunaLain'));
    }

    /**
     * Menampilkan pengguna di sekitar (radius 50 km) berdasarkan latitude dan longitude user yang login.
     */
    public function penggunaTerdekat()
    {
        // Ambil latitude dan longitude user yang sedang login
        $userLogin = Auth::user();
        $latitudeUser = $userLogin->latitude;
        $longitudeUser = $userLogin->longitude;

        if (is_null($latitudeUser) || is_null($longitudeUser)) {
            return response()->json([
                'message' => 'Lokasi pengguna tidak tersedia.'
            ], 400);
        }

        // Ambil data pengguna lain dari database beserta latitude dan longitude
        $penggunaLain = User::where('id', '!=', $userLogin->id)
            ->select('id', 'name', 'latitude', 'longitude')
            ->get();

        // Hitung jarak menggunakan formula Haversine
        foreach ($penggunaLain as $pengguna) {
            $distance = $this->haversineGreatCircleDistance(
                $latitudeUser,
                $longitudeUser,
                $pengguna->latitude,
                $pengguna->longitude
            );
            $pengguna->distance = $distance; // Simpan jarak di properti sementara
        }

        // Urutkan berdasarkan jarak terdekat dan filter dalam radius 50 km
        $penggunaTerdekat = $penggunaLain->filter(function ($pengguna) {
            return $pengguna->distance <= 50;
        })->sortBy('distance')->values();

        return response()->json($penggunaTerdekat);
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

        return $angle * $earthRadius; // Hasil dalam kilometer
    }

    /**
     * Menampilkan pengguna berdasarkan kabupaten_id.
     */
    public function penggunaByKota($kabupaten_id)
    {
        // Query pengguna berdasarkan kabupaten_id
        $users = User::where('kabupaten_id', $kabupaten_id)
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin'); // Cek pengguna yang bukan admin
            })
            ->where('id', '!=', Auth::id())
            ->get();

        // Cek apakah pengguna ditemukan
        if ($users->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada pengguna di kota ini.',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Pengguna ditemukan di kota ini.',
            'data' => $users
        ]);
    }
}
