<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Pinalti;
use App\Models\notifikasi;
use App\Models\Rating;

class DashboardController extends Controller
{
    public function index()
{
    // Ambil data utama
    $totalUsers = User::count();
    $totalReports = Laporan::count();
    $totalPenalties = Pinalti::count();

    // Ambil notifikasi terbaru yang belum dibaca oleh user yang login
    $notifications = notifikasi::where('user_id', auth()->id())
        ->where('status', 'unread')
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

        $totalReviews = Rating::count();
        $positive = Rating::where('status', 'positif')->count();
        $neutral = Rating::where('status', 'netral')->count();
        $negative = Rating::where('status', 'negatif')->count();

        $positivePercentage = $totalReviews ? round(($positive / $totalReviews) * 100, 2) : 0;
        $neutralPercentage = $totalReviews ? round(($neutral / $totalReviews) * 100, 2) : 0;
        $negativePercentage = $totalReviews ? round(($negative / $totalReviews) * 100, 2) : 0;

    // Kirim semua data ke view
    return view('dashboard', compact('totalUsers', 'totalReports', 'totalPenalties', 'notifications','positivePercentage', 'neutralPercentage', 'negativePercentage','positive', 'neutral','negative'));
}

public function getUserStatistics()
{
    $maleData = [];
    $femaleData = [];

    for ($month = 1; $month <= 12; $month++) {
        $maleData[] = User::where('gender', 'L') // Menggunakan 'L' untuk laki-laki
            ->whereMonth('created_at', $month)
            ->count();

        $femaleData[] = User::where('gender', 'P') // Menggunakan 'P' untuk perempuan
            ->whereMonth('created_at', $month)
            ->count();
    }

    return response()->json([
        'male' => $maleData,
        'female' => $femaleData,
    ]);
}

}
