<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Public Routes (Tanpa Login)
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect('/login');
});

// ✅ Route pendaftaran akun (harus bisa diakses tanpa login)
Route::get('/daftar-akun', [PendaftaranController::class, 'showForm'])->name('daftar-akun');
Route::post('/daftar-akun', [PendaftaranController::class, 'storeAkun'])->name('daftar-akun.store');

/*
|--------------------------------------------------------------------------
| Route Untuk Semua User yang Sudah Login
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Route Khusus Admin (Bagian Akademik)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/cek-nilai-admin', [NilaiController::class, 'cekNilaiAdmin'])->name('nilai.cek.admin');
    Route::resource('pendaftaran', PendaftaranController::class);
    Route::resource('dosen', DosenController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
});

/*
|--------------------------------------------------------------------------
| Route Khusus Admin dan Dosen
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,dosen'])->group(function () {
    Route::resource('nilai', NilaiController::class)->except(['show']);
});

/*
|--------------------------------------------------------------------------
| Route Khusus Mahasiswa
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/cek-nilai', [NilaiController::class, 'cekNilaiMahasiswa'])->name('nilai.cek');
});
