<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;

class ActiveUserController extends Controller
{
    // Ambil daftar user yang online
    public function index(Request $request)
{
    $authUser = Auth::user();

    // Ambil user yang online, kecuali user yang sedang login dan yang memiliki role 'Admin'
    $users = User::where('is_online', true) // Hanya user yang online
        ->where('id', '!=', $authUser->id) // Kecualikan user yang sedang login
        ->whereDoesntHave('blokiran', function ($query) use ($authUser) {
            $query->where('blocked_user_id', $authUser->id); // Pastikan pengguna login tidak diblokir
        })
        ->whereDoesntHave('diblokir', function ($query) use ($authUser) {
            $query->where('users_id', $authUser->id); // Pastikan pengguna login tidak memblokir pengguna lain
        })
        ->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'Admin'); // Kecualikan pengguna dengan role Admin
        })
        ->get()
        ->filter(function ($user) use ($authUser) {
            return $authUser->isFollowing($user) &&
                   $user->isFollowing($authUser); // Pastikan kedua pengguna saling mengikuti
        });

    foreach ($users as $user) {
        $chat = Chat::where('penerima_id', $authUser->id)
                    ->where('pengirim_id', $user->id)
                    ->where('status', 'received')
                    ->first();

        if ($chat) {
            $isChatOpened = $request->input('is_seen') ?? false;
            if ($isChatOpened) {
                DB::table('chat')->where('id', $chat->id)->update([
                    'status' => 'sent_and_read',
                    'is_seen' => true
                ]);
                $chat->status = 'sent_and_read';
                $chat->is_seen = true;
            }
        }
    }

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
