<?php

use App\Http\Controllers\KabupatenController;
use RealRashid\SweetAlert\ToSweetAlert;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PinaltiController;
use App\Http\Controllers\BandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\JarakController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\UserStatusController;


use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\CheckExpiredSuspension;
use App\Http\Middleware\CheckStatusUser;
use App\Jobs\CheckExpiredSuspensionJob;

// Memanggil job secara manual
CheckExpiredSuspensionJob::dispatch();

require __DIR__.'/auth.php';
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware([ToSweetAlert::class])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

//ADMIN
Route::middleware(['auth', RoleMiddleware::class . ':Admin'])->group(function () {

    //dasboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
    Route::post('/laporan/{id}/tolak', [LaporanController::class, 'tolakLaporan'])->name('laporan.tolak');

    //pinalti
    Route::resource('pinalti', PinaltiController::class);

    //Banding
    Route::resource('banding', BandingController::class);
    Route::post('/banding/{id}/tolak', [BandingController::class, 'tolakBanding'])->name('banding.tolak');
    Route::post('/banding/{id}/terima', 'BandingController@terimaBanding')->name('banding.terima');


    //pengguna
    Route::get('/admin/users', [PenggunaController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users/{id}/block', [PenggunaController::class, 'block'])->name('admin.users.block');
    Route::get('/users/banned',[PenggunaController::class, 'banned'])->name('admin.users.banned');
    Route::post('/users/{id}/unblock', [PenggunaController::class, 'unblock'])->name('admin.users.unblock');
});

    //profil (semua bisa akses tetapi harus login)
    Route::middleware('auth')->group(function () {
        Route::put('/profile/update-picture', [ProfileController::class, 'updatePicture'])->name('profile.update-picture');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    //PENGGUNA
    Route::middleware(['auth', CheckStatusUser::class, CheckExpiredSuspension::class])->group(function () {
    Route::delete('/admin/users/{id}', [PenggunaController::class, 'destroy'])->name('admin.users.destroy');

        Route::get('/home', function () {
            return view('user.home');
        })->name('user.home');

        // Rute untuk halaman banned
        Route::get('/banned', [UserStatusController::class, 'bannedPage'])->name('user.banned');

        // Rute untuk halaman suspend
        Route::get('/suspend', [UserStatusController::class, 'suspendPage'])->name('user.suspend');
        Route::resource('banding', BandingController::class);

    });

    Route::get('/hitung-jarak', [JarakController::class, 'hitungJarak']);

