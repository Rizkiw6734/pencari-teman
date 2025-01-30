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
use App\Http\Controllers\JelajahiController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\UserStatusController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\JelajahiControllerController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\CheckExpiredSuspension;
use App\Http\Middleware\CheckStatusUser;
use App\Jobs\CheckExpiredSuspensionJob;

// Memanggil job secara manual
// CheckExpiredSuspensionJob::dispatch();

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
    Route::post('/banding/{id}/terima', [BandingController::class, 'terimaBanding'])->name('banding.terima');
    Route::post('/banding/{id}/tolak', [BandingController::class, 'tolakBanding'])->name('banding.tolak');

    //pengguna
    Route::get('/admin/users', [PenggunaController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users/{id}/block', [PenggunaController::class, 'block'])->name('admin.users.block');
    Route::post('/admin/users/{id}/disable', [PenggunaController::class, 'disable'])->name('admin.users.disable');
    Route::post('/admin/users/{id}/enable', [PenggunaController::class, 'enable'])->name('admin.users.enable');
    Route::get('/users/banned',[PenggunaController::class, 'banned'])->name('admin.users.banned');
    Route::get('/users/suspend',[PenggunaController::class, 'suspend'])->name('admin.users.suspend');
    Route::post('/users/{id}/unblock', [PenggunaController::class, 'unblock'])->name('admin.users.unblock');

    Route::get('/locations/provinsi', [PenggunaController::class, 'getProvinsi']);
    Route::get('/locations/kabupaten', [PenggunaController::class, 'getKabupaten']);
    Route::get('/locations/kecamatan', [PenggunaController::class, 'getKecamatan']);
    Route::get('/locations/desa', [PenggunaController::class, 'getDesa']);
});

    //profil (semua bisa akses tetapi harus login)
    Route::middleware('auth')->group(function () {
        Route::get('/user/profile', [ProfileController::class, 'show'])->name('user.profile');
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

        Route::get('/profile-user', [ProfileUserController::class, 'profile'])->name('user.profile');
        Route::get('/profile-user/edit', [ProfileUserController::class, 'edit'])->name('user.edit');
        Route::put('/profile-user', [ProfileUserController::class, 'update'])->name('user.update');
        Route::put('/profile/update-foto-profile', [ProfileUserController::class, 'updateFotoProfile'])->name('user.profile.updateFotoProfile');

        // Rute untuk halaman suspend
        Route::get('/suspend', [UserStatusController::class, 'suspendPage'])->name('user.suspend');
        Route::resource('banding', BandingController::class);
        Route::resource('jelajahi', JelajahiController::class);

    });

    Route::get('/hitung-jarak', [JarakController::class, 'hitungJarak']);

