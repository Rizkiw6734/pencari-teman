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
        $laporan = Laporan::all();
        $user = User::all();
        return view('laporan.index', compact('laporan', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        return view('laporan.create', compact('laporan', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'report_id' => 'required|integer|exists:user,id',
            'reported_id' => 'required|integer|exists:user,id',
            'bukti' => 'required|string|max:255',
            'alasan' => 'required|text|max:255',
            'status' => 'required|enum:0,1'
        ],[
            'report_id.required' => 'Laporan wajib diisi.',
            'reported_id.required' => 'Reported wajib diisi.',
            'bukti.required' => 'Bukti wajib diisi.',
            'alasan.required' => 'Alasan wajib diisi.',
            'status.required' => 'Status wajib diisi.'
        ]);

        try {
            Laporan::create($request->all());
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
        return redirect()->route('laporan.index')->with('success', 'Data Laporan berhasil ditambahkan.');
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
        $user = User::findOrFail($laporan->report_id);
        return view('laporan.edit', compact('laporan', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'report_id' => 'required|integer|exists:user,id',
            'reported_id' => 'required|integer|exists:user,id',
            'bukti' => 'required|string|max:255',
            'alasan' => 'required|text|max:255',
            'status' => 'required|enum:0,1'
        ],[
            'report_id.required' => 'Laporan wajib diisi.',
            'reported_id.required' => 'Reported wajib diisi.',
            'bukti.required' => 'Bukti wajib diisi.',
            'alasan.required' => 'Alasan wajib diisi.',
            'status.required' => 'Status wajib diisi.'
        ]);

        try {
            $laporan = Laporan::findOrFail($id);
            $laporan->update($request->all());
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
        return redirect()->route('laporan.index')->with('success', 'Data Laporan berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $laporan = Laporan::findOrFail($id);
            $laporan->delete();
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
        return redirect()->route('laporan.index')->with('success', 'Data Laporan berhasil dihapus.');
    }
}
