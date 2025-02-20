<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\notifikasi;

class NotifikasiController extends Controller
{
    public function markAsRead($id)
    {
        $notif = Notifikasi::find($id);

        if ($notif && $notif->status === 'unread') {
            $notif->markAsRead();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Notifikasi tidak ditemukan atau sudah dibaca']);
    }
}
