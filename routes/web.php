<?php

use App\Models\Penjemputan;
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
    '/dashboard-mahasiswa-penjemputan',
    [DashboardController::class, 'dashboard_mahasiswa_penjemputan']
)->name('dashboard-mahasiswa-penjemputan');

Route::post(
    '/dashboard-mahasiswa-penjemputan',
    [DashboardController::class, 'dashboard_mahasiswa_penjemputan_action']
)->name('dashboard.mahasiswa.penjemputan.action');

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

// -- Paramedis -- //

Route::get(
    '/dashboard-paramedis',
    [DashboardController::class, 'dashboard_paramedis']
)->name('dashboard-paramedis');

Route::get(
    '/dashboard-paramedis-penjemputan',
    [DashboardController::class, 'dashboard_paramedis_penjemputan']
)->name('dashboard-paramedis-penjemputan');

Route::post(
    '/dashboard-paramedis-penjemputan',
    [DashboardController::class, 'dashboard_paramedis_penjemputan_action']
)->name('dashboard.paramedis.penjemputan.action');

// --- Login -- //

Route::get(
    '/login',
    [UserController::class, 'login']
)->name('login');

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

// -- Ajax Test -- //
Route::get('/data-penjemputan', function () {
    // $data = Penjemputan::where('id', $id)->first();
    $data = Penjemputan::get()->all();
    return response()->json($data);
});

Route::get('/data/{id}', function ($id) {
    $data = Penjemputan::where('id', $id)->get();
    if (!isset($data)) {
        return md5("Kosong");
    }
    return md5($data);
});