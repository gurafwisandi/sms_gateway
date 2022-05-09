<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MatpelController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::group(
    [
        'prefix'     => 'login'
    ],
    function () {
        Route::post('/login', [LoginController::class, 'authenticate'])->name('login.proses');
        Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');
        Route::get('/register', [LoginController::class, 'register'])->name('login.register');
        Route::post('/post', [LoginController::class, 'store'])->name('login.store');
    }
);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::group(
    [
        'prefix'     => 'admin',
        'middleware'     => 'auth'
    ],
    function () {
        // sekolah
        Route::get('/sekolah', [SekolahController::class, 'index'])->name('admin.sekolah');
        Route::get('/sekolah_add', [SekolahController::class, 'add'])->name('admin.sekolah_add');
        Route::post('/sekolah_store', [SekolahController::class, 'store'])->name('admin.sekolah_store');
        Route::get('/sekolah_edit/{id}', [SekolahController::class, 'edit'])->name('admin.sekolah_edit');
        Route::post('/sekolah_update', [SekolahController::class, 'update'])->name('admin.sekolah_update');
        Route::delete('/sekolah_destroy', [SekolahController::class, 'destroy'])->name('admin.sekolah_destroy');
        // kelas
        Route::get('/kelas', [KelasController::class, 'index'])->name('admin.kelas');
        Route::get('/kelas_add', [KelasController::class, 'add'])->name('admin.kelas_add');
        Route::post('/kelas_store', [KelasController::class, 'store'])->name('admin.kelas_store');
        Route::get('/kelas_edit/{id}', [KelasController::class, 'edit'])->name('admin.kelas_edit');
        Route::post('/kelas_update', [KelasController::class, 'update'])->name('admin.kelas_update');
        Route::delete('/kelas_destroy', [KelasController::class, 'destroy'])->name('admin.kelas_destroy');
        // matpel
        Route::get('/matpel', [MatpelController::class, 'index'])->name('admin.matpel');
        Route::get('/matpel_add', [MatpelController::class, 'add'])->name('admin.matpel_add');
        Route::post('/matpel_store', [MatpelController::class, 'store'])->name('admin.matpel_store');
        Route::get('/matpel_edit/{id}', [MatpelController::class, 'edit'])->name('admin.matpel_edit');
        Route::post('/matpel_update', [MatpelController::class, 'update'])->name('admin.matpel_update');
        Route::delete('/matpel_destroy', [MatpelController::class, 'destroy'])->name('admin.matpel_destroy');
        // user
        Route::get('/user', [UserController::class, 'index'])->name('admin.user');
        Route::get('/user_add', [UserController::class, 'add'])->name('admin.user_add');
        Route::post('/user_store', [UserController::class, 'store'])->name('admin.user_store');
        Route::get('/user_edit/{id}', [UserController::class, 'edit'])->name('admin.user_edit');
        Route::post('/user_update', [UserController::class, 'update'])->name('admin.user_update');
        Route::delete('/user_destroy', [UserController::class, 'destroy'])->name('admin.user_destroy');
        // profile
        Route::get('/user_profile/{id}', [UserController::class, 'profile'])->name('admin.user_profile');
        Route::post('/user_update_profile', [UserController::class, 'update_profile'])->name('admin.user_update_profile');
        // siswa
        Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa');
        Route::get('/siswa_add', [SiswaController::class, 'add'])->name('admin.siswa_add');
        Route::post('/siswa_store', [SiswaController::class, 'store'])->name('admin.siswa_store');
        Route::get('/siswa_edit/{id}', [SiswaController::class, 'edit'])->name('admin.siswa_edit');
        Route::post('/siswa_update', [SiswaController::class, 'update'])->name('admin.siswa_update');
        Route::get('/siswa_view/{id}', [SiswaController::class, 'view'])->name('admin.siswa_view');
        Route::delete('/siswa_destroy', [SiswaController::class, 'destroy'])->name('admin.siswa_destroy');
        // guru
        Route::get('/guru', [GuruController::class, 'index'])->name('admin.guru');
        Route::get('/guru_add', [GuruController::class, 'add'])->name('admin.guru_add');
        Route::post('/guru_store', [GuruController::class, 'store'])->name('admin.guru_store');
        Route::get('/guru_edit/{id}', [GuruController::class, 'edit'])->name('admin.guru_edit');
        Route::post('/guru_update', [GuruController::class, 'update'])->name('admin.guru_update');
        Route::get('/guru_view/{id}', [GuruController::class, 'view'])->name('admin.guru_view');
        Route::delete('/guru_destroy', [GuruController::class, 'destroy'])->name('admin.guru_destroy');
        // jadwal
        Route::get('/jadwal', [JadwalController::class, 'index'])->name('admin.jadwal');
        Route::get('/jadwal_add', [JadwalController::class, 'add'])->name('admin.jadwal_add');
        Route::post('/jadwal_store', [JadwalController::class, 'store'])->name('admin.jadwal_store');
        Route::get('/jadwal_edit/{id}', [JadwalController::class, 'edit'])->name('admin.jadwal_edit');
        Route::post('/jadwal_update', [JadwalController::class, 'update'])->name('admin.jadwal_update');
        Route::delete('/jadwal_destroy', [JadwalController::class, 'destroy'])->name('admin.jadwal_destroy');
        // absensi
        Route::get('/absensi', [AbsensiController::class, 'index'])->name('admin.absensi');
        Route::get('/history_absensi/{id}', [AbsensiController::class, 'history_absensi'])->name('admin.history_absensi');
        Route::get('/absensi_siswa/{id}', [AbsensiController::class, 'absensi_siswa'])->name('admin.absensi_siswa');
        // Route::get('/absensi_add', [AbsensiController::class, 'add'])->name('admin.absensi_add');
        // Route::post('/absensi_store', [AbsensiController::class, 'store'])->name('admin.absensi_store');
        // Route::get('/absensi_edit/{id}', [AbsensiController::class, 'edit'])->name('admin.absensi_edit');
        // Route::post('/absensi_update', [AbsensiController::class, 'update'])->name('admin.absensi_update');
        // Route::get('/absensi_view/{id}', [AbsensiController::class, 'view'])->name('admin.absensi_view');
        // Route::delete('/absensi_destroy', [AbsensiController::class, 'destroy'])->name('admin.absensi_destroy');
    }
);
