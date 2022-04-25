<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MatpelController;
use App\Http\Controllers\SekolahController;
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
    }
);
