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
         // Ambil semua user yang online, kecuali user yang sedang login dan yang memiliki role 'Admin'
         $users = User::where('is_online', true)
         ->where('id', '!=', Auth::id())  // Mengecualikan user yang sedang login
         ->get(['id', 'name', 'foto_profil'])
         ->filter(function($user) {
             return !$user->hasRole('Admin'); // Mengecualikan user dengan role 'Admin'
         });

        return response()->json($users);
    }

}
