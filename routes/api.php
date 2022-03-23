<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1'], function() {
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::get('/login', fn() => response('Unauthorized ', Response::HTTP_UNAUTHORIZED));
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::post('/password_reset', [UserController::class, 'passwordForget'])->name('password.forget');
    Route::get('/password_reset', [UserController::class, 'passwordResetShow'])->name('password.reset');
    Route::patch('/password_reset', [UserController::class, 'passwordUpdate'])->name('password.update');

    Route::get('/user', [UserController::class, 'show'])->middleware('auth:sanctum')->name('user.show');

    Route::resource('contacts', ContactController::class)->middleware('auth:sanctum');
    Route::post('/contacts/favorite/{contact}', [ContactController::class, 'favorite'])->middleware('auth:sanctum');
});

