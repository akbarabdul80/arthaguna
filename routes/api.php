<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SaldoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::middleware('guest:sanctum')->group(function () {
//     Route::post('register', [AuthController::class, 'register']);
//     Route::post('login', [AuthController::class, 'login']);
// });


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);


    Route::get('saldo', [SaldoController::class, 'getSaldo']);
    Route::post('withdraw', [SaldoController::class, 'withdraw']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
