<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication routes that may be accessed by guests only
Route::middleware('guest')->group(function()
{
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Routes that require authentication
Route::middleware('auth')->group(function()
{
    Route::get('/dashboard', [ProjectController::class, 'index'])->name('dashboard');

    Route::resource('projects', ProjectController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
