<?php
include_once 'admin.php';
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Intern\Auth\LoginController as InternLoginController;
use App\Http\Controllers\Intern\Auth\RegisterController as InternRegisterController;
use App\Http\Controllers\Intern\TaskController as InternTaskController;
use App\Http\Controllers\Intern\HomeController;
use App\Http\Controllers\CommentController;

Route::middleware('guest:intern')->group(function () {
    Route::get('/register', [InternRegisterController::class,'showRegistrationForm'])->name('intern.register.form');
    Route::post('/register', [InternRegisterController::class,'register'])->name('intern.register');
    
    Route::get('/login', [InternLoginController::class,'showLoginForm'])->name('intern.login.form');
    Route::post('/login', [InternLoginController::class, 'login'])->name('intern.login');
});

Route::middleware('auth:intern')->group(function () {
    Route::get('/', [HomeController::class,'index'])->name('intern.dashboard');

    Route::prefix('tasks')->group(function () {
        Route::get('/', [InternTaskController::class, 'index'])->name('intern.tasks.index');
        
        Route::post('/{task}/comments', [CommentController::class, 'store'])->name('tasks.comments.store');
        Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    });
    
    Route::post('/logout', [InternLoginController::class, 'logout'])->name('intern.logout');
});