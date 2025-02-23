<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLog;


class FollowerController extends Controller
{
    public function follow(User $user)
    {
        $currentUser = auth()->user();

        if (!$currentUser->following()->where('user_id', $user->id)->exists()) {
            $currentUser->following()->create(['user_id' => $user->id]);

            // Simpan log aktivitas
            UserLog::create([
                'user_id' => $currentUser->id,
                'aktivitas' => "Anda telah mengikuti {$user->name}"
            ]);
        }

        // Cek apakah user yang di-follow juga mengikuti balik
        if ($user->following()->where('user_id', $currentUser->id)->exists()) {
            return response()->json([
                'message' => 'Sekarang kalian berteman.',
                'status' => 'friend'
            ]);
        }

        return response()->json([
            'message' => 'Berhasil mengikuti user.',
            'status' => 'following',
            'data' => [
                'name' => $user->name // Tambahkan username user yang di-follow
            ]
        ]);
    }

    public function unfollow(User $user)
    {
        $currentUser = auth()->user();

        // Hapus data follow
        $currentUser->following()->where('user_id', $user->id)->delete();

        // Simpan log aktivitas
        UserLog::create([
            'user_id' => $currentUser->id,
            'aktivitas' => "Anda telah berhenti mengikuti {$user->name}"
        ]);

        return response()->json([
            'message' => 'Berhenti mengikuti user.',
            'status' => 'unfollowed'
        ]);
    }




    public function followers(User $user)
    {
        $followers = $user->followers()->with('follower')->get();

        return view('user.profile', compact('followers'));
    }

    public function following(User $user)
    {
        $following = $user->following()->with('user')->get();
        return view('user.profile', compact('following'));
    }

    public function hapusPengikut(Request $request)
    {
        $followerId = $request->input('follower_id');
        $user = auth()->user();

        // Pastikan hanya pengikut milik user yang bisa dihapus
        $deleted = DB::table('followers')
            ->where('user_id', $user->id)
            ->where('id', $followerId) // Hapus berdasarkan ID follower
            ->delete();

        return response()->json(['success' => $deleted ? true : false]);
    }

}
