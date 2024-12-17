<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

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
            'nama' => 'required|string|max:255|unique',
            'provinsi_id' => 'required|integer|exists:provinsi,id',
        ], [
            'nama.required' => 'Nama Kabupaten wajib diisi.',
            'nama.unique' => 'Nama Kabupaten sudah terdaftar.',
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

        $kabupaten = Kabupaten::findOrFail( $id );
        $data = $request->validate( [
            'nama' => ['required', 'string', 'max:255',
                Rule::unique('kabupaten', 'nama')->ignore($kabupaten)
        ],
            'provinsi_id' => 'required|integer|exists:provinsi,id'
        ], [
            'nama.required' => 'Nama Kabupaten wajib diisi.',
            'nama.unique' => 'Kabupaten ini telah terdaftar silahkan masukan kabupaten lain nya.',
            'provinsi_id.required' => 'Provinsi wajib diisi.'
        ] );

        try {
            $kabupaten->update($data);
        } catch ( \Exception $e ) {
            Alert::error( 'Gagal', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage() );
        }
        return redirect()->route( 'kabupaten.index' )->with( 'success', 'Data Kabupaten berhasil diupdate.' );
    }

    public function destroy( $id ) {
        $kabupaten = Kabupaten::findOrFail( $id );
        if ($kabupaten->kecamatans()->exists()) {
            return redirect('/kabupaten')->with('error', 'Kabupaten tak bisa di hapus karna memiliki kecamatan yang terkait.');
        }
        try {
            $kabupaten = Kabupaten::findOrFail( $id );
            $kabupaten->delete();
        } catch ( \Exception $e ) {
            Alert::error( 'Gagal', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage() );
        }
        return redirect()->route( 'kabupaten.index' )->with( 'success', 'Data Kabupaten berhasil dihapus.' );
    }
}
