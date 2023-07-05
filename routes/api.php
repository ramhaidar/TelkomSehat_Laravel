<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware ( 'auth:sanctum' )->get ( '/user', function (Request $request)
{
    return $request->user ();
} );

Route::post ( 'login', [ UserController::class, 'login_action' ] );

Route::post ( 'mobile_app_token_check', [ UserController::class, 'mobile_app_token_check' ] );

Route::post ( 'dashboard_patient', [ DashboardController::class, 'dashboard_patient' ] );

Route::post ( 'dashboard_doctor', [ DashboardController::class, 'dashboard_doctor' ] );

Route::post ( 'dashboard_paramedic', [ DashboardController::class, 'dashboard_paramedic' ] );


// Route::resource ( 'patient', UserController::class);

Route::get ( 'patient', [ UserController::class, 'patient' ] );

Route::post ( 'patient', [ UserController::class, 'patient' ] );

Route::post ( 'get_available_doctor', [ DashboardController::class, 'get_available_doctor' ] );