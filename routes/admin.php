<?php
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\InternController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;

Route::prefix('admin')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register.form');
        Route::post('/register', [RegisterController::class, 'register'])->name('admin.register');

        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login.form');
        Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('tasks')->group(function () {
            Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
            Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
            Route::post('/create', [TaskController::class, 'store'])->name('tasks.store');
            Route::get('/{task}', [TaskController::class, 'show'])->name('tasks.show');
            Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
            Route::patch('/{task}/update', [TaskController::class, 'update'])->name('tasks.update');
            Route::delete('/{task}/delete', [TaskController::class, 'destroy'])->name('tasks.destroy');
        });

        Route::prefix('interns')->group(function () {
            Route::get('/', [InternController::class, 'index'])->name('interns.index');
            Route::get('/create', [InternController::class, 'create'])->name('interns.create');
            Route::post('/create', [InternController::class, 'store'])->name('interns.store');
            Route::get('/assign', [InternController::class, 'assign'])->name('interns.assign');
            Route::post('/assign', [InternController::class, 'assignStore'])->name('interns.assign.store');
            Route::get('/{iterns}', [InternController::class, 'show'])->name('interns.show');
            Route::get('/{intern}/edit', [InternController::class, 'edit'])->name('interns.edit');
            Route::patch('/{intern}/update', [InternController::class, 'update'])->name('interns.update');
            Route::delete('/{intern}/delete', [InternController::class, 'destroy'])->name('interns.destroy');
        });

        Route::prefix('admins')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('admins.index');
            Route::get('/create', [AdminController::class, 'create'])->name('admins.create');
            Route::post('/create', [AdminController::class, 'store'])->name('admins.store');
            Route::get('/{admin}/edit', [AdminController::class, 'edit'])->name('admins.edit');
            Route::patch('/{admin}/update', [AdminController::class, 'update'])->name('admins.update');
            Route::delete('/{admin}/delete', [AdminController::class, 'destroy'])->name('admins.destroy');
        });
        Route::prefix('roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('roles.index');
            Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
            Route::post('/create', [RoleController::class, 'store'])->name('roles.store');
            Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
            Route::patch('/{role}/update', [RoleController::class, 'update'])->name('roles.update');
            Route::delete('/{role}/delete', [RoleController::class, 'destroy'])->name('roles.destroy');
        });
        Route::prefix('permissions')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('permissions.index');
            Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create');
            Route::post('/create', [PermissionController::class, 'store'])->name('permissions.store');
            Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
            Route::patch('/{permission}/update', [PermissionController::class, 'update'])->name('permissions.update');
            Route::delete('/{permission}/delete', [PermissionController::class, 'destroy'])->name('permissions.destroy');
        });

        Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
    });
});