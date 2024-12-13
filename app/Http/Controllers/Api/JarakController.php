<?php

namespace App\Http\Controllers\API;

use App\Models\Desa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class JarakController extends Controller
{
    public function hitungJarak(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        if (!$latitude || !$longitude) {
            return response()->json(['message' => 'Latitude dan Longitude harus disertakan'], 400);
        }

        $desas = Desa::all();

        // Menghitung jarak dari lokasi yang diberikan ke semua desa
        $desas = $desas->map(function ($desa) use ($latitude, $longitude) {
            $distance = $this->hitungHaversine($latitude, $longitude, $desa->latitude, $desa->longitude);
            $desa->jarak = $distance;
            return $desa;
        });

        // Urutkan desa berdasarkan jarak terdekat
        $desas = $desas->sortBy('jarak');

        return response()->json($desas);
    }

    private function hitungHaversine($lat1, $lon1, $lat2, $lon2)
    {
        $earth_radius = 6371; // Radius bumi dalam kilometer

        // Mengubah derajat ke radian
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        // Menghitung perbedaan lintang dan bujur
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;

        // Rumus Haversine
        $a = sin($dlat / 2) * sin($dlat / 2) +
             cos($lat1) * cos($lat2) *
             sin($dlon / 2) * sin($dlon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Menghitung jarak
        $distance = $earth_radius * $c;

        return $distance; // Jarak dalam kilometer
    }
}
