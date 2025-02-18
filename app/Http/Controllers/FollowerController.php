<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Http\Request;
use App\Models\User;

class FollowerController extends Controller
{
    public function follow(User $user)
{
    $currentUser = auth()->user();

    if (!$currentUser->following()->where('user_id', $user->id)->exists()) {
        $currentUser->following()->create(['user_id' => $user->id]);
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
        'status' => 'following'
    ]);
}

public function unfollow(User $user)
{
    $currentUser = auth()->user();

    // Hapus data follow
    $currentUser->following()->where('user_id', $user->id)->delete();

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
        return view('following.list', compact('following'));
    }
}
