<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blokir;

class PengaturanController extends Controller
{
    public function daftar2Blokir()
    {
        // Ambil data blokir berdasarkan pengguna yang sedang login
        $blokirans = Blokir::where('users_id', auth()->id())->get();

        // Menghitung jumlah pengguna yang diblokir
        $jumlahBlokir = $blokirans->count();


        // Mengirim data blokiran dan jumlah blokir ke tampilan
        return view('user.pengaturan', compact('jumlahBlokir'));
    }
}
