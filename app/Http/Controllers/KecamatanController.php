<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Kecamatan;
use App\Models\Kabupaten;
use Illuminate\Validation\Rule;

class KecamatanController extends Controller
{
    public function index() {
       $kecamatan = Kecamatan::all();
       $kabupaten = Kabupaten::all();
       return view( 'kecamatan.index', compact( 'kecamatan', 'kabupaten' ) );
    }

    public function create() {
        $kabupaten = Kabupaten::all();
        return view( 'kecamatan.create', compact( 'kabupaten' ) );
    }

    public function store(Request $request) {
       $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255',
                Rule::unique('kecamatan')->where(function($query) use($request){
                    return $query->where('nama', $request->nama)
                                    ->where('kabupaten_id', $request->kabupaten_id);
                })
        ],
            'kabupaten_id' => 'required|integer|exists:kabupaten,id',
        ], [
            'nama.required' => 'Nama Kecamatan wajib diisi.',
            'nama.unique' => 'Kecamatan dengan Kabupaten yang sama sudah ada.',
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
        $kecamatan = Kecamatan::findOrFail($id);
        $kabupaten = Kabupaten::all();
        return view( 'kecamatan.edit', compact( 'kecamatan', 'kabupaten' ) );
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255',
            Rule::unique('kecamatan')->where(function($query) use($request, $id){
                return $query->where('nama', $request->nama)
                                ->where('kabupaten_id', $request->kabupaten_id)
                                    ->where('id', '!=', $id);
            })
        ],
            'kabupaten_id' => 'required|integer|exists:kabupaten,id',
        ], [
            'nama.required' => 'Nama Kecamatan wajib diisi.',
            'nama.unique' => 'Kecamatan dengan Kabupaten yang sama sudah ada',
            'kabupaten_id.required' => ' Nama kabupaten wajib diisi.',

        ]);

        try {
            $kecamatan = Kecamatan::findOrFail($id);
            $kecamatan->update($request->all());
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
        return redirect()->route('kecamatan.index')->with('success', 'Data Kecamatan berhasil diupdate.');
    }

    public function destroy($id) {
       try {
           $kecamatan = Kecamatan::findOrFail($id);
           $kecamatan->delete();
       } catch (\Exception $e) {
           Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
       }
       return redirect()->route('kecamatan.index')->with('success', 'Data Kecamatan berhasil dihapus.');
    }

    public function getKecamatanByKabupaten($kabupaten_id) {
        $kecamatan = Kecamatan::where('kabupaten_id', $kabupaten_id)->get();
        return response()->json($kecamatan);
    }
}
