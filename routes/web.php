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
    '/dashboard-pasien',
    [DashboardController::class, 'dashboard_pasien']
)->name('dashboard-pasien');

Route::get(
    '/dashboard-pasien-reservasi',
    [DashboardController::class, 'dashboard_pasien_reservasi']
)->name('dashboard-pasien-reservasi');

Route::post(
    '/dashboard-pasien-reservasi',
    [DashboardController::class, 'dashboard_pasien_reservasi_action']
)->name('dashboard.pasien.reservasi.action');

Route::get(
    '/dashboard-pasien-konsultasi',
    [DashboardController::class, 'dashboard_pasien_konsultasi']
)->name('dashboard-pasien-konsultasi');

Route::post(
    '/dashboard-pasien-konsultasi',
    [DashboardController::class, 'dashboard_pasien_konsultasi_action']
)->name('dashboard.pasien.konsultasi.action');

Route::get(
    '/dashboard-pasien-penjemputan',
    [DashboardController::class, 'dashboard_pasien_penjemputan']
)->name('dashboard-pasien-penjemputan');

Route::post(
    '/dashboard-pasien-penjemputan',
    [DashboardController::class, 'dashboard_pasien_penjemputan_action']
)->name('dashboard.pasien.penjemputan.action');

Route::get(
    '/dashboard-pasien-test',
    [DashboardController::class, 'dashboard_pasien_test']
)->name('dashboard-pasien-test');

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

// --- Registrasi -- //

Route::get(
    '/registrasi-pasien',
    [UserController::class, 'registrasi_pasien']
)->name('registrasi-pasien');

Route::post(
    '/registrasi-pasien',
    [UserController::class, 'registrasi_pasien_action']
)->name('registrasi.pasien.action');

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