<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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

// Route::get('/', function () {
//     return view('index');
// })->name('beranda');

Route::get('/login', function () {
    return view('login');
})->name('login');

// Route::get('/dashboard-mahasiswa', function () {
//     return view('dashboard.dashboard-mahasiswa');
// })->name('dashboard-mahasiswa');

Route::get('/dashboard-mahasiswa', [DashboardController::class, 'dashboard_mahasiswa'])
    ->name('dashboard-mahasiswa');

// Route::get('/dashboard-mahasiswa', function () {
//     return view('dashboard.dashboard-mahasiswa');
// })->name('dashboard-mahasiswa');

Route::get('/dashboard-dokter', function () {
    return view('dashboard.dashboard-dokter');
})->name('dashboard-dokter');

Route::post('/login', [UserController::class, 'login_action'])
    ->name('login.action');

Route::get('/', [HomeController::class, 'beranda'])->name('beranda');

Route::get('/logout', [UserController::class, 'logout_action'])
    ->name('logout.action');