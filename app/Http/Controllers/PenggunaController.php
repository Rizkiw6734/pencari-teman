<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('status','!=','banned')
        ->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
        return view('Admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function block($id)
    {
        $user = User::findOrFail($id);
        if($user->hasRole('admin')){
            redirect()->route('Pengguna.index')->with('error', 'pengguna adalah Admin');
        }

        $user->status = 'banned';
        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diblokir');
    }

    public function banned()
    {
        $bannedUsers = User::where('status', 'banned')->get();
        return view('admin.users.banned', compact('bannedUsers'));
    }

    public function unblock($id)
    {
        $user = User::findOrFail($id);

        if($user->status !== 'banned') {
            return redirect()->route('admin.users.banned')->with('error', 'Pengguna tidak dalam status banned');
        }

        $user->status = 'aktif';
        $user->save();

        return redirect()->route('admin.users.banned')->with('success', 'Pengguna berhasil dibuka banned-nya');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if($user->hasRole('admin')){
            redirect()->route('Pengguna.index')->with('error', 'Pengguna adalah Admin');
        }
        $user->delete();
        redirect()->route('Pengguna.index')->with('success', 'Pengguna ini berhasil di hapus');
    }
}
