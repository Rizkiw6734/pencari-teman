<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Http\Request;
use App\Models\User;

class FollowerController extends Controller
{
    public function follow(User $user)
    {
        if (!auth()->user()->following()->where('user_id', $user->id)->exists()) {
            auth()->user()->following()->create(['user_id' => $user->id]);
        }
        return redirect()->back()->with('success', 'Berhasil mengikuti user.');
    }

    public function unfollow(User $user)
    {
        auth()->user()->following()->where('user_id', $user->id)->delete();
        return redirect()->back()->with('success', 'Berhenti mengikuti user.');
    }

    public function followers(User $user)
    {
        $followers = $user->followers()->with('follower')->get();
        dd($followers);
        // return view('user.profile', compact('followers'));
    }

    public function following(User $user)
    {
        $following = $user->following()->with('user')->get();
        return view('following.list', compact('following'));
    }
}
