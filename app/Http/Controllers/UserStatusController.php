<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinalti;
use Illuminate\Support\Facades\Auth;

class UserStatusController extends Controller
{
    /**
     * Menampilkan halaman banned.
     */
    public function bannedPage()
    {
        $user = Auth::user();
        $pinaltis = Pinalti::whereHas('laporan', function ($query) use ($user) {
            $query->where('reported_id', $user->id)->whereIn('jenis_hukuman', ['peringatan','suspend', 'banned']);
        })->get();

        if ($user->status === 'aktif') {
            return redirect()->route('user.home');
        }
        return view('user.banned', compact('pinaltis'));
    }

    /**
     * Menampilkan halaman suspend.
     */
    public function suspendPage()
    {
        $user = Auth::user();
        $pinaltis = Pinalti::whereHas('laporan', function ($query) use ($user) {
            $query->where('reported_id', $user->id)->whereIn('jenis_hukuman', ['suspend', 'banned']);
        })->get();

        if ($user->status === 'aktif') {
            return redirect()->route('user.home');
        }
        return view('user.suspend', compact('pinaltis'));
    }
}
