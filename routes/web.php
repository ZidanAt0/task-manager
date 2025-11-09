<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\DashboardController; // ✅ import controller dashboard

// Route default ke dashboard, menggunakan controller agar $tugas tersedia
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

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
    
    // 🔹 CRUD Tugas
    Route::resource('tugas', TugasController::class);

    // 🔹 Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 🔹 Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
