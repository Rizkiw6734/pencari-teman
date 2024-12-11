<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Desa;
use App\Models\Kecamatan;

class DesaController extends Controller
{
    // Menampilkan daftar desa beserta kecamatan
    public function index() {
        $desa = Desa::all();
        $kecamatan = Kecamatan::all();
        return view('desa.index', compact('desa', 'kecamatan'));
    }

    // Menampilkan form untuk membuat desa baru
    public function create(){
        $kecamatan = Kecamatan::all();
        return view('desa.create', compact('kecamatan'));
    }

    // Menyimpan data desa baru
    public function store(Request $request){
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kecamatan_id' => 'required|integer|exists:kecamatan,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ],[
            'nama.required' => 'Nama Desa wajib diisi',
            'kecamatan_id.required' => ' Nama kecamatan wajib diisi',
            'latitude.required' => 'Latitude wajib diisi',
            'longitude.required' => 'Longitude wajib diisi'
        ]);

        try {
            Desa::create($request->only(['nama', 'kecamatan_id', 'latitude', 'longitude']));
            Alert::success('Berhasil!', 'Data Desa berhasil ditambahkan.');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }

        return redirect()->route('desa.index');
    }

    // Mengedit data desa
    public function edit($id){
        $desa = Desa::findOrFail($id);
        $kecamatan = Kecamatan::all();
        return view('desa.edit', compact('desa', 'kecamatan'));
    }

    // Mengupdate data desa
    public function update(Request $request, $id){
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kecamatan_id' => 'required|integer|exists:kecamatan,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ],[
            'nama.required' => 'Nama Desa wajib diisi',
            'kecamatan_id.required' => ' Nama Kecamatan wajib diisi',
            'latitude.required' => 'Latitude wajib diisi',
            'longitude.required' => 'Longitude wajib diisi'
        ]);

        try {
            $desa = Desa::findOrFail($id);
            $desa->update($request->only(['nama', 'kecamatan_id', 'latitude', 'longitude']));
            Alert::success('Berhasil!', 'Data Desa berhasil diupdate.');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }

        return redirect()->route('desa.index');
    }

    // Menghapus data desa
    public function destroy($id){
        try {
            $desa = Desa::findOrFail($id);
            $desa->delete();

            Alert::success('Berhasil!', 'Data Desa berhasil dihapus.');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }

        return redirect()->route('desa.index');
    }
}
