<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IuranController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JenisIuranController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KeringananController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PilihanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TagihanKeringananController;
use App\Http\Controllers\UserController;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('admin/login', [LoginController::class, 'admin_login'])->name('admin.login');
    Route::post('admin/do_log', [LoginController::class, 'do_log_admin'])->name('admin.do_log');
    Route::get('pengurus/login', [LoginController::class, 'pengurus_login'])->name('pengurus.login');
    Route::post('pengurus/do_log', [LoginController::class, 'do_log_pengurus'])->name('pengurus.do_log');
    Route::get('wali_murid/login', [LoginController::class, 'wali_murid_login'])->name('walmur.login');
    Route::get('wali_murid/registrasi', [LoginController::class, 'wali_murid_regis'])->name('walmur.regis');
    Route::post('wali_murid/do_regis', [LoginController::class, 'wali_murid_do_regis'])->name('walmur.do_regis');
    Route::post('wali_murid/do_log', [LoginController::class, 'do_log_wali_murid'])->name('walmur.do_log');
});

Route::middleware('admin')->name('admin.')->prefix('admin')->group(function () {
    Route::get('login/logout', [LoginController::class, 'logout'])->name('login.logout');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard_admin'])->name('index');
    });
    Route::resource('/periode', PeriodeController::class);
    Route::resource('/kamar', KamarController::class);
    Route::resource('/kegiatan', KegiatanController::class);
    Route::resource('/role', RoleController::class);
    Route::resource('/jenis_iuran', JenisIuranController::class);
    Route::resource('/pilihan', PilihanController::class);

    Route::resource('/iuran', IuranController::class);
    Route::resource('/keringanan', KeringananController::class);
    Route::resource('/siswa', SiswaController::class);
    Route::resource('/pendaftaran', PendaftaranController::class);
    Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
        Route::post('konfirmasi_keringanan', [PendaftaranController::class, 'konfirmasi_keringanan'])->name('konfirmasi_keringanan');
    });

    Route::resource('/pengguna', PenggunaController::class);
    Route::resource('/tagihan_keringanan', TagihanKeringananController::class);
    Route::resource('/user', UserController::class);
});

Route::middleware('pengurus')->name('pengurus.')->prefix('pengurus')->group(function () {
    Route::get('login/logout', [LoginController::class, 'logout'])->name('login.logout');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard_pengurus'])->name('index');
    });
});

Route::middleware('walmur')->name('walmur.')->prefix('wali_murid')->group(function () {
    Route::get('login/logout', [LoginController::class, 'logout'])->name('login.logout');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard_walmur'])->name('index');
    });
    Route::resource('/pendaftaran', PendaftaranController::class);
    Route::resource('/siswa', SiswaController::class);
    Route::resource('/tagihan', TagihanController::class);
    Route::prefix('tagihan')->name('tagihan.')->group(function () {
        Route::get('/bayar/{tagihan}', [TagihanController::class, 'bayar'])->name('bayar');
        Route::post('/bayar/upload_bayar/{tagihan}', [TagihanController::class, 'upload_bayar'])->name('upload_bayar');
    });
});
