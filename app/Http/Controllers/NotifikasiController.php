<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\notifikasi;
use App\Models\NotifLaporan;

class NotifikasiController extends Controller
{
    public function Read($id, Request $request)
{
    $notifikasi = notifikasi::where('id', $id)
        ->where('user_id', $request->user_id) // Cek apakah user_id cocok
        ->first();

    if ($notifikasi) {
        $notifikasi->update(['status' => 'read']);
        return response()->json(['message' => 'Notifikasi ditandai sebagai dibaca']);
    }

    // Cek apakah notifikasi ada di tabel NotifLaporan
    $notifLaporan = NotifLaporan::where('id', $id)
        ->where('user_id', $request->user_id)
        ->first();

    if ($notifLaporan) {
        $notifLaporan->update(['is_read' => true]);
        return response()->json(['message' => 'Notifikasi laporan ditandai sebagai dibaca']);
    }

    return response()->json(['error' => 'Notifikasi tidak ditemukan atau tidak memiliki akses'], 403);
}

    public function markAsRead($id)
    {
        $notif = notifikasi::find($id);

        if ($notif && $notif->status === 'unread') {
            $notif->markAsRead();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Notifikasi tidak ditemukan atau sudah dibaca']);
    }

}
