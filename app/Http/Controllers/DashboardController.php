<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Pinalti;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data dari database
        $totalUsers = User::count(); // Contoh: hitung jumlah pengguna
        $totalReports = Laporan::count(); // Contoh: hitung jumlah laporan
        $totalPenalties = Pinalti::count(); // Contoh: hitung jumlah pinalti

        // Kirim data ke view
        return view('dashboard', compact('totalUsers', 'totalReports', 'totalPenalties'));
    }
}
