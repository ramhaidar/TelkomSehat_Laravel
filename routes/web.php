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

// --- Mahasiswa -- //

Route::get(
    '/dashboard-mahasiswa',
    [DashboardController::class, 'dashboard_mahasiswa']
)->name('dashboard-mahasiswa');

Route::get(
    '/dashboard-mahasiswa-reservasi',
    [DashboardController::class, 'dashboard_mahasiswa_reservasi']
)->name('dashboard-mahasiswa-reservasi');

Route::post(
    '/dashboard-mahasiswa-reservasi',
    [DashboardController::class, 'dashboard_mahasiswa_reservasi_action']
)->name('dashboard.mahasiswa.reservasi.action');

Route::get(
    '/dashboard-mahasiswa-konsultasi',
    [DashboardController::class, 'dashboard_mahasiswa_konsultasi']
)->name('dashboard-mahasiswa-konsultasi');

Route::post(
    '/dashboard-mahasiswa-konsultasi',
    [DashboardController::class, 'dashboard_mahasiswa_konsultasi_action']
)->name('dashboard.mahasiswa.konsultasi.action');

Route::get(
    '/dashboard-mahasiswa-test',
    [DashboardController::class, 'dashboard_mahasiswa_test']
)->name('dashboard-mahasiswa-test');

// --- Dokter -- //

Route::get(
    '/dashboard-dokter',
    [DashboardController::class, 'dashboard_dokter']
)->name('dashboard-dokter');

Route::get(
    '/dashboard-dokter-reservasi',
    [DashboardController::class, 'dashboard_dokter_reservasi']
)->name('dashboard-dokter-reservasi');

Route::post(
    '/dashboard-dokter-reservasi',
    [DashboardController::class, 'dashboard_dokter_reservasi_action']
)->name('dashboard.dokter.reservasi.action');

Route::get(
    '/dashboard-dokter-konsultasi',
    [DashboardController::class, 'dashboard_dokter_konsultasi']
)->name('dashboard-dokter-konsultasi');

Route::post(
    '/dashboard-dokter-konsultasi',
    [DashboardController::class, 'dashboard_dokter_konsultasi_action']
)->name('dashboard.dokter.konsultasi.action');

Route::get(
    '/dashboard-dokter-test',
    [DashboardController::class, 'dashboard_dokter_test']
)->name('dashboard-dokter-test');

// --- Login -- //

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post(
    '/login',
    [UserController::class, 'login_action']
)->name('login.action');

// --- Beranda -- //

Route::get(
    '/',
    [HomeController::class, 'beranda']
)->name('beranda');

// -- Logout -- //

Route::get(
    '/logout',
    [UserController::class, 'logout_action']
)->name('logout.action');