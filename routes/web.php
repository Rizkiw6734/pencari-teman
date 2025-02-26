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
use App\Http\Controllers\ChatController;
use App\Http\Controllers\JelajahiControllerController;
use App\Http\Controllers\ActiveUserController;
use App\Http\Controllers\AdminLogController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\CheckExpiredSuspension;
use App\Http\Middleware\CheckStatusUser;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\BlokirController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\UserLogController;
use App\Http\Controllers\RatingController;
use App\Jobs\CheckExpiredSuspensionJob;
use App\Http\Controllers\LocationController;
use App\Models\Chat;

// Memanggil job secara manual
// CheckExpiredSuspensionJob::dispatch();

require __DIR__.'/auth.php';

Route::middleware([ToSweetAlert::class])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
});

//ADMIN
Route::middleware(['auth', RoleMiddleware::class . ':Admin', CheckExpiredSuspension::class])->group(function () {

    //dasboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //provinsi
    Route::get('/lokasi', [ProvinsiController::class, 'index'])->name('lokasi.index');
    Route::get('/find-nearby', [ProvinsiController::class, 'findNearby'])->name('lokasi.index');
    Route::get('/user-statistics', [DashboardController::class, 'getUserStatistics']);


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
    Route::post('/users/{id}/enable', [PenggunaController::class, 'enable'])->name('admin.users.enable');
    Route::get('/users/banned',[PenggunaController::class, 'banned'])->name('admin.users.banned');
    Route::get('/users/suspend',[PenggunaController::class, 'suspend'])->name('admin.users.suspend');
    Route::post('/users/{id}/unblock', [PenggunaController::class, 'unblock'])->name('admin.users.unblock');
    //log
    Route::get('/admin', [AdminLogController::class, 'index'])->name('admin.log');

    Route::get('/provinces', [PenggunaController::class, 'getProvinces']);
    Route::get('/regencies/{province_id}', [PenggunaController::class, 'getRegencies']);
    Route::get('/users/{kabupaten_id}', [PenggunaController::class, 'getUsers']);
    Route::get('/banned/{kabupaten_id}', [PenggunaController::class, 'getUsersBanned']);
    Route::get('/suspend/{kabupaten_id}', [PenggunaController::class, 'getUsersSuspend']);
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
    // USER ROUTES (with additional status checks)
    Route::middleware(['auth', CheckStatusUser::class, CheckExpiredSuspension::class])->group(function () {
    Route::delete('/admin/users/{id}', [PenggunaController::class, 'destroy'])->name('admin.users.destroy');

    // User Home Page
    Route::get('/home', [ChatController::class, 'index'])->name('user.home');
    Route::get('/latest-chats', [ChatController::class, 'latestChatsJson']);
    Route::get('/logs', [UserLogController::class, 'index'])->name('user.logs');
    Route::get('/notifikasi', [ChatController::class, 'notif'])->name('user.notifikasi');

    // Banned Page
    Route::get('/banned', [UserStatusController::class, 'bannedPage'])->name('user.banned');

    // Profile User Routes
    Route::get('/profile-user', [ProfileUserController::class, 'profile'])->name('profile.index');
    Route::get('/profile-user/edit', [ProfileUserController::class, 'edit'])->name('user.edit');
    Route::put('/profile-user', [ProfileUserController::class, 'update'])->name('user.update');
    Route::put('/profile/update-photo', [ProfileUserController::class, 'updatePhoto'])->name('profile.update-photo');
    Route::put('/user/{id}/update-address', [ProfileUserController::class, 'updateAddress'])->name('user.update.address');
    Route::get('/profile/{id}', [ProfileUserController::class, 'show'])->name('profile.show');

    // Ajax Lokasi
    Route::get('/get-regencies', [ProfileUserController::class, 'getRegencies'])->name('getRegencies');
    Route::get('/get-districts', [ProfileUserController::class, 'getDistricts'])->name('getDistricts');
    Route::get('/get-villages', [ProfileUserController::class, 'getVillages'])->name('getVillages');

    Route::post('/update-activity', [ActiveUserController::class, 'updateActivity']);


    // Rute untuk halaman suspend
    Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/banding/create', [BandingController::class, 'create'])->name('banding.create');
    Route::post('/banding', [BandingController::class, 'store'])->name('banding.store');
    Route::get('/blokiran', [BlokirController::class, 'daftarBlokir'])->name('blokiran');
    Route::delete('/buka-blokir/{user}', [BlokirController::class, 'bukaBlokir']);

    Route::post('/blokir/{user}', [BlokirController::class, 'blokir'])->name('blokir');
    Route::delete('/unblokir/{user}', [BlokirController::class, 'unblock'])->name('unblokir');
    Route::get('/pengaturan', [PengaturanController::class, 'daftar2Blokir'])->name('user.pengaturan');
    Route::post('/rating', [RatingController::class, 'store'])->name('rating.store');

    Route::prefix('jelajahi')->group(function () {
        Route::get('/', [JelajahiController::class, 'index'])->name('jelajahi.kota');
        Route::get('/sekitar', [JelajahiController::class, 'penggunaSekitar'])->name('jelajahi.sekitar');
        Route::get('/provinsi', [JelajahiController::class, 'getProvinsi'])->name('jelajahi.provinsi');
        Route::get('/provinsi/{provinsi_id}', [JelajahiController::class, 'getKotaByProvinsi'])->name('jelajahi');
        Route::get('/pengguna-by-kota/{kabupaten_id}', [JelajahiController::class, 'penggunaByKota'])->name('jelajahi.pengguna');
        Route::get('/cari-pengguna', [JelajahiController::class, 'cariPengguna']);
    });
    Route::post('/follow/{user}', [FollowerController::class, 'follow'])->name('follow');
    Route::delete('/unfollow/{user}', [FollowerController::class, 'unfollow'])->name('unfollow');
    Route::get('/followers/{user}', [FollowerController::class, 'followers'])->name('followers.list');
    Route::get('/following/{user}', [FollowerController::class, 'following'])->name('following.list');
    Route::post('/hapus-pengikut', [FollowerController::class, 'hapusPengikut'])->middleware('auth');
    Route::get('/show-follow/{userId}', [ProfileUserController::class, 'showFollow'])->name('showfollow');
    // Add the update-location route here
    Route::middleware(['auth'])->post('/update-location', [ProfileUserController::class, 'updateLocation']);
    Route::get('/active-users', [ActiveUserController::class, 'index']);
    Route::post('/update-chat-status', [ChatController::class, 'updateStatus']);
    Route::get('/user/status/{id}', [ChatController::class, 'getUserStatus']);
    Route::middleware('auth')->get('/messages/{user}/{penerima_id}', [ChatController::class, 'getMessages']);
    Route::post('/send-message', [ChatController::class, 'sendMessage']);
    Route::get('/messages/status/{userId}/{penerimaId}', [ChatController::class, 'getStatus']);
    Route::post('/notifikasi/read/{id}', [NotifikasiController::class, 'markAsRead'])->middleware('auth');
    Route::post('/notifikasi/{id}/read', [NotifikasiController::class, 'Read'])->middleware('auth');
    // Suspend Page
    Route::get('/suspend', [UserStatusController::class, 'suspendPage'])->name('user.suspend');
    });
    Route::get('/ratings', [RatingController::class, 'index'])->name('ratings.index');

    Route::get('/hitung-jarak', [JarakController::class, 'hitungJarak']);


