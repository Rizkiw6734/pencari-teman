<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\Provinces;
use App\Models\Regencies;
use App\Models\Districts;
use App\Models\Villages;
use App\Models\notifikasi;


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
        $notifications = notifikasi::where('user_id', auth()->id())
        ->where('status', 'unread')
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();


        return view('Admin.users.index', compact('users', 'provinces', 'regencies', 'districts', 'villages','notifications'));
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
        $notifications = notifikasi::where('user_id', auth()->id())
        ->where('status', 'unread')
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

        return view('Admin.users.banned', compact('bannedUsers','notifications'));
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
        $notifications = notifikasi::where('user_id', auth()->id())
        ->where('status', 'unread')
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

        return view('Admin.users.suspend', compact('suspendUsers','notifications'));
    }

    public function getProvinces()
    {
        return response()->json(Provinces::all());
    }

    // Ambil kabupaten berdasarkan provinsi yang dipilih
    public function getRegencies($province_id)
{
    try {
        $regencies = Regencies::where('province_id', $province_id)->get(); // Sesuaikan model 'Regency'
        return response()->json($regencies);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Terjadi kesalahan'], 500);
    }
}


    // Ambil user berdasarkan kabupaten yang dipilih
    public function getUsers($kabupaten_id)
{
    $users = User::where('kabupaten_id', $kabupaten_id)
    ->whereNotIn('status', ['banned', 'suspend']) // Menyaring user yang tidak memiliki status banned dan suspend
    ->with(['provinsis', 'kabupatens', 'kecamatans', 'desas'])
    ->get();


    if ($users->isEmpty()) {
        return response()->json([], 200); // Kembalikan array kosong jika tidak ada data
    }

    return response()->json($users, 200); // Kembalikan data pengguna
}

    public function getUsersBanned($kabupaten_id)
{
    $users = User::where('kabupaten_id', $kabupaten_id)
    ->whereNotIn('status', ['aktif', 'suspend']) // Mengecualikan pengguna yang statusnya active dan suspend
    ->with(['provinsis', 'kabupatens', 'kecamatans', 'desas'])
    ->get();


    if ($users->isEmpty()) {
        return response()->json([], 200); // Kembalikan array kosong jika tidak ada data
    }

    return response()->json($users, 200); // Kembalikan data pengguna
}

    public function getUsersSuspend($kabupaten_id)
{
    $users = User::where('kabupaten_id', $kabupaten_id)
    ->whereNotIn('status', ['aktif', 'banned']) // Mengecualikan pengguna yang statusnya active dan suspend
    ->with(['provinsis', 'kabupatens', 'kecamatans', 'desas'])
    ->get();


    if ($users->isEmpty()) {
        return response()->json([], 200); // Kembalikan array kosong jika tidak ada data
    }

    return response()->json($users, 200); // Kembalikan data pengguna
}


}
