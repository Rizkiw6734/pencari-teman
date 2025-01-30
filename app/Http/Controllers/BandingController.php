<?php

namespace App\Http\Controllers;

use App\Models\Banding;
use App\Models\User;
use App\Models\Pinalti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    
        $bandings = $query->with(['user', 'pinalti'])->paginate(10);
    
        return view('banding.index', compact('bandings'));
    }    

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $pinaltis = Pinalti::whereHas('laporan', function ($query) use ($user) {
            $query->where('reported_id', $user->id);
        })->get();

        return view('banding.create', compact('user', 'pinaltis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pinalti_id' => 'required|exists:pinalti,id',
            'alasan_banding' => 'required|string|max:255',
        ], [
            'pinalti_id.required' => 'pinalti harus di isi.',
            'alasan_banding.required' => 'alasan banding harus di isi.',
            'alasan_banding.max' => 'alasan banding tidak bisa lebih dari 255 karakter.'
        ]);

        $existingBanding = Banding::where('users_id', auth()->id())
            ->where('pinalti_id', $request->pinalti_id)
            ->first();

        if ($existingBanding) {
            return redirect()->back()->with('error', 'Anda sudah mengajukan banding untuk pinalti ini.');
        }

        $pinalti = Pinalti::findOrFail($request->pinalti_id);

        Banding::create([
            'users_id' => auth()->id(),
            'pinalti_id' => $request->pinalti_id,
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
    
        $user = User::find($pinalti->laporan->reported_id);
    
        if (!$user) {
            return redirect('/banding')->with('error', 'Pengguna terkait pinalti tidak ditemukan.');
        }
    
        // Pastikan `action` diterima dari form
        $action = $request->input('action');
    
        switch ($pinalti->jenis_hukuman) {
            case 'suspend':
                if ($action === 'hapus') {
                    $user->status = 'aktif';
                    $user->save();
    
                    $banding->status = 'diterima';
                    $banding->save();
    
                    return redirect()->route('banding.index')->with('success', 'Banding diterima dan Suspend berhasil dihapus.');
                } elseif ($action === 'kurangi') {
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
    
                    return back()->with('success', 'Durasi suspend berhasil diperbarui.');
                } else {
                    return back()->with('error', 'Pilihan tidak valid untuk jenis hukuman suspend.');
                }
    
            case 'peringatan':
            case 'banned':
                $banding->status = 'diterima';
                $banding->save();
    
                $user->status = 'aktif';
                $user->save();
    
                return redirect()->route('banding.index')->with('success', 'Banding diterima dan hukuman berhasil dihapus.');
    
            default:
                return redirect('/banding')->with('error', 'Jenis hukuman tidak dikenali.');
        }
    }
}
