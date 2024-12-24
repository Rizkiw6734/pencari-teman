<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinalti;
use App\Models\User;

class PinaltiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pinalti = Pinalti::with('laporan.terlapor')->paginate(5);
        return view('pinalti.index', compact('pinalti'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::whereHas('roles', function ($query) {
                $query->where('name', 'User ');
            })->get();
        return view('pinalti.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'jenis_pelanggaran' => 'required|string',
            'alasan' => 'required|string',
            'bukti' => 'required|string',
            'jenis_hukuman' => 'required|string',
            'durasi' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Pinalti::create($request->all());

        return redirect()->route('pinalti.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pinalti = Pinalti::findOrFail($id);
        return view('pinalti.show', compact('pinalti'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pinalti = Pinalti::findOrFail($id);
        $users = User::all();
        return view('pinalti.edit', compact('pinalti', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'jenis_pelanggaran' => 'required|string',
            'alasan' => 'required|string',
            'bukti' => 'required|string',
            'jenis_hukuman' => 'required|string',
            'durasi' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $pinalti = Pinalti::findOrFail($id);
        $pinalti->update($request->all());

        return redirect()->route('pinalti.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pinalti = Pinalti::findOrFail($id);
        $pinalti->delete();

        return redirect()->route('pinalti.index')->with('success', 'Data berhasil dihapus.');
    }
}
