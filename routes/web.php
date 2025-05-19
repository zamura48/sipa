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
use App\Http\Controllers\LaporanAbsensi;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PilihanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TagihanKeringananController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaliMuridController;
use App\Models\Tagihan;
use App\Models\WaliMurid;
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
Route::get('/login', [LandingController::class, 'login'])->name('landing.login');

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
    Route::get('profil', [ProfilController::class, 'index'])->name('profil.index');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard_admin'])->name('index');
    });
    Route::resource('/periode', PeriodeController::class);
    Route::resource('/kamar', KamarController::class);
    Route::resource('/kegiatan', KegiatanController::class);
    Route::resource('/role', RoleController::class);
    Route::resource('/jenis_iuran', JenisIuranController::class);
    Route::resource('/pilihan', PilihanController::class);
    Route::resource('/absensi', AbsensiController::class);
    Route::prefix('absensi')->name('absensi.')->group(function () {
        Route::get('presensi/{jadwal}', [AbsensiController::class, 'presensi'])->name('presensi');
        Route::post('presensi/save/{jadwal}', [AbsensiController::class, 'presensi_save'])->name('presensi.save');
    });

    Route::resource('/iuran', IuranController::class);
    Route::resource('/jadwal', JadwalController::class);
    Route::prefix('jadwal')->name('jadwal.')->group(function () {
        Route::get('siswa/{jadwal}', [JadwalController::class, 'siswa'])->name('siswa');
        Route::post('siswa/store_siswa_jadwal/{jadwal}', [JadwalController::class, 'store_siswa_jadwal'])->name('store_siswa_jadwal');
        Route::post('siswa/delete_siswa_jadwal/{jadwal}', [JadwalController::class, 'delete_siswa_jadwal'])->name('delete_siswa_jadwal');
    });
    Route::resource('/keringanan', KeringananController::class);
    Route::resource('/siswa', SiswaController::class);
    Route::resource('/pendaftaran', PendaftaranController::class);
    Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
        Route::post('konfirmasi_keringanan', [PendaftaranController::class, 'konfirmasi_keringanan'])->name('konfirmasi_keringanan');
    });

    Route::resource('/sekolah', SekolahController::class);
    Route::resource('/wali_murid', WaliMuridController::class);
    Route::resource('/pengurus', PengurusController::class);
    Route::resource('/tagihan', TagihanController::class);
    Route::resource('/penghuni', PenghuniController::class);
    Route::prefix('penghuni')->name('penghuni.')->group(function () {
        Route::post('/tambah_penghuni/{kamar}', [PenghuniController::class, 'tambah_penghuni'])->name('tambah_penghuni');
        Route::post('/delete_penghuni/{kamar}', [PenghuniController::class, 'delete_penghuni'])->name('delete_penghuni');
    });
    Route::prefix('tagihan')->name('tagihan.')->group(function () {
        Route::post('/bayar/konfirmasi_pembayaran/{tagihan}', [TagihanController::class, 'konfirmasi_pembayaran'])->name('konfirmasi_pembayaran');
    });
    Route::resource('/tagihan_keringanan', TagihanKeringananController::class);
    Route::resource('/user', UserController::class);

    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('absensi', [LaporanAbsensi::class, 'index'])->name('absensi.index');
    });
});

Route::middleware('pengurus')->name('pengurus.')->prefix('pengurus')->group(function () {
    Route::get('login/logout', [LoginController::class, 'logout'])->name('login.logout');
    Route::get('profil', [ProfilController::class, 'index'])->name('profil.index');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard_pengurus'])->name('index');
    });
    Route::resource('/pendaftaran', PendaftaranController::class);
    Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
        Route::post('konfirmasi_keringanan', [PendaftaranController::class, 'konfirmasi_keringanan'])->name('konfirmasi_keringanan');
    });
    Route::resource('/penghuni', PenghuniController::class);
    Route::prefix('penghuni')->name('penghuni.')->group(function () {
        Route::post('/tambah_penghuni/{kamar}', [PenghuniController::class, 'tambah_penghuni'])->name('tambah_penghuni');
        Route::post('/delete_penghuni/{kamar}', [PenghuniController::class, 'delete_penghuni'])->name('delete_penghuni');
    });
    Route::resource('/absensi', AbsensiController::class);
    Route::prefix('absensi')->name('absensi.')->group(function () {
        Route::get('presensi/{jadwal}', [AbsensiController::class, 'presensi'])->name('presensi');
        Route::post('presensi/save/{jadwal}', [AbsensiController::class, 'presensi_save'])->name('presensi.save');
    });
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('absensi', [LaporanAbsensi::class, 'index'])->name('absensi.index');
    });
});

Route::middleware('walmur')->name('walmur.')->prefix('wali_murid')->group(function () {
    Route::get('login/logout', [LoginController::class, 'logout'])->name('login.logout');
    Route::get('profil', [ProfilController::class, 'index'])->name('profil.index');

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
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('absensi', [LaporanAbsensi::class, 'index'])->name('absensi.index');
    });
});
