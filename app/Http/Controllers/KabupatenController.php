<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use RealRashid\SweetAlert\Facades\Alert;

class KabupatenController extends Controller {

    public function index() {
        $kabupaten = Kabupaten::all();
        $provinsi = Provinsi::all();
        return view( 'kabupaten.index', compact( 'kabupaten','provinsi' ) );
    }

    public function create() {
        $kabupaten = Kabupaten::all();
        return view( 'kabupaten.create', compact( 'kabupaten' ) );
    }

    public function store( Request $request ) {
        $validated = $request->validate( [
            'nama' => 'required|string|max:255',
            'provinsi_id' => 'required|integer|exists:provinsi,id',
        ], [
            'nama.required' => 'Nama Kabupaten wajib diisi.',
            'provinsi_id.required' => 'Nama Provinsi wajib diisi.',
        ] );

        try {
            Kabupaten::create( $request->all() );
        } catch ( \Exception $e ) {
            Alert::error( 'Gagal', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage() );
        }
        return redirect()->route( 'kabupaten.index' )->with( 'success', 'Data Kabupaten berhasil ditambahkan.' );
    }

    public function edit( $id ) {
        $kabupaten = Kabupaten::findOrFail( $id );
        $provinsi = Provinsi::all();
        return view( 'kabupaten.edit', compact( 'kabupaten', 'provinsi' ) );
    }

    public function update( Request $request, $id ) {
        $validated = $request->validate( [
            'nama' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama Kabupaten wajib diisi.',
        ] );

        try {
            $kabupaten = Kabupaten::finOrFail( $id );
            $kabupaten->update ( $request->all() );
        } catch ( \Exception $e ) {
            Alert::error( 'Gagal', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage() );
        }
        return redirect()->route( 'kabupaten.index' )->with( 'success', 'Data Kabupaten berhasil diupdate.' );
    }

    public function destroy( $id ) {
        try {
            $kabupaten = Kabupaten::findOrFail( $id );
            $kabupaten->delete();
        } catch ( \Exception $e ) {
            Alert::error( 'Gagal', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage() );
        }
        return redirect()->route( 'kabupaten.index' )->with( 'success', 'Data Kabupaten berhasil dihapus.' );
    }
}
