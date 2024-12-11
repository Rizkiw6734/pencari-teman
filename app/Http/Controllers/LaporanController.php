<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = Laporan::with(['pelapor', 'terlapor'])->paginate(10);
        return view('laporan.index', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('laporan.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'report_id' => 'required|exists:users,id',
            'reported_id' => 'required|exists:users,id|different:report_id',
            'bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'alasan' => 'required|string|max:255',
        ]);

        $buktiPath = $request->file('bukti')->store('bukti', 'public');

        $laporan = new Laporan();
        $laporan->report_id = $request->report_id;
        $laporan->reported_id = $request->reported_id;
        $laporan->bukti = $buktiPath;
        $laporan->alasan = $request->alasan;
        $laporan->save();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditambahkan!');
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
        $laporan = Laporan::findOrFail($id);
        $users = User::all();
        return view('laporan.edit', compact('laporan', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'report_id' => 'required|exists:users,id',
            'reported_id' => 'required|exists:users,id|different:report_id',
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'alasan' => 'required|string|max:255',
        ]);

        $laporan = Laporan::findOrFail($id);

        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti', 'public');
            $laporan->bukti = $buktiPath;
        }

        $laporan->report_id = $request->report_id;
        $laporan->reported_id = $request->reported_id;
        $laporan->alasan = $request->alasan;
        $laporan->save();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus!');
    }
}
