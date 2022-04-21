<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
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

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
