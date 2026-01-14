<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LulusanController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KritikSaranController;

/*
|--------------------------------------------------------------------------
| PUBLIC - LANDING
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'landing'])->name('landing');

/*
|--------------------------------------------------------------------------
| PUBLIC - AGENDA / KEGIATAN
|--------------------------------------------------------------------------
*/
Route::prefix('agenda')->name('agenda.')->group(function () {
    Route::get('/', [KegiatanController::class, 'agenda'])->name('index');
    Route::get('/{kegiatan}', [KegiatanController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| PUBLIC - GALERI
|--------------------------------------------------------------------------
*/
Route::prefix('galeri')->name('galeri.')->group(function () {
    Route::get('/', [GaleriController::class, 'indexPublic'])->name('index');
    Route::get('/{galeri}', [GaleriController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| PUBLIC - INFORMASI SEKOLAH
|--------------------------------------------------------------------------
*/
Route::get('/daftar-guru', [GuruController::class, 'daftar'])->name('guru.daftar');
Route::get('/daftar-siswa', [SiswaController::class, 'daftar'])->name('siswa.daftar');
Route::get('/lulusan', [LulusanController::class, 'index']);
Route::get('/profil', fn () => view('g'))->name('profil');
// PUBLIC
Route::get('/kritik-saran', [KritikSaranController::class, 'form'])->name('kritik.form');
Route::post('/kritik-saran', [KritikSaranController::class, 'store'])->name('kritik.store');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| ADMIN PANEL (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', fn () => view('admin.dashboard'))
            ->name('dashboard');

        // CRUD ADMIN (TANPA SHOW)
        Route::resource('galeri', GaleriController::class)->except('show');
        Route::resource('kegiatan', KegiatanController::class)->except('show');
        Route::resource('guru', GuruController::class)->except('show');
        Route::resource('siswa', SiswaController::class)->except('show');
        Route::resource('lulusan', LulusanController::class)->except('show');
    });
Route::get('/dashboard/bi', [App\Http\Controllers\DashboardController::class, 'index'])
    ->name('dashboard.bi')
    ->middleware('auth');  // atau middleware admin/kepsek