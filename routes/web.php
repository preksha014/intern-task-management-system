<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Intern\Auth\LoginController as InternLoginController;
use App\Http\Controllers\Intern\Auth\RegisterController as InternRegisterController;
use App\Http\Controllers\Admin\TaskController;

Route::prefix('admin')->group(function () {
    // Admin Registration Routes (optional, restrict to super admin if needed)
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('admin.register');
    // Admin Login Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
    // Logout Route
    Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');

    // Protected Routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::prefix('tasks')->group(function () {
            Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
            Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
            Route::post('/create', [TaskController::class, 'store'])->name('tasks.store');
            Route::get('/{task}', [TaskController::class, 'show'])->name('tasks.show');
            Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
            Route::patch('/{task}/update', [TaskController::class,'update'])->name('tasks.update');
            Route::delete('/{task}/delete', [TaskController::class,'destroy'])->name('tasks.destroy');
        });
    });
});
// Intern Registration Routes
Route::get('/register', [InternRegisterController::class, 'showRegistrationForm'])->name('intern.register.form');
Route::post('/register', [InternRegisterController::class, 'register'])->name('intern.register');
// Intern Login Routes
Route::get('/login', [InternLoginController::class, 'showLoginForm'])->name('intern.login.form');
Route::post('/login', [InternLoginController::class, 'login'])->name('intern.login');
Route::post('/logout', [InternLoginController::class, 'logout'])->name('intern.logout');


Route::middleware('auth:intern')->group(function () {
    Route::get('/', function () {
        return view('interns.home');
    })->name('intern.dashboard');
});