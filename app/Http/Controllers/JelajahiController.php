<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Regencies;
use App\Models\Provinces;
use Illuminate\Support\Facades\Auth;

class JelajahiController extends Controller
{
    /**
     * Tampilkan halaman jelajahi dengan daftar kabupaten dan pengguna selain admin serta user yang sedang login.
     */
    public function index(Request $request)
    {
        $query = User::where('id', '!=', Auth::id())
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            });

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $penggunaLain = $query->get();

        // Cek apakah request berasal dari AJAX
        if ($request->ajax()) {
            return response()->json(['users' => $penggunaLain]);
        }

        return view('user.jelajahi', compact('penggunaLain'));
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
        ->get();

    // Hitung jarak menggunakan formula Haversine
    foreach ($penggunaLain as $pengguna) {
        if (!is_null($pengguna->latitude) && !is_null($pengguna->longitude)) {
            $distance = $this->haversineGreatCircleDistance(
                $latitudeUser,
                $longitudeUser,
                $pengguna->latitude,
                $pengguna->longitude
            );
            $pengguna->distance = round($distance, 2); // Simpan jarak dengan 2 desimal
        } else {
            $pengguna->distance = null; // Jika tidak ada lokasi, beri nilai null
        }
    }

    // Urutkan berdasarkan jarak terdekat dan filter dalam radius 50 km (termasuk jarak 0 km)
    $penggunaTerdekat = $penggunaLain->filter(function ($pengguna) {
        return $pengguna->distance !== null && $pengguna->distance <= 50;
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


    public function getProvinsi()
    {
        try {
            $provinsi = Provinces::all();  // Ambil semua data provinsi

            if ($provinsi->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tidak ada provinsi yang ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $provinsi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getKotaByProvinsi($provinsi_id)
    {
        try {
            $kotas = Regencies::where('province_id', $provinsi_id)->get(['id', 'name']);

            if ($kotas->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tidak ada kota di provinsi ini.',
                    'data' => []
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Daftar kota ditemukan.',
                'data' => $kotas
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function penggunaByKota($kabupaten_id)
{
    // Debug log untuk memastikan parameter diterima
    \Log::info('Kabupaten ID diterima: ' . ($kabupaten_id ?? 'null'));

    if (empty($kabupaten_id)) {
        return response()->json([
            'status' => 'error',
            'message' => 'ID kabupaten tidak valid.',
            'data' => []
        ], 400);
    }

    // Query pengguna berdasarkan kabupaten_id, kecuali user login dan admin
    $pengguna = User::with('kabupatens')
        ->where('kabupaten_id', $kabupaten_id)
        ->where('id', '!=', Auth::id())
        ->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })
        ->get();

    // Log jumlah pengguna yang ditemukan
    \Log::info('Jumlah pengguna ditemukan: ' . $pengguna->count());

    if ($pengguna->isEmpty()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Tidak ada pengguna di kabupaten ini.',
            'data' => []
        ], 200);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Pengguna ditemukan.',
        'data' => $pengguna
    ], 200);
}



}
