<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Models\Penjemputan;
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

// --- Patient -- //

Route::get ( '/dashboard-patient', [ 
    DashboardController::class,
    'dashboard_patient'
] )->name ( 'dashboard-patient' );

Route::get ( '/dashboard-patient-reservation', [ 
    DashboardController::class,
    'dashboard_patient_reservation'
] )->name ( 'dashboard-patient-reservation' );

Route::post ( '/dashboard-patient-reservation', [ 
    DashboardController::class,
    'dashboard_patient_reservation_action'
] )->name ( 'dashboard.patient.reservation.action' );

Route::get ( '/dashboard-patient-consultation', [ 
    DashboardController::class,
    'dashboard_patient_consultation'
] )->name ( 'dashboard-patient-consultation' );

Route::post ( '/dashboard-patient-consultation', [ 
    DashboardController::class,
    'dashboard_patient_consultation_action'
] )->name ( 'dashboard.patient.consultation.action' );

Route::get ( '/dashboard-patient-evacuation', [ 
    DashboardController::class,
    'dashboard_patient_evacuation'
] )->name ( 'dashboard-patient-evacuation' );

Route::post ( '/dashboard-patient-evacuation', [ 
    DashboardController::class,
    'dashboard_patient_evacuation_action'
] )->name ( 'dashboard.patient.evacuation.action' );

Route::get ( '/dashboard-patient-test', [ 
    DashboardController::class,
    'dashboard_patient_test'
] )->name ( 'dashboard-patient-test' );



// --- Doctor -- //

Route::get ( '/dashboard-doctor', [ 
    DashboardController::class,
    'dashboard_doctor'
] )->name ( 'dashboard-doctor' );

Route::get ( '/dashboard-doctor-reservation', [ 
    DashboardController::class,
    'dashboard_doctor_reservation'
] )->name ( 'dashboard-doctor-reservation' );

Route::post ( '/dashboard-doctor-reservation', [ 
    DashboardController::class,
    'dashboard_doctor_reservation_action'
] )->name ( 'dashboard.doctor.reservation.action' );

Route::get ( '/dashboard-doctor-consultation', [ 
    DashboardController::class,
    'dashboard_doctor_consultation'
] )->name ( 'dashboard-doctor-consultation' );

Route::post ( '/dashboard-doctor-consultation', [ 
    DashboardController::class,
    'dashboard_doctor_consultation_action'
] )->name ( 'dashboard.doctor.consultation.action' );

Route::get ( '/dashboard-doctor-test', [ 
    DashboardController::class,
    'dashboard_doctor_test'
] )->name ( 'dashboard-doctor-test' );

// -- Paramedic -- //

Route::get ( '/dashboard-paramedic', [ 
    DashboardController::class,
    'dashboard_paramedic'
] )->name ( 'dashboard-paramedic' );

Route::get ( '/dashboard-paramedic-evacuation', [ 
    DashboardController::class,
    'dashboard_paramedic_evacuation'
] )->name ( 'dashboard-paramedic-evacuation' );

Route::post ( '/dashboard-paramedic-evacuation', [ 
    DashboardController::class,
    'dashboard_paramedic_evacuation_action'
] )->name ( 'dashboard.paramedic.evacuation.action' );

// --- Login -- //

Route::get ( '/login', [ 
    UserController::class,
    'login'
] )->name ( 'login' );

Route::post ( '/login', [ 
    UserController::class,
    'login_action'
] )->name ( 'login.action' );


// --- Registrasi -- //

Route::get ( '/registration_patient', [ 
    UserController::class,
    'registration_patient'
] )->name ( 'registration-patient' );

Route::post ( '/registration_patient_action', [ 
    UserController::class,
    'registration_patient_action'
] )->name ( 'registration.patient.action' );

// --- Beranda -- //

Route::get ( '/', function ()
{
    $user = Auth::user ();
    $data = $user ? [ 'users' => $user ] : [];
    return view ( 'index', $data );
} )->name ( 'home' );

// -- Logout -- //

Route::get ( '/logout', [ UserController::class, 'logout_action' ] )->name ( 'logout.action' );

// -- Ajax Test -- //
Route::get ( '/data-evacuation', function ()
{
    $data = Penjemputan::all ();
    return response ()->json ( [ 'data' => $data ] );
} );

Route::get ( '/data/{id}', function ($id)
{
    $data = Penjemputan::find ( $id );
    if ( ! $data )
    {
        return md5 ( 'Kosong' );
    }
    return md5 ( $data );
} );