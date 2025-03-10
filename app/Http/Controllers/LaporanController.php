<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\AdminLog;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pinalti;
use App\Models\notifikasi;
use App\Models\UserLog;
use App\Models\NotifLaporan;
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

        $laporans = $query->with(['pelapor', 'terlapor'])
        ->orderByRaw("FIELD(status, 'proses', 'dibanned', 'peringatan', 'disuspend', 'diterima', 'selesai', 'ditolak')")
        ->paginate(10);

        $notifications = notifikasi::where('user_id', auth()->id())
    ->where('status', 'unread')
    ->orderBy('created_at', 'desc')
    ->take(10)
    ->get()
    ->map(function ($notification) {
        $notification->foto_profil = User::where('id', $notification->user_id)->value('foto_profil');
        return $notification;
    });


        return view('laporan.index', compact('laporans','notifications'));
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
         // Validasi input
         $data = $request->validate([
             'reported_id' => 'required|exists:users,id',
             'bukti' => 'image|max:5280|mimes:jpeg,png,jpg',
             'alasan' => 'required|string|max:255',
             'pelanggaran' => 'required|string|max:255',
         ], [
             'reported_id.required' => 'Terlapor harus ada',
             'reported_id.exists' => 'Terlapor tidak valid',
             'bukti.image' => 'File harus berupa gambar.',
             'bukti.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
             'bukti.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
             'alasan.required' => 'Alasan laporan harus ada',
             'pelanggaran.required' => 'Pelanggaran harus diisi',
         ]);

         // Set pelapor
         $data['report_id'] = Auth::id();
         $reportedUser = User::findOrFail($data['reported_id']);

         $existingReport = Laporan::where('report_id', $data['report_id'])
             ->where('reported_id', $data['reported_id'])
             ->orderBy('created_at', 'desc')
             ->first();

         if ($existingReport) {
             if ($existingReport->status === 'dibanned') {
                 return redirect()->back()->with('error', 'Pengguna ini sudah dibanned. Tidak perlu melaporkannya lagi.');
             }
             if ($existingReport->status === 'disuspend') {
                 return redirect()->back()->with('error', 'Pengguna ini sudah disuspend. Tidak perlu melaporkannya lagi.');
             }
             if ($existingReport->status === 'proses') {
                 return redirect()->back()->with('error', 'Laporan terhadap pengguna ini masih dalam proses. Mohon tunggu hingga laporan selesai atau ditolak.');
             }
         }

         // Simpan bukti gambar jika ada
         if ($file = $request->file('bukti')) {
             $filename = time() . '_' . $file->getClientOriginalName(); // Tambahkan timestamp agar unik
             if (Laporan::where('bukti', $filename)->exists()) {
                 return redirect()->back()->with('error', 'Gambar ini sudah ada. Silakan pilih gambar yang berbeda.');
             }
             $file->move(public_path('assets/img/laporan'), $filename);
             $data['bukti'] = $filename;
         }

         // Simpan laporan
         $laporan = Laporan::create($data);

         // Simpan log aktivitas
         UserLog::create([
             'user_id' => auth()->id(),
             'aktivitas' => "Anda telah berhasil melaporkan {$reportedUser->name} dengan pelanggaran: {$data['pelanggaran']}"
         ]);

         // Kirim notifikasi ke semua admin
         $admins = User::role('Admin')->get();
         foreach ($admins as $admin) {
             notifikasi::create([
                 'user_id' => $admin->id, // Admin sebagai penerima notifikasi
                 'laporan_id' => $laporan->id,
                 'judul' => 'Laporan Baru Masuk',
                 'pesan' => 'Ada laporan baru dari ' . auth()->user()->name . ' terkait pelanggaran: ' . $data['pelanggaran'],
                 'link' => url("/laporan"),
             ]);
         }

         // Kirim notifikasi ke pelapor
         notifikasi::create([
            'user_id' => auth()->id(), // Pelapor sebagai penerima notifikasi
            'laporan_id' => $laporan->id,
            'judul' => 'Laporan Anda Telah Dikirim',
            'pesan' => 'Laporan Anda terhadap ' . $reportedUser->name . ' dengan pelanggaran: ' . $data['pelanggaran'] . ' telah berhasil dikirim.',
            'link' => 'modal-' . $laporan->id, // ID modal yang akan ditampilkan
        ]);

        notifikasi::create([
            'user_id' => $reportedUser->id, // Terlapor sebagai penerima notifikasi
            'laporan_id' => $laporan->id,
            'judul' => 'Laporan Terhadap Anda',
            'pesan' => 'Kami ingin menginformasikan bahwa akun Anda telah dilaporkan oleh '. auth()->user()->name.' karena terdeteksi '.$data['pelanggaran'].'. Laporan ini akan kami tinjau untuk memastikan apakah ada pelanggaran terhadap pedoman komunitas kami.',
            'link' => 'modal-' . $laporan->id, // ID modal yang akan ditampilkan
        ]);

         return redirect()->back()->with('success', 'Laporan berhasil ditambahkan.');
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

        $sudahPernahDihukum = Pinalti::whereHas('laporan', function ($query) use ($userId) {
            $query->where('reported_id', $userId);
        })
        ->whereIn('jenis_hukuman', ['suspend', 'banned'])
        ->exists();

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

                $pinalti = Pinalti::create([
                    'laporan_id' => $laporan->id,
                    'jenis_hukuman' => 'peringatan',
                    'pesan' => $validated['pesan'],
                    'start_date' => now(),
                    'end_date' => null,
                ]);

                notifikasi::create([
                    'user_id' => $laporan->reported_id, // Terlapor menerima notifikasi
                    'laporan_id' => $laporan->id,
                    'type' => 'peringatan',
                    'judul' => 'Anda Mendapat Peringatan',
                    'pesan' =>  $validated['pesan'],
                    'is_read' => false,
                    'link' => 'modal-' . $laporan->id,
                ]);

                AdminLog::create([
                    'users_id' => Auth::id(),
                    'aktivitas' => 'Admin menyetujui laporan dari user ' . $laporan->pelapor->name . ' dan memberikan pinalti berupa peringatan kepada user ' . $laporan->terlapor->name,
                ]);

                $laporan->status = 'peringatan';
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

                if ($sudahPernahDihukum) {
                    Laporan::where('reported_id', $userId)
                        ->whereNotIn('status', ['selesai', 'peringatan'])
                        ->get()
                        ->each(function($laporan) {
                            $laporan->status = 'selesai';
                            $laporan->save();
                        });

                    $jenisHukumanTerakhir = Pinalti::whereHas('laporan', function ($query) use ($userId) {
                            $query->where('reported_id', $userId);
                        })
                        ->whereIn('jenis_hukuman', ['suspend', 'banned'])
                        ->orderByDesc('start_date')
                        ->first();

                    if ($jenisHukumanTerakhir) {
                        $pesan = "Pengguna ini sudah terkena hukuman {$jenisHukumanTerakhir->jenis_hukuman}. Laporan dianggap selesai.";

                        AdminLog::create([
                            'users_id' => Auth::id(),
                            'aktivitas' => "Admin menandai laporan terkait user {$laporan->terlapor->name} sebagai selesai karena pengguna sudah terkena hukuman {$jenisHukumanTerakhir->jenis_hukuman}.",
                        ]);

                        return redirect()->route('laporan.index')->with('success', $pesan);
                    }
                }

                // $hasWarnings = Pinalti::whereHas('laporan', function ($query) use ($laporan) {
                //     $query->where('reported_id', $laporan->reported_id);
                // })->where('jenis_hukuman', 'peringatan')->exists();

                // if ($hasWarnings) {
                //     Pinalti::whereHas('laporan', function ($query) use ($laporan) {
                //         $query->where('reported_id', $laporan->reported_id);
                //     })->where('jenis_hukuman', 'peringatan')->delete();

                //     AdminLog::create([
                //         'users_id' => Auth::id(),
                //         'aktivitas' => 'Semua pinalti peringatan terhadap user ' . $laporan->terlapor->name . ' dihapus karena mendapatkan hukuman suspend.',
                //     ]);
                // }

                $pinalti = Pinalti::create([
                    'laporan_id' => $laporan->id,
                    'jenis_hukuman' => 'suspend',
                    'pesan' => $request->pesan,
                    'durasi' => (int) $request->durasi,
                    'start_date' => now(),
                    'end_date' => now()->addDays((int) $request->durasi),
                ]);

                AdminLog::create([
                    'users_id' => Auth::id(),
                    'aktivitas' => 'Admin menyetujui laporan dari user ' . $laporan->pelapor->name . ' dan memberikan pinalti berupa suspend (Durasi: ' . $request->durasi . ' hari) kepada user ' . $laporan->terlapor->name,
                ]);

                $user = User::find($laporan->reported_id);
                $user->status = 'suspend';
                $user->save();
                $laporan->status = 'disuspend';
                $laporan->save();
                break;

            case 'banned':
                if ($sudahPernahDihukum) {
                    Laporan::where('reported_id', $userId)
                        ->whereNotIn('status', ['selesai', 'peringatan'])
                        ->get()
                        ->each(function($laporan) {
                            $laporan->status = 'selesai';
                            $laporan->save();
                        });

                    $jenisHukumanTerakhir = Pinalti::whereHas('laporan', function ($query) use ($userId) {
                            $query->where('reported_id', $userId);
                        })
                        ->whereIn('jenis_hukuman', ['suspend', 'banned'])
                        ->orderByDesc('start_date')
                        ->first();

                    if ($jenisHukumanTerakhir) {
                        $pesan = "Pengguna ini sudah terkena hukuman {$jenisHukumanTerakhir->jenis_hukuman}. Laporan dianggap selesai.";

                        AdminLog::create([
                            'users_id' => Auth::id(),
                            'aktivitas' => "Admin menandai laporan terkait user {$laporan->terlapor->name} sebagai selesai karena pengguna sudah terkena hukuman {$jenisHukumanTerakhir->jenis_hukuman}.",
                        ]);

                        return redirect()->route('laporan.index')->with('success', $pesan);
                    }
                }


                $pinalti = Pinalti::create([
                    'laporan_id' => $laporan->id,
                    'jenis_hukuman' => 'banned',
                    'pesan' => 'Pengguna dibanned.',
                    'start_date' => now(),
                    'end_date' => null,
                ]);

                AdminLog::create([
                    'users_id' => Auth::id(),
                    'aktivitas' => 'Admin menyetujui laporan dari user ' . $laporan->pelapor->name . ' dan memberikan pinalti berupa banned kepada user ' . $laporan->terlapor->name,
                ]);

                $user = User::find($laporan->reported_id);
                $user->status = 'banned';
                $user->save();

                $lp = Laporan::where('reported_id', $userId)->get();

                $laporan->status = 'dibanned';
                $laporan->save();
                break;

            default:
                return back()->withErrors(['jenis_hukuman' => 'Jenis hukuman tidak valid.']);
        }

        return redirect()->route('laporan.index')->with('success', 'Hukuman berhasil diberikan, status laporan diperbarui dan log dicatat.');
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

        AdminLog::create([
            'users_id' => Auth::id(),
            'aktivitas' => 'Admin menolak laporan dari ' . $laporan->pelapor->name . ' terhadap ' . $laporan->terlapor->name . '.',
        ]);

        Notifikasi::create([
            'user_id' => $laporan->pelapor->id,
            'laporan_id' => $laporan->id,
            'judul' => 'Laporan Anda Ditolak',
            'pesan' => 'Laporan Anda terhadap ' . $laporan->terlapor->name . ' telah ditolak oleh admin.',
            'link' => 'modal-' . $laporan->id,
        ]);


        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditolak dan Log dicatat.');
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
