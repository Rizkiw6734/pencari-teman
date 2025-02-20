<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Pinalti;
use App\Models\notifikasi;

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

    // Kirim semua data ke view
    return view('dashboard', compact('totalUsers', 'totalReports', 'totalPenalties', 'notifications'));
}

}
