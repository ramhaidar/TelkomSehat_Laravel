<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('mahasiswa', UserController::class);

// Route::resource('login', [UserController::class, 'login_action']);
// Route::post('login', 'UserController@store');
// Route::post('login', [UserController::class, 'login_action'])->middleware('throttle:10,1');
Route::post('login', [UserController::class, 'login_action']);
Route::post('mobile_app_token_check', [UserController::class, 'mobile_app_token_check']);