<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\notifikasi;

class NotifikasiController extends Controller
{
    public function markAsRead($id, Request $request)
    {
        $notifikasi = notifikasi::where('id', $id)
            ->where('user_id', $request->user_id) // Cek apakah user_id cocok
            ->first();

        if ($notifikasi) {
            $notifikasi->update(['status' => 'read']);
            return response()->json(['message' => 'Notifikasi ditandai sebagai dibaca']);
        }

        return response()->json(['error' => 'Notifikasi tidak ditemukan atau tidak memiliki akses'], 403);
    }

}
