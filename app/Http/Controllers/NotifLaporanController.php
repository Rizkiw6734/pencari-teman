<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\notifikasi; // Pastikan model Notifikasi sudah dibuat
use Illuminate\Support\Facades\Auth;

class NotifLaporanController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // ID pengguna yang sedang login

        // Ambil notifikasi untuk user yang sedang login
        $notifications = notifikasi::with('laporan.pelapor2')->where('user_id', $userId)->latest()->get();

        return view('user.notifikasi', compact('notifications'));
    }


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
