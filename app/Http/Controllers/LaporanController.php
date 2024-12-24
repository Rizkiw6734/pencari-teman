<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\User;
use App\Models\Pinalti;
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
        $users = User::role('User')->get();
        return view('laporan.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'report_id' => 'required|exists:users,id',
            'reported_id' => 'required|exists:users,id|different:report_id',
            'bukti' => 'required|image|max:5280|mimes:jpeg,png,jpg',
            'alasan' => 'required|string|max:255',
        ], [
            'report_id.required' => 'Pelapor harus ada',
            'report_id.exists' => 'Pelapor tidak valid',
            'reported_id.required' => 'terlapor harus ada',
            'reported_id.exists' => 'terlpor tidak valid',
            'reported_id.different' => 'terlapor harus berbeda dari Pelapor',
            'bukti.required' => 'Cover buku harus di isi.',
            'bukti.image' => 'File harus berupa gambar.',
            'bukti.mimes' => 'Format gambar harus berupa jpeg, png, atau jpg.',
            'bukti.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
            'alasan.required' => 'alasan laporan harus ada'
        ]);

        $file = $request->file('bukti');
        $filename = $file->getClientOriginalName();
        if (Laporan::where('bukti', $filename)->exists()) {
            return redirect()->back()->with('error', 'Gambar ini sudah ada. Silakan pilih gambar yang berbeda.');
        }
        $file->move(public_path('assets/img/laporan'), $filename);
        $data['bukti'] = $filename;

        if (Laporan::create($data)) {
            return redirect('/laporan')->with('success', 'laporan berhasil ditambahkan.');
        }

        return redirect('/laporan')->with('error', 'laporan gagal ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $laporan = Laporan::with('pelapor', 'terlapor')->findOrFail($id);
        return view('laporan.show', compact('laporan'));
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

    public function berikanHukuman(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $jenisHukuman = $request->input('jenis_hukuman');

        switch ($jenisHukuman) {
            case 'peringatan':
                Pinalti::create([
                    'laporan_id' => $laporan->id,
                    'jenis_hukuman' => 'peringatan',
                    'pesan' => $request->input('pesan'),
                    'start_date' => now(),
                    'end_date' => null,
                ]);
                break;

            case 'suspend':
                $request->validate([
                    'durasi' => 'required|integer|min:1',
                ]);

                $durasi = (int) $request->input('durasi');

                Pinalti::create([
                    'laporan_id' => $laporan->id,
                    'jenis_hukuman' => 'suspend',
                    'pesan' => $request->input('pesan'),
                    'durasi' => $durasi,
                    'start_date' => now(),
                    'end_date' => now()->addDays('durasi'),
                ]);
                break;

            case 'banned':
                Pinalti::create([
                    'laporan_id' => $laporan->id,
                    'jenis_hukuman' => 'banned',
                    'pesan' => 'Pengguna dibanned.',
                    'start_date' => now(),
                    'end_date' => null,
                ]);

                $user = User::find($laporan->reported_id);
                $user->status = 'banned';
                $user->save();
                break;

            default:
                return back()->withErrors(['jenis_hukuman' => 'Jenis hukuman tidak valid.']);
        }

        $laporan->status = 'diterima';
        $laporan->save();

        return redirect()->route('laporan.index')->with('success', 'Hukuman berhasil diberikan dan status laporan diperbarui.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laporan = Laporan::findOrFail($id);
        $gambarPath = public_path('assets/img/laporan/' . $laporan->bukti);

        if (file_exists($gambarPath)) {
            unlink($gambarPath);
        }

        if ($laporan->delete()) {
            return redirect('/laporan')->with('success', 'Laporan berhasil dihapus.');
        }
    }
}
