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
    ->whereNotNull('latitude')
    ->whereNotNull('longitude')
    ->whereDoesntHave('roles', function ($query) {
        $query->where('name', 'admin');
    });

if ($request->filled('search') && $request->input('context') === 'umum') {
    $search = $request->input('search');
    $query->where('name', 'like', "%{$search}%");
}

$penggunaLain = $query->get();

    // Cek apakah request berasal dari AJAX
    // if ($request->ajax()) {
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Pengguna ditemukan.',
    //         'users' => $penggunaLain
    //     ]);
    // }

    // return view('user.jelajahi', compact('penggunaLain'));
}

    /**
     * Menampilkan pengguna di sekitar (radius 50 km) berdasarkan latitude dan longitude user yang login.
     */
    public function penggunaTerdekat(Request $request)
{
    $userLogin = Auth::user();
    $latitudeUser = $userLogin->latitude;
    $longitudeUser = $userLogin->longitude;

    if (is_null($latitudeUser) || is_null($longitudeUser)) {
        return response()->json(['message' => 'Lokasi pengguna tidak tersedia.'], 400);
    }

    $query = User::where('id', '!=', $userLogin->id)
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->whereDoesntHave('followers', function ($query) use ($userLogin) {
            $query->where('follower_id', $userLogin->id);
        })
        ->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        });

    // Filter berdasarkan search
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    // Ambil pengguna lain dan hitung jaraknya
    $penggunaLain = $query->get()->map(function ($pengguna) use ($latitudeUser, $longitudeUser) {
        $pengguna->distance = round($this->haversineGreatCircleDistance(
            $latitudeUser,
            $longitudeUser,
            $pengguna->latitude,
            $pengguna->longitude
        ), 2);
        return $pengguna;
    });

    // Filter hanya yang dalam radius 5 km
    $penggunaLain = $penggunaLain->filter(function ($pengguna) {
        return $pengguna->distance <= 5;
    })->sortBy('distance')->values();

    if ($request->ajax()) {
        return view('user.partials.pengguna-list', compact('penggunaLain'))->render();
    }

    return view('user.jelajahi', compact('penggunaLain'));
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

    public function getProvinsi()
    {
        try {
            $provinsi = Provinces::all();

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

    public function penggunaByKota(Request $request, $kabupaten_id)
{
    \Log::info('Kabupaten ID diterima: ' . ($kabupaten_id ?? 'null'));

    if (empty($kabupaten_id)) {
        return response()->json([
            'status' => 'error',
            'message' => 'ID kabupaten tidak valid.',
            'data' => []
        ], 400);
    }

    $query = User::where('kabupaten_id', $kabupaten_id)
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->where('id', '!=', Auth::id())
        ->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        });

    if ($request->filled('search') && $request->input('context') === 'kota') {
        $search = $request->input('search');
        $query->where('name', 'like', "%{$search}%");
    }

    $pengguna = $query->get();

    \Log::info('Jumlah pengguna ditemukan: ' . $pengguna->count());

    if ($pengguna->isEmpty()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Tidak ada pengguna di kabupaten ini dengan lokasi yang valid.',
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
