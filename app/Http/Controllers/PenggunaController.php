<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil data filter dari request
        $kabupaten = $request->input('kabupaten');
        $kecamatan = $request->input('kecamatan');
        $desa = $request->input('desa');
        $perPage = $request->input('per_page', 2); 
    
        // Query dasar
        $query = User::where('status', '!=', 'banned')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            });
    
        // Filter berdasarkan lokasi
        if ($kabupaten) {
            $query->where('kabupaten', $kabupaten);
        }
        if ($kecamatan) {
            $query->where('kecamatan', $kecamatan);
        }
        if ($desa) {
            $query->where('desa', $desa);
        }
    
        // Paginate hasilnya dengan jumlah data per halaman yang dipilih
        $users = $query->paginate($perPage);
    
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if($user->hasRole('admin')){
            redirect()->route('Pengguna.index')->with('error', 'pengguna adalah Admin');
        } 
        $user->delete();
        redirect()->route('Pengguna.index')->with('success', 'Pengguna ini berhasil di hapus');
    }
}
