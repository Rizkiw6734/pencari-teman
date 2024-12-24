<?php

use App\Http\Controllers\KabupatenController;
use RealRashid\SweetAlert\ToSweetAlert;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PinaltiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\JarakController;

require __DIR__.'/auth.php';
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware([ToSweetAlert::class])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::middleware(['auth', RoleMiddleware::class . ':Admin'])->group(function () {

    //dasboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //provinsi
    Route::get('/lokasi', [ProvinsiController::class, 'index'])->name('lokasi.index');
    Route::get('/find-nearby', [ProvinsiController::class, 'findNearby'])->name('lokasi.index');


    //kabupaten
    Route::resource('kabupaten', KabupatenController::class);

    //kecamatan
    Route::resource('kecamatan', KecamatanController::class);

    //desa
    Route::resource('desa', DesaController::class);

    //laporan
    Route::resource('laporan', LaporanController::class);
    Route::post('laporan/{id}/hukuman', [LaporanController::class, 'berikanHukuman'])->name('laporan.hukuman');

    //pinalti
    Route::resource('pinalti', PinaltiController::class);

    //hitung jarak
    Route::get('/hitung-jarak', [JarakController::class, 'hitungJarak']);
});

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
