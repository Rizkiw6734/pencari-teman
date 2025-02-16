<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ActiveUserController extends Controller
{
    // Ambil daftar user yang online
    public function index()
{
    $authUser = Auth::user();

    // Ambil user yang online, kecuali user yang sedang login dan yang memiliki role 'Admin'
    $users = User::where('is_online', true) // Hanya user yang online
        ->where('id', '!=', Auth::id()) // Kecualikan user yang sedang login
        ->get(['id', 'name', 'foto_profil'])
        ->filter(function($user) use ($authUser) {
            return !$user->hasRole('Admin') &&
                   $authUser->isFollowing($user) &&
                   $user->isFollowing($authUser); // Pastikan kedua pengguna saling mengikuti
        });

    return response()->json($users);
}

public function updateActivity(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->update([
                'is_online' => true,
                'last_activity' => now()
            ]);
        }

        return response()->json(['status' => 'success']);
    }
}
