<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;
use RealRashid\SweetAlert\Facades\Alert;

class ProvinsiController extends Controller {
    //

    public function index() {
        $provinsi = Provinsi::all();
        return view( 'provinsi.index', compact( 'provinsi'));
    }

    public function create() {
        return view( 'provinsi.create' );
    }

    public function store( Request $request ) {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama Provinsi wajib diisi.',
        ]);

       try {
            Provinsi::create( $request->all() );
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
        return redirect()->route('provinsi.index')->with('success', 'Data Provinsi berhasil ditambahkan.');
    }

    public function edit($id) {
        $provinsi = Provinsi::findOrFail($id);
        return view('provinsi.edit', compact('provinsi'));
    }

    public function update( Request $request, $id ) {
        $validated = $request->validate( [
            'nama' => 'required|string|max:255',
        ],[
            'nama.required' => 'Nama Provinsi wajib diisi.',
        ] );

      try {
            $provinsi = Provinsi::findOrFail( $id );
            $provinsi->update( $request->all() );
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage());
        }
        return redirect()->route('provinsi.index')->with('success', 'Data Provinsi berhasil diupdate.');
    }

    public function destroy( $id ) {
        try {
            $provinsi = Provinsi::findOrFail( $id );
            $provinsi->delete();

        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
        return redirect()->route('provinsi.index')->with('success', 'Data Provinsi berhasil dihapus.');
    }
        }
