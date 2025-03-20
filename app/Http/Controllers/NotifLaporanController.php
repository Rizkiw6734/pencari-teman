<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\notifikasi;
use App\Models\NotifLaporan;
use App\Models\Pinalti;
use Illuminate\Support\Facades\Auth;

class NotifLaporanController extends Controller
{
    public function index()
{
    $userId = Auth::id(); // ID pengguna yang sedang login

    // Ambil notifikasi dari tabel 'notifikasi' dengan relasi 'laporan.pelapor2' dan 'user'
    $notifications = notifikasi::with(['laporan.pelapor2', 'user'])
        ->where('user_id', $userId)
        ->latest()
        ->get();

    // Ambil notifikasi dari tabel 'notif_laporans' dengan relasi 'user'
    $notifLaporans = NotifLaporan::with('user')
        ->where('user_id', $userId)
        ->latest()
        ->get();

    // Gabungkan kedua koleksi notifikasi
    $allNotifications = $notifications->merge($notifLaporans);

    // Pisahkan notifikasi berdasarkan hari ini dan bulan ini
    $todayNotifications = $allNotifications->filter(fn ($notification) => $notification->created_at->isToday());
    $thisMonthNotifications = $allNotifications->filter(fn ($notification) => $notification->created_at->isCurrentMonth() && !$notification->created_at->isToday());

    $pinaltis = Pinalti::whereHas('laporan', function ($query) use ($userId) {
        $query->where('reported_id', $userId)->whereIn('jenis_hukuman', ['peringatan', 'suspend', 'banned']);
    })->get();

    // return response()->json([
    //     'todayNotifications' => $todayNotifications->values(),
    //     'thisMonthNotifications' => $thisMonthNotifications->values(),
    // ]);

    return view('user.notifikasi', compact('todayNotifications', 'thisMonthNotifications', 'pinaltis'));
}

 // return response()->json([
    //     'todayNotifications' => $todayNotifications->values(),
    //     'thisMonthNotifications' => $thisMonthNotifications->values(),
    // ]);



    // public function show($id)
    // {
    //     // Ambil detail notifikasi berdasarkan ID
    //     $notification = Notifikasi::findOrFail($id);

    //     // Cek apakah user yang sedang login adalah pelapor atau terlapor
    //     $isPelapor = $notification->user_id === auth()->id();
    //     $isTerlapor = $notification->laporan->terlapor_id === auth()->id();

    //     return view('user.notifikasi', compact('notification', 'isPelapor', 'isTerlapor'));
    // }
}
