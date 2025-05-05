<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\TaskController;

Route::prefix('admin')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('admin.register');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');

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
            Route::patch('/{task}/update', [TaskController::class, 'update'])->name('tasks.update');
            Route::delete('/{task}/delete', [TaskController::class, 'destroy'])->name('tasks.destroy');
        });
    });
});