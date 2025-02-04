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
    public function index(Request $request)
    {
        $query = Laporan::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('pelapor', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('terlapor', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhere('status', 'like', '%' . $search . '%')
              ->orWhereDate('created_at', $search);
        }

        $laporans = $query->with(['pelapor', 'terlapor'])->paginate(10);
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
            'bukti' => 'image|max:5280|mimes:jpeg,png,jpg',
            'alasan' => 'required|string|max:255',
        ], [
            'report_id.required' => 'Pelapor harus ada',
            'report_id.exists' => 'Pelapor tidak valid',
            'reported_id.required' => 'terlapor harus ada',
            'reported_id.exists' => 'terlpor tidak valid',
            'reported_id.different' => 'terlapor harus berbeda dari Pelapor',
            'bukti.image' => 'File harus berupa gambar.',
            'bukti.mimes' => 'Format gambar harus berupa jpeg, png, atau jpg.',
            'bukti.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
            'alasan.required' => 'alasan laporan harus ada'
        ]);

        $existingReport = Laporan::where('report_id', $request->report_id)
        ->where('reported_id', $request->reported_id)
        ->where('status', '!=', 'selesai' && 'status', '!=', 'ditolak')
        ->exists();

        if ($existingReport) {
            return redirect()->back()->with('error', 'Anda sudah memiliki laporan terhadap pengguna ini. Tunggu hingga laporan selesai atau di tolak.');
        }

        if($file = $request->file('bukti')) {
            $filename = $file->getClientOriginalName();
            if (Laporan::where('bukti', $filename)->exists()) {
                return redirect()->back()->with('error', 'Gambar ini sudah ada. Silakan pilih gambar yang berbeda.');
            }
            $file->move(public_path('assets/img/laporan'), $filename);
            $data['bukti'] = $filename;
        }

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
        $laporan = Laporan::findOrFail($id);

        if ($laporan->status === 'diterima' || $laporan->status === 'ditolak') {
            return redirect('/laporan')->with('error', 'Laporan sudah selesai, tidak dapat diubah.');
        }

        $request->validate([
            'report_id' => 'required|exists:users,id',
            'reported_id' => 'required|exists:users,id|different:report_id',
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'alasan' => 'required|string|max:255',
        ]);



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
        $userId = $laporan->reported_id;
        $jenisHukuman = $request->input('jenis_hukuman');

        $hukumanAktif = Pinalti::whereHas('laporan', function ($query) use ($userId) {
            $query->where('reported_id', $userId);
        })
        ->where(function ($query) {
            $query->where('jenis_hukuman', 'suspend')
                  ->orWhere('jenis_hukuman', 'banned');
        })
        ->where(function ($query) {
            $query->whereNull('end_date')
                  ->orWhere('end_date', '>', now());
        })
        ->exists();

        if ($hukumanAktif) {
            $laporan->status = 'selesai';
            $laporan->save();
            return redirect('/laporan')->with('success', 'Pengguna sudah memiliki hukuman aktif. Laporan dianggap selesai.');

        }

        switch ($jenisHukuman) {
            case 'peringatan':
                $totalPeringatan = Pinalti::whereHas('laporan', function ($query) use ($laporan) {
                    $query->where('reported_id', $laporan->reported_id);
                })
                ->where('jenis_hukuman', 'peringatan')
                ->count();

                if ($totalPeringatan >= 3) {
                    return redirect('/laporan')->with('error', 'Pengguna sudah menerima 3 peringatan. Hanya bisa diberikan suspend atau banned.');
                }

                $validated = $request->validate([
                    'pesan' => 'required|regex:/^[a-zA-Z\s]+$/',
                ],[
                  'pesan.required' => 'Pesan Peringatan Tidak Boleh Kosong',
                  'pesan.regex' => 'Pesan Tidak Boleh Angka'
                ]);

                $pesan = $validated['pesan'];

                Pinalti::create([
                    'laporan_id' => $laporan->id,
                    'jenis_hukuman' => 'peringatan',
                    'pesan' => $pesan,
                    'start_date' => now(),
                    'end_date' => null,
                ]);

                $laporan->status = 'selesai';
                $laporan->save();
                break;

            case 'suspend':
                $request->validate([
                    'pesan' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'durasi' => 'required|integer|min:1|max:6',
                ], [
                    'pesan.required' => 'Pesan Peringatan Tidak Boleh Kosong',
                    'pesan.regex' => 'Pesan Tidak Boleh Angka',
                    'durasi.required' => 'Durasi Suspend harus jelas.',
                    'durasi.min' => 'Minimal durasi suspend adalah satu hari.',
                    'durasi.max' => 'Max waktu suspend adalah 6 hari.'
                ]);

                $durasi = (int) $request->durasi;

                Pinalti::create([
                    'laporan_id' => $laporan->id,
                    'jenis_hukuman' => 'suspend',
                    'pesan' => $request->pesan,
                    'durasi' => $durasi,
                    'start_date' => now(),
                    'end_date' => now()->addDays($durasi),
                ]);
                $user = User::find($laporan->reported_id);
                $user->status = 'suspend';
                $user->save();

                Laporan::where('reported_id', $userId)
                   ->where('status', '!=', 'selesai')
                   ->get()
                   ->each(function($laporan) {
                       $laporan->status = 'selesai';
                       $laporan->save();
                   });

                $laporan->status = 'diterima';
                $laporan->save();
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

                $lp = Laporan::where('reported_id', $userId)->get();

                Laporan::where('reported_id', $userId)
                ->where('status', '!=', 'selesai')
                ->get()
                ->each(function($laporan) {
                    $laporan->status = 'selesai';
                    $laporan->save();
                });

                $laporan->status = 'selesai';
                $laporan->save();
                break;

            default:
                return back()->withErrors(['jenis_hukuman' => 'Jenis hukuman tidak valid.']);
        }

        return redirect()->route('laporan.index')->with('success', 'Hukuman berhasil diberikan dan status laporan diperbarui.');
    }


        /**
     * Reject a specific report and update its status.
     */
    public function tolakLaporan(Request $request, string $id)
    {
        $laporan = Laporan::findOrFail($id);

        if ($laporan->status === 'diterima' || $laporan->status === 'ditolak') {
            return redirect('/laporan')->with('error', 'Laporan sudah selesai dan tidak dapat diubah.');
        }

        $laporan->status = 'ditolak';
        $laporan->save();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditolak.');
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
