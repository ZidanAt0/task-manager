<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('dashboard', [
        'title' => 'Dashboard • CTM'
    ]);
});

// auth guest
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post')
        ->middleware('throttle:login');
});

// auth user
Route::middleware('auth')->group(function () {
    Route::get('/home', fn () => view('home', ['title' => 'Home • CTM']))->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// logout
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});