<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MatpelController;
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
        Route::get('/matpel', [MatpelController::class, 'index'])->name('admin.matpel');
        Route::get('/matpel_add', [MatpelController::class, 'add'])->name('admin.matpel_add');
        Route::post('/matpel_store', [MatpelController::class, 'store'])->name('admin.matpel_store');
        Route::get('/matpel_edit/{id}', [MatpelController::class, 'edit'])->name('admin.matpel_edit');
        Route::post('/matpel_update', [MatpelController::class, 'update'])->name('admin.matpel_update');
        Route::delete('/matpel_destroy', [MatpelController::class, 'destroy'])->name('admin.matpel_destroy');
    }
);
