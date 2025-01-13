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
    public function index()
    {
        $bandings = Banding::with(['user', 'laporan'])->get();
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
            return redirect()->back()->with(['error', 'Anda sudah mengajukan banding untuk pinalti ini.']);
        }

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
}
