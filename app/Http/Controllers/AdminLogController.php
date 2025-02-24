<?php

namespace App\Http\Controllers;

use App\Models\AdminLog;
use App\Models\Pinalti;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\notifikasi;

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
            })->orWhere('aktivitas', 'like', '%' . $search . '%');
        }


        $logs = $query->with(['user'])->latest()->get();
        $notifications = notifikasi::where('user_id', auth()->id())
        ->where('status', 'unread')
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

        $notifikasis = notifikasi::whereHas('user', function ($query) {
            $query->whereHas('roles', function ($roleQuery) {
                $roleQuery->where('name', 'Admin');
            });
        })->with(['user', 'laporan'])->orderBy('created_at', 'desc')->get();


        return view('Admin.log', compact('logs','notifications', 'notifikasis'));
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
