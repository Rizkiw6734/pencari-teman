<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blokir;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        }
        return response()->json(['message' => 'Pengguna berhasil diblokir'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function unblock(User $user)
    {
        $currentUser = Auth::user();
        Blokir::where('users_id', $currentUser->id)
            ->where('blocked_user_id', $user->id)
            ->delete();

        return response()->json(['message' => 'Pengguna telah dibuka blokirnya']);
    }

    public function bukaBlokir(User $user)
{
    $blokiran = Blokir::where('users_id', auth()->id())->where('blocked_user_id', $user->id)->first();

    if ($blokiran) {
        $blokiran->delete();
        return response()->json(['message' => 'Blokir berhasil dibuka'], 200);
    }

    return response()->json(['error' => 'Data tidak ditemukan'], 404);
}


}
