<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AddressController;
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

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);

    Route::get('/{id}', [UserController::class, 'getById']);

    Route::put('/{id}', [UserController::class, 'update']);
});

Route::prefix('address')->group(function () {
    Route::post('/', [AddressController::class, 'store']);

    Route::put('/{id}', [AddressController::class, 'update']);

    Route::delete('/{id}', [AddressController::class, 'delete']);
});
