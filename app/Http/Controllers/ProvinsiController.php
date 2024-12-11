<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class ProvinsiController extends Controller {

    // Ambil Semua Data Provinsi dengan Relasi Kabupaten, Kecamatan, Desa
    public function index() {
        // Mengambil data lokasi terdekat dari database
        $nearbyLocations = DB::table('lokasi')
            ->select('provinsi', 'kabupaten', 'kecamatan', 'desa', 'distance')
            ->get();

        // Mengirim data ke view
        return view('lokasi.index', compact('nearbyLocations'));
    }


    // Menghitung jarak antar lokasi (menggunakan Haversine Formula)
    private function calculateDistance($lat1, $lon1, $lat2, $lon2) {
        $earthRadius = 6371; // Radius Bumi dalam km

        $deltaLat = deg2rad($lat2 - $lat1);
        $deltaLon = deg2rad($lon2 - $lon1);

        $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($deltaLon / 2) * sin($deltaLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // Jarak dalam km
    }

    // Buat Lokasi Terdekat berdasarkan Koordinat User
    public function findNearby(Request $request) {
        $userLat = $request->input('latitude');
        $userLon = $request->input('longitude');

        $provinsi = Provinsi::with(['kabupaten' => function($query) {
            $query->with(['kecamatan' => function($query) {
                $query->with(['desa']);
            }]);
        }])->get();

        $nearbyLocations = [];

        foreach ($provinsi as $p) {
            foreach ($p->kabupaten as $k) {
                foreach ($k->kecamatan as $kec) {
                    foreach ($kec->desa as $d) {
                        $distance = $this->calculateDistance($userLat, $userLon, $d->latitude, $d->longitude);
                        $nearbyLocations[] = [
                            'provinsi'   => $p->nama,
                            'kabupaten'  => $k->nama,
                            'kecamatan'  => $kec->nama,
                            'desa'       => $d->nama,
                            'distance'   => round($distance, 2) . " km"
                        ];
                    }
                }
            }
        }

        return view('lokasi.index', compact('nearbyLocations'));
    }

    public function store(Request $request) {
        $validated = $request->validate(['nama' => 'required|string|max:255']);

        try {
            Provinsi::create($request->all());
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }

        return redirect()->route('lokasi.index')->with('success', 'Data Provinsi berhasil ditambahkan.');
    }
}
