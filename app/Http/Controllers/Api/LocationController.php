<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function getClosestLocation(Request $request)
    {
        // Validasi parameter latitude dan longitude
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Ambil parameter latitude dan longitude
        $latitude = $validated['latitude'];
        $longitude = $validated['longitude'];

        // Cari desa terdekat berdasarkan koordinat (contoh menggunakan jarak Haversine)
        $closestDesa = Desa::selectRaw("
                nama_desa,
                ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance
            ", [$latitude, $longitude, $latitude])
            ->having('distance', '<', 50) // Radius 50 km (bisa disesuaikan)
            ->orderBy('distance', 'asc')
            ->first();

        if (!$closestDesa) {
            return response()->json(['error' => 'No nearby location found'], 404);
        }

        // Ambil data provinsi, kabupaten, kecamatan
        $provinsi = Provinsi::find($closestDesa->provinsi_id);
        $kabupaten = Kabupaten::find($closestDesa->kabupaten_id);
        $kecamatan = Kecamatan::find($closestDesa->kecamatan_id);

        return response()->json([
            'provinsi' => $provinsi->nama_provinsi,
            'kabupaten' => $kabupaten->nama_kabupaten,
            'kecamatan' => $kecamatan->nama_kecamatan,
            'desa' => $closestDesa->nama_desa,
            'distance' => $closestDesa->distance
        ]);
    }
}
