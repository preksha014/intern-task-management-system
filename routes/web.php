<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Intern\Auth\LoginController as InternLoginController;
use App\Http\Controllers\Intern\Auth\RegisterController as InternRegisterController;

// Admin Registration Routes (optional, restrict to super admin if needed)
Route::get('/admin/register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register.form');
Route::post('/admin/register', [RegisterController::class, 'register'])->name('admin.register');
// Admin Login Routes
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login');
// Logout Route
Route::post('admin/logout', [LoginController::class, 'logout'])->name('logout');

// Intern Registration Routes
Route::get('/register', [InternRegisterController::class, 'showRegistrationForm'])->name('intern.register.form');
Route::post('/register', [InternRegisterController::class, 'register'])->name('intern.register');
// Intern Login Routes
Route::get('/login', [InternLoginController::class, 'showLoginForm'])->name('intern.login.form');
Route::post('/login', [InternLoginController::class, 'login'])->name('intern.login');
Route::post('/logout', [InternLoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware('auth:intern')->group(function () {
    Route::get('/', function () {
        return view('interns.home');
    })->name('intern.dashboard');
});