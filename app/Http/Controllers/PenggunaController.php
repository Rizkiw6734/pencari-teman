<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\Provinces;
use App\Models\Regencies;
use App\Models\Districts;
use App\Models\Villages;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $provinsi = $request->input('provinces');
        $kabupaten = $request->input('regencies');
        $kecamatan = $request->input('districts');
        $desa = $request->input('villages');
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $query = User::whereNotIn('status', ['banned', 'suspend'])
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            });

        if ($provinsi) {
            $query->where('provinces', $provinsi);
        }
        if ($kabupaten) {
            $query->where('regencies', $kabupaten);
        }
        if ($kecamatan) {
            $query->where('districts', $kecamatan);
        }
        if ($desa) {
            $query->where('villages', $desa);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('gender', 'like', '%' . $search . '%');
            });
        }

        $users = $query->paginate($perPage);

        $provinces = Provinces::all();
        $regencies = $provinsi ? Regencies::where('province_id', $provinsi)->get() : [];
        $districts = $kabupaten ? Districts::where('regency_id', $kabupaten)->get() : [];
        $villages = $kecamatan ? Villages::where('district_id', $kecamatan)->get() : [];

        return view('Admin.users.index', compact('users', 'provinces', 'regencies', 'districts', 'villages'));
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

    public function unblock($id)
    {
        $user = User::findOrFail($id);
        if($user->hasRole('admin')){
            redirect()->route('Pengguna.index')->with('error', 'pengguna adalah Admin');
        }

        $user->status = 'aktif';
        $user->save();
        return redirect()->route('admin.users.banned')->with('success', 'Banned pengguna berhasil dicabut');
    }

    public function disable($id)
    {
        $user = User::findOrFail($id);
        if($user->hasRole('admin')){
            redirect()->route('Pengguna.index')->with('error', 'pengguna adalah Admin');
        }

        $user->status = 'suspend';
        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil disuspend');
    }

    public function enable($id)
    {
        $user = User::findOrFail($id);
        if($user->hasRole('admin')){
            redirect()->route('Pengguna.index')->with('error', 'pengguna adalah Admin');
        }

        $user->status = 'aktif';
        $user->save();
        return redirect()->route('admin.users.suspend')->with('success', 'Suspend pengguna berhasil dicabut');
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
        return redirect()->route('admin.users.index')->with('success', 'Pengguna ini berhasil di hapus');
    }

    public function banned(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = User::where('status', '=', 'banned')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $bannedUsers = $query->paginate($perPage);

        return view('Admin.users.banned', compact('bannedUsers'));
    }

    public function suspend(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = User::where('status', '=', 'suspend')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $suspendUsers = $query->paginate($perPage);

        return view('Admin.users.suspend', compact('suspendUsers'));
    }

    public function getProvinsi()
    {
        $provinsis = Provinces::select('id', 'name')->get();
        return response()->json($provinsis);
    }

    // Controller untuk lokasi
    public function getKabupaten(Request $request)
    {
        $provinsiId = $request->query('provinsi_id');
        $kabupaten = Regencies::where('province_id', $provinsiId)->select('id', 'name')->get();
        return response()->json($kabupaten);
    }

    public function getKecamatan(Request $request)
    {
        $kabupatenId = $request->query('kabupaten_id');
        $kecamatan = Districts::where('regency_id', $kabupatenId)->select('id', 'name')->get();
        return response()->json($kecamatan);
    }

    public function getDesa(Request $request)
    {
        $kecamatanId = $request->query('kecamatan_id');
        $desa = Villages::where('district_id', $kecamatanId)->select('id', 'name')->get();
        return response()->json($desa);
    }

}
