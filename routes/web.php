<?php

use App\Http\Controllers\UserRegistraionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('content.dashboard.dashboards-analytics');
});

Route::get('/user/registration', [UserRegistraionController::class, 'index'])->name('registration');

