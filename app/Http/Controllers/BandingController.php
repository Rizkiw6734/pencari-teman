<?php

namespace App\Http\Controllers;

use App\Models\Banding;
use App\Models\User;
use App\Models\Pinalti;
use Illuminate\Http\Request;
use App\Models\AdminLog;
use Illuminate\Support\Facades\Auth;
use App\Models\notifikasi;
use App\Models\Laporan;

class BandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Banding::query(); // Inisialisasi query

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%'); // Cari berdasarkan nama user
            })->orWhereHas('pinalti', function ($q) use ($search) {
                $q->where('jenis_hukuman', 'like', '%' . $search . '%'); // Cari berdasarkan jenis hukuman
            })->orWhere('status', 'like', '%' . $search . '%'); // Cari berdasarkan status
        }

        $bandings = $query->with(['user', 'pinalti'])
        ->orderByRaw("FIELD(status, 'proses', 'diterima', 'ditolak')")
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


        return view('banding.index', compact('bandings','notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $pinaltis = Pinalti::whereHas('laporan', function ($query) use ($user) {
            $query->where('reported_id', $user->id)->whereIn('jenis_hukuman', ['suspend', 'banned']);
        })->get();

        return view('banding.create', compact('user', 'pinaltis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'pinalti_id' => 'required|exists:pinalti,id',
            'alasan_banding' => 'required|string|max:255',
        ], [
            'pinalti_id.required' => 'pinalti harus di isi.',
            'alasan_banding.required' => 'alasan banding harus di isi.',
            'alasan_banding.max' => 'alasan banding tidak bisa lebih dari 255 karakter.'
        ]);


        $existingBanding = Banding::where('users_id', Auth::user()->id)
        ->where('pinalti_id', $request->pinalti_id)
        ->whereNotIn('status', ['ditolak'])
        ->first();

        if ($existingBanding) {
            return redirect()->back()->with('error', 'Anda sudah mengajukan banding untuk pinalti ini.');
        }

        $pinalti = Pinalti::findOrFail($request->pinalti_id);

        Banding::create([
            'users_id' => Auth::user()->id,
            'pinalti_id' => $request->pinalti_id,
            'jenis_hukuman' => $pinalti->jenis_hukuman,
            'alasan_banding' => $request->alasan_banding,
            'status' => 'proses',
        ]);

        return redirect()->back()->with('success', 'Banding berhasil diajukan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banding $banding)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banding = Banding::with(['pinalti', 'user'])->findOrFail($id);
        $user = Auth::user();
        $pinaltis = Pinalti::whereHas('laporan', function ($query) use ($user) {
            $query->where('report_id', $user->id)
                ->orWhere('reported_id', $user->id);
        })->get();

        return view('banding.edit', compact('banding', 'pinaltis'));
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banding $banding)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banding $banding)
    {
        //
    }

    public function tolakBanding(Request $request, string $id)
    {
        $banding = Banding::findOrFail($id);

        if ($banding->status === 'diterima' || $banding->status === 'ditolak') {
            return redirect('/banding')->with('error', 'Banding sudah selesai dan tidak dapat diubah.');
        }

        $banding->status = 'ditolak';
        $banding->save();

        AdminLog::create([
            'users_id' => Auth::id(),
            'aktivitas' => 'Admin menolak aju banding dari user ' . $banding->user->name,
        ]);

        return redirect()->route('banding.index')->with('success', 'Laporan berhasil ditolak.');
    }

    public function terimaBanding(Request $request, string $id)
{
    $banding = Banding::with('pinalti')->findOrFail($id);

    if ($banding->status === 'diterima' || $banding->status === 'ditolak') {
        return redirect('/banding')->with('error', 'Banding sudah selesai dan tidak dapat diubah.');
    }

    $pinalti = $banding->pinalti;

    if (!$pinalti) {
        return redirect('/banding')->with('error', 'Pinalti tidak ditemukan.');
    }

    $user = null;

    if ($pinalti->laporan) {
        $user = User::find($pinalti->laporan->reported_id);
    } else {
        $user = User::find($pinalti->id); // Ambil langsung dari pinalti jika tidak ada laporan
    }

    if (!$user) {
        return redirect('/banding')->with('error', 'Pengguna terkait pinalti tidak ditemukan.');
    }
    $action = $request->input('action');

    switch ($pinalti->jenis_hukuman) {
        case 'suspend':
            if ($action === 'hapus') {
                // Hapus suspend dan semua peringatan yang terkait
                $user->status = 'aktif';
                $user->save();

                $banding->status = 'diterima';
                $banding->pinalti_id = 0;
                $banding->save();

                $pinalti->delete();
                $laporan = $pinalti->laporan;

                $laporan->status = 'selesai';
                $laporan->save();

                // Hapus semua hukuman peringatan yang terkait dengan user ini
                $laporanIds = Laporan::where('reported_id', $user->id)->pluck('id');
                Pinalti::whereIn('laporan_id', $laporanIds)
                    ->where('jenis_hukuman', 'peringatan')
                    ->delete();

                    Laporan::where('reported_id', $user->id)
                    ->where('status', 'peringatan')
                    ->update(['status' => 'selesai']);

                AdminLog::create([
                    'users_id' => Auth::id(),
                    'aktivitas' => 'Admin menerima aju banding dari user ' . $banding->user->name . ' dan menghapus pinalti suspend beserta semua peringatan.',
                ]);

                return redirect()->route('banding.index')->with('success', 'Banding diterima dan Suspend beserta semua peringatan berhasil dihapus.');
            } elseif ($action === 'kurangi') {
                // Kurangi durasi suspend tanpa menghapus pinalti
                $currentDurasi = $pinalti->durasi;
                $requestedDurasi = $request->input('durasi', 0);

                if ($requestedDurasi > $currentDurasi) {
                    return back()->with('error', 'Pengurangan durasi tidak boleh lebih dari durasi suspend saat ini.');
                }

                $pinalti->durasi = $currentDurasi - $requestedDurasi;
                $pinalti->end_date = now()->addDays($pinalti->durasi);
                $pinalti->save();

                $banding->status = 'diterima';
                $banding->save();

                AdminLog::create([
                    'users_id' => Auth::id(),
                    'aktivitas' => 'Admin menerima banding dari ' . $banding->user->name . ' dan mengurangi durasi suspend sebanyak ' . $requestedDurasi . ' hari.',
                ]);

                return back()->with('success', 'Durasi suspend berhasil diperbarui.');
            } else {
                return back()->with('error', 'Pilihan tidak valid untuk jenis hukuman suspend.');
            }

        case 'peringatan':
            $banding->status = 'diterima';
            $banding->save();

            $user->status = 'aktif';
            $user->save();

            // Menghapus pinalti peringatan
            $pinalti->delete();
            $laporan = $pinalti->laporan;

            $laporan->status = 'selesai';
            $laporan->save();

            AdminLog::create([
                'users_id' => Auth::id(),
                'aktivitas' => 'Admin menerima banding dari user ' . $banding->user->name . ' dan menghapus hukuman peringatan.',
            ]);

            return redirect()->route('banding.index')->with('success', 'Banding diterima dan hukuman peringatan berhasil dihapus.');

        case 'banned':
            $banding->status = 'diterima';
            $banding->save();

            if ($user->status === 'banned') {
                $user->status = 'aktif';
                $user->save();
            }

            $pinalti->delete();
            $laporan = $pinalti->laporan;

            $laporan->status = 'selesai';
            $laporan->save();

            // Hapus semua hukuman peringatan yang terkait dengan user ini
            $laporanIds = Laporan::where('reported_id', $user->id)->pluck('id');
            Pinalti::whereIn('laporan_id', $laporanIds)
            ->where('jenis_hukuman', 'peringatan')
            ->delete();

            Laporan::where('reported_id', $user->id)
                    ->where('status', 'peringatan')
                    ->update(['status' => 'selesai']);

            AdminLog::create([
                'users_id' => Auth::id(),
                'aktivitas' => 'Admin menerima banding dari user ' . $banding->user->name . ' dan menghapus hukuman banned beserta semua peringatan.',
            ]);

            return redirect()->route('banding.index')->with('success', 'Banding diterima dan hukuman banned beserta semua peringatan berhasil dihapus.');

        default:
            return redirect('/banding')->with('error', 'Jenis hukuman tidak dikenali.');
    }
}
}
