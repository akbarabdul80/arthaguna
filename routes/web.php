<?php

use App\Http\Controllers\DepositsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\UserRegistraionController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Middleware\Guest;
use Illuminate\Support\Facades\Route;

Route::get('/user/registration', [UserRegistraionController::class, 'index'])->name('registration');

Route::controller(LoginController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/', 'showDashboard')->name('dashboard');
        Route::post('/logout', 'logout')->name('logout.submit');
    });

    Route::middleware(Guest::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->name('login.submit');
    });
});

Route::prefix('deposit')
    ->controller(DepositsController::class)
    ->group(function () {
        Route::middleware('auth')->group(function () {
            Route::get('/', 'index')->name('deposit');
        });
    });

Route::prefix('withdrawals')
    ->controller(WithdrawalController::class)
    ->group(function () {
        Route::middleware('auth')->group(function () {
            Route::get('/', 'index')->name('withdrawal');
            Route::post('/update/{id}', 'update')->name('withdrawal.update');
        });
    });

Route::prefix('user')->group(function () {
    Route::prefix('/register')
        ->controller(UserRegistraionController::class)
        ->group(function () {
            Route::middleware('auth')->group(function () {
                Route::get('/', 'index')->name('user.reg');
                Route::post('/update/{id}', 'update')->name('user.reg.update');
            });
        });

    Route::prefix('/list')
        ->controller(UserListController::class)
        ->group(function () {
            Route::middleware('auth')->group(function () {
                Route::get('/', 'index')->name('user.list');
                Route::post('/update/{id}', 'update')->name('user.list.update');
            });
        });
});
