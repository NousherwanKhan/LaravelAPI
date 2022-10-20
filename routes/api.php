<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('attempt-login', [UserController::class, 'login'])->name('attempt-login');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('home', [UserController::class, 'home'])->name('home');
    Route::get('logout', [AuthController::class, 'logout']);
});

// Route::group(['middleware'=>'api','prefix'=>'auth'], function ($router) {

//     Route::post('/register', [AuthController::class, 'register']);
//     Route::post('/login', [AuthController::class, 'login'])->name('login');
//     Route::get('/home', [AuthController::class, 'home'])->name('home');
//     Route::get('/logout', [AuthController::class, 'logout']);
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:api')->get('/home', [AuthController::class, 'home'])->name('home');
Route::middleware('auth:api')->get('/logout', [AuthController::class, 'logout']);
