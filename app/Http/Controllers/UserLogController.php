<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLog;

class UserLogController extends Controller
{
    public function index()
{
    $logsToday = UserLog::where('user_id', Auth::id())
        ->whereDate('created_at', today())
        ->latest()
        ->limit(50)
        ->get()
        ->map(function ($log) {
            $log->foto_profil = $log->user->foto_profil ?? null; // Ambil foto_profil dari relasi user
            return $log;
        });

    $logsThisMonth = UserLog::where('user_id', Auth::id())
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->whereDate('created_at', '!=', today())
        ->latest()
        ->limit(50)
        ->get()
        ->map(function ($log) {
            $log->foto_profil = $log->user->foto_profil ?? null; // Ambil foto_profil dari relasi user
            return $log;
        });

        return view('user.aktivitas', compact('logsToday', 'logsThisMonth'));
}


}
