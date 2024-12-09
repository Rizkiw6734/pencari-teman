<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Kecamatan;
use App\Models\Kabupaten;

class KecamatanController extends Controller
{
    public function index() {
        $kecamatan = Kecamatan::all();
        $kabupaten = Kabupaten::all();
        return view( 'kecamatan.index', compact( 'kecamatan','kabupaten' ) );
    }

    public function create() {
        $kabupaten = Kabupaten::all();
        return view( 'kecamatan.create', compact( 'kabupaten' ) );
    }

    public function store(Request $request) {
       $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kabupaten_id' => 'required|integer|exists:kabupaten,id',
        ], [
            'nama.required' => 'Nama Kecamatan wajib diisi.',
            'kabupaten_id.required' => 'Nama kabupaten wajib diisi.',
        ]);

        try {
            Kecamatan::create( $request->all() );
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
        return redirect()->route('kecamatan.index')->with('success', 'Data Kecamatan berhasil ditambahkan.');
    }

    public function edit($id) {
        $kecamatan = Kecamatan::findOrfail($id);
        $kabupaten = Kabupaten::all();
        return view( 'kecamatan.edit', compact( 'kecamatan', 'kabupaten' ) );
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kabupaten_id' => 'required|integer|exists:kabupaten,id',
        ], [
            'nama.required' => 'Nama Kecamatan wajib diisi.',
            'kabupaten_id.required' => ' Nama kabupaten wajib diisi.',

        ]);

        try {
            $kecamatan = Kecamatan::findOrfail($id);
            $kecamatan->update($request->all());
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
        return redirect()->route('kecamatan.index')->with('success', 'Data Kecamatan berhasil diupdate.');
    }

    public function destroy($id) {
       try {
           $kecamatan = Kecamatan::findOrfail($id);
           $kecamatan->delete();
       } catch (\Exception $e) {
           Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
       }
       return redirect()->route('kecamatan.index')->with('success', 'Data Kecamatan berhasil dihapus.');
    }
}
