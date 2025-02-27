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
            })
            ->with('kabupatens'); // Pastikan relasi dimuat

        if ($request->filled('search') && $request->input('context') === 'umum') {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $penggunaLain = $query->get();

        return view('jelajahi.kota', compact('penggunaLain'));

        // return response()->json($penggunaLain); // Untuk debugging
    }


    /**
     * Menampilkan pengguna di sekitar (radius 50 km) berdasarkan latitude dan longitude user yang login.
     */
    public function penggunaSekitar(Request $request)
{
    $userLogin = Auth::user();
    $latitudeUser = $userLogin->latitude;
    $longitudeUser = $userLogin->longitude;

    // Jika pengguna tidak memiliki lokasi, hentikan proses
    if (is_null($latitudeUser) || is_null($longitudeUser)) {
        return response()->json(['message' => 'Lokasi pengguna tidak tersedia.'], 400);
    }

    // Ambil daftar user yang diblokir dan yang memblokir user login
    $userBlokiran = $userLogin->blokiran->pluck('blocked_user_id')->toArray();
    $userMemblokir = $userLogin->diblokir->pluck('users_id')->toArray();
    $blokirList = array_merge($userBlokiran, $userMemblokir);

    // Query untuk mencari pengguna sekitar dengan pengecualian user yang diblokir
    $query = User::where('id', '!=', $userLogin->id)
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->whereNotIn('id', $blokirList) // Filter pengguna yang diblokir atau memblokir
        ->whereDoesntHave('followers', function ($query) use ($userLogin) {
            $query->where('follower_id', $userLogin->id);
        })
        ->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        });

    // Filter berdasarkan pencarian (search)
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    // Ambil pengguna lain & hitung jaraknya
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

    return view('jelajahi.sekitar', compact('penggunaLain'));
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

    $userId = Auth::id();

    $query = User::where('kabupaten_id', $kabupaten_id)
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->where('id', '!=', $userId)
        ->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })
        ->whereDoesntHave('followers', function ($query) use ($userId) {
            $query->where('follower_id', $userId);
        })
        ->whereDoesntHave('diblokir', function ($query) use ($userId) {
            $query->where('users_id', $userId); // Mengecualikan user yang telah diblokir oleh user yang sedang login
        })
        ->whereDoesntHave('blokiran', function ($query) use ($userId) {
            $query->where('blocked_user_id', $userId); // Mengecualikan user yang memblokir user yang sedang login
        })
        ->with('kabupatens');

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


public function cariPengguna(Request $request)
{
    $query = $request->query('q');
    $userId = Auth::id(); // Ambil ID user yang sedang login

    // Ambil user yang memiliki relasi dengan kabupaten dan tidak termasuk dalam daftar blokiran
    $users = User::whereHas('kabupatens', function ($q) {
            $q->whereNotNull('id'); // Pastikan ada data kabupaten
        })
        ->whereDoesntHave('diblokir', function ($q) use ($userId) {
            $q->where('users_id', $userId); // Mengecualikan user yang telah diblokir oleh user yang sedang login
        })
        ->whereDoesntHave('blokiran', function ($q) use ($userId) {
            $q->where('blocked_user_id', $userId); // Mengecualikan user yang memblokir user yang sedang login
        })
        ->when($query, function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%");
        })
        ->with('kabupatens') // Panggil relasi kabupaten
        ->get();

    return response()->json([
        'status' => 'success',
        'data' => $users
    ]);
}



}
