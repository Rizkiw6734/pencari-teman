<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Update user information
        $user->fill($request->validated());

        // Check if a new profile picture is uploaded
        if ($request->hasFile('foto_profil')) {
            // Validate the uploaded file
            $request->validate([
                'foto_profil' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ]);

            // Delete the old profile picture if it exists
            if ($user->foto_profil && Storage::exists($user->foto_profil)) {
                Storage::delete($user->foto_profil);
            }

            // Store the new profile picture
            $path = $request->file('foto_profil')->store('profile_pictures');

            // Update the foto_profil field in the database
            $user->foto_profil = $path;
        }

        // Reset email verification if the email is updated
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

}
