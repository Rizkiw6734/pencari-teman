<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blokir;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLog;

class BlokirController extends Controller
{

    public function daftarBlokir()
{
    $blokirans = Blokir::where('users_id', auth()->id())->with('blockedUser')->get();
    return view('user.kontak_diblokir', compact('blokirans'));
}

public function blokir(User $user)
{
    try {
        $currentUser = auth()->user();

        if (!$currentUser->blokiran()->where('blocked_user_id', $user->id)->exists()) {
            $currentUser->blokiran()->create(['blocked_user_id' => $user->id]);

            // Simpan log aktivitas
            UserLog::create([
                'user_id' => $currentUser->id,
                'aktivitas' => "Anda telah memblokir {$user->name}"
            ]);
        }

        return response()->json(['message' => 'Pengguna berhasil diblokir'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


public function unblock(User $user)
{
    $currentUser = Auth::user();

    // Hapus data blokir
    Blokir::where('users_id', $currentUser->id)
        ->where('blocked_user_id', $user->id)
        ->delete();

    // Simpan log aktivitas
    UserLog::create([
        'user_id' => $currentUser->id,
        'aktivitas' => "Anda telah membuka blokir {$user->name}"
    ]);

    return response()->json(['message' => 'Pengguna telah dibuka blokirnya']);
}


public function bukaBlokir(User $user)
{
    $blokiran = Blokir::where('users_id', auth()->id())
                      ->where('blocked_user_id', $user->id)
                      ->get(); // Ambil semua data yang sesuai

    if ($blokiran->isNotEmpty()) {
        foreach ($blokiran as $item) {
            $item->delete(); // Hapus satu per satu untuk memastikan data yang benar dihapus
        }

        // Simpan log aktivitas
        UserLog::create([
            'user_id' => auth()->id(),
            'aktivitas' => "Anda telah membuka blokir {$user->name}"
        ]);

        return response()->json(['message' => 'Blokir berhasil dibuka'], 200);
    }

    return response()->json(['error' => 'Data tidak ditemukan'], 404);
}



}
