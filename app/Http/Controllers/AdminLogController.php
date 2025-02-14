<?php

namespace App\Http\Controllers;

use App\Models\AdminLog;
use App\Models\Pinalti;
use App\Models\User;
use Illuminate\Http\Request;

class AdminLogController extends Controller
{
    // Menampilkan semua log aktivitas admin
    public function index(Request $request)
    {
        $query = AdminLog::query(); // Inisialisasi query
    
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
    
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('pinalti', function ($q) use ($search) {
                $q->where('jenis_hukuman', 'like', '%' . $search . '%'); 
            });            
        }
    
        $logs = $query->with(['user', 'pinalti'])->latest()->get();
    
        return view('Admin.log', compact('logs'));
    }    

    // Menambahkan log aktivitas baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'pinalti_id' => 'required|exists:pinaltis,id',
        ]);

        AdminLog::create([
            'user_id' => $request->user_id,
            'pinalti_id' => $request->pinalti_id,
        ]);

        return redirect()->back()->with('success', 'Log aktivitas berhasil ditambahkan.');
    }
}
