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
use App\Http\Controllers\Auth\AuthenticatedSessionController;


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
    Route::get('/homead', function () {
        return view('home');
    });
    //provinsi
    Route::get('/provinsi', [ProvinsiController::class, 'index'])->name('provinsi.index');
    Route::get('/provinsi/create', [ProvinsiController::class, 'create'])->name('provinsi.create');
    Route::post('/provinsi', [ProvinsiController::class, 'store'])->name('provinsi.store');
    Route::get('/provinsi/{id}/edit', [ProvinsiController::class, 'edit'])->name('provinsi.edit');
    Route::put('/provinsi/{id}', [ProvinsiController::class, 'update'])->name('provinsi.update');
    Route::delete('/provinsi/{id}', [ProvinsiController::class, 'destroy'])->name('provinsi.destroy');

    //kabupaten
    Route::get('/kabupaten', [KabupatenController::class, 'index'])->name('kabupaten.index');
    Route::get('/kabupaten/create', [KabupatenController::class, 'create'])->name('kabupaten.create');
    Route::post('/kabupaten', [KabupatenController::class, 'store'])->name('kabupaten.store');
    Route::get('/kabupaten/{id}/edit', [KabupatenController::class, 'edit'])->name('kabupaten.edit');
    Route::put('/kabupaten/{id}', [KabupatenController::class, 'update'])->name('kabupaten.update');
    Route::delete('/kabupaten/{id}', [KabupatenController::class, 'destroy'])->name('kabupaten.destroy');

    //kecamatan
    Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan.index');
    Route::get('/kecamatan/create', [KecamatanController::class, 'create'])->name('kecamatan.create');
    Route::post('/kecamatan', [KecamatanController::class, 'store'])->name('kecamatan.store');
    Route::get('/kecamatan/{id}/edit', [KecamatanController::class, 'edit'])->name('kecamatan.edit');
    Route::put('/kecamatan/{id}', [KecamatanController::class, 'update'])->name('kecamatan.update');
    Route::delete('/kecamatan/{id}', [KecamatanController::class, 'destroy'])->name('kecamatan.destroy');

    //desa
    Route::get('/desa', [DesaController::class, 'index'])->name('desa.index');
    Route::get('/desa/create', [DesaController::class, 'create'])->name('desa.create');
    Route::post('/desa', [DesaController::class, 'store'])->name('desa.store');
    Route::get('/desa/{id}/edit', [DesaController::class, 'edit'])->name('desa.edit');
    Route::put('/desa/{id}', [DesaController::class, 'update'])->name('desa.update');
    Route::delete('/desa/{id}', [DesaController::class, 'destroy'])->name('desa.destroy');

    //laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/laporan/{id}/edit', [LaporanController::class, 'edit'])->name('laporan.edit');
    Route::put('/laporan/{id}', [LaporanController::class, 'update'])->name('laporan.update');
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');

    Route::get('/pinalti', [PinaltiController::class, 'index'])->name('pinalti.index');
    Route::get('/pinalti/create', [PinaltiController::class, 'create'])->name('pinalti.create');
    Route::post('/pinalti', [PinaltiController::class, 'store'])->name('pinalti.store');
    Route::get('/pinalti/{id}/edit', [PinaltiController::class, 'edit'])->name('pinalti.edit');
    Route::put('/pinalti/{id}', [PinaltiController::class, 'update'])->name('pinalti.update');
    Route::delete('/pinalti/{id}', [PinaltiController::class, 'destroy'])->name('pinalti.destroy');

});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

