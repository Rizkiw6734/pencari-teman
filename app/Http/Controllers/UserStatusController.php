<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStatusController extends Controller
{
    /**
     * Menampilkan halaman banned.
     */
    public function bannedPage()
    {
        $user = Auth::user();

        if ($user->status === 'aktif') {
            return redirect()->route('user.home');
        }
        return view('user.banned');
    }

    /**
     * Menampilkan halaman suspend.
     */
    public function suspendPage()
    {
        $user = Auth::user();

        if ($user->status === 'aktif') {
            return redirect()->route('user.home');
        }
        return view('user.suspend');
    }
}
