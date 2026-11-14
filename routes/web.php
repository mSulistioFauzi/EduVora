
<?php

use App\Http\Controllers\C_AdminPengajuanBantuan;
use App\Http\Controllers\C_AdminProgramMengajar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_AuthController;
use App\Http\Controllers\C_PengajuanBantuan;
use App\Http\Controllers\C_ProfilMitra;
use App\Http\Controllers\C_ProfilRelawan;
use App\Http\Controllers\C_RelawanProgramMengajar;
use App\Http\Controllers\C_VerifikasiAkun;

// Halaman autentikasi
Route::middleware('guest')->group(function () {
    Route::get('/register', [C_AuthController::class, 'tampilRegis'])->name('regis');

    Route::post('/register', [C_AuthController::class, 'registrasi'])->name('register.proses');

    Route::get('/login', [C_AuthController::class, 'tampilLogin'])->name('login');

    Route::post('/login', [C_AuthController::class, 'login'])->name('login.proses');
});

// Logout
Route::post('/logout', [C_AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Dashboard berdasarkan peran
Route::middleware(['auth', 'peran:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.admin.dashboard');
    })->name('dashboard');
    Route::get('/verifikasi', [C_VerifikasiAkun::class, 'index'])->name('verifikasi.index');
    Route::get('/verifikasi/{id}', [C_VerifikasiAkun::class, 'detail'])->name('verifikasi.detail');
    Route::post('/verifikasi/{id}', [C_VerifikasiAkun::class, 'perbaruiStatus'])->name('verifikasi.perbarui');

    Route::get('/pengajuan', [C_AdminPengajuanBantuan::class, 'index'])->name('pengajuan.index');
    Route::get('/pengajuan/{id}', [C_AdminPengajuanBantuan::class, 'detail'])->name('pengajuan.detail');
    Route::post('/pengajuan/{id}', [C_AdminPengajuanBantuan::class, 'perbaruiStatus'])->name('pengajuan.perbarui');

    Route::resource('/program', C_AdminProgramMengajar::class)->only(['index', 'create', 'store', 'show']);;
});

Route::middleware(['auth', 'peran:relawan'])->prefix('relawan')->name('relawan.')->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.relawan.dashboard');
    })->name('dashboard');
    Route::get('/profil', [C_ProfilRelawan::class, 'index'])->name('profil');
    Route::post('/profil', [C_ProfilRelawan::class, 'simpan'])->name('profil.simpan');

    Route::resource('/program', C_RelawanProgramMengajar::class)->only(['index', 'show']);
});

Route::middleware(['auth', 'peran:mitra'])->prefix('mitra')->name('mitra.')->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.mitra.dashboard');
    })->name('dashboard');
    Route::get('/profil', [C_ProfilMitra::class, 'index'])->name('profil');
    Route::post('/profil', [C_ProfilMitra::class, 'simpan'])->name('profil.simpan');

    Route::get('/pengajuan', [C_PengajuanBantuan::class, 'index'])->name('pengajuan.index');
    Route::get('/pengajuan/create', [C_PengajuanBantuan::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan', [C_PengajuanBantuan::class, 'store'])->name('pengajuan.store');
    Route::get('/pengajuan/{id}', [C_PengajuanBantuan::class, 'detail'])->name('pengajuan.detail');
});
