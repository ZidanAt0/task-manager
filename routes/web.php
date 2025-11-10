<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\HomeController;


// Route default ke dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');



// Route untuk guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post')
        ->middleware('throttle:login');
});

// Route untuk User (sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // ✅ CRUD Tugas
    Route::resource('tugas', \App\Http\Controllers\TugasController::class)->names('tugas');

    // ✅ CRUD Mata Kuliah
    Route::resource('mata-kuliah', MataKuliahController::class)
        ->parameters(['mata-kuliah' => 'course'])
        ->names('mata-kuliah');

    // ✅ CRUD Jadwal (Schedule)
    Route::resource('schedules', ScheduleController::class);

    // ✅ Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ✅ Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
