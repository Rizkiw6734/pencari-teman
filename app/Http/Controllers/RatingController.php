<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string|max:200',
        ]);

        // Menentukan status berdasarkan rating
        $status = match (true) {
            $request->rating <= 2 => 'negatif',
            $request->rating == 3 => 'netral',
            default => 'positif',
        };

        // Menyimpan data rating ke database
        Rating::create([
            'user_id' => Auth::id(), // ID pengguna yang sedang login
            'rating' => $request->rating, // Nilai rating
            'ulasan' => $request->ulasan, // Ulasan pengguna
            'status' => $status,
        ]);

        // Redirect kembali dengan pesan sukses
        return response()->json(['success' => true]);
    }

    public function index()
    {
        // Ambil daftar rating dengan paginasi 6 per halaman
        $ratings = Rating::with('user')->latest()->paginate(6);

        return view('coment', compact('ratings'));
    }
}
