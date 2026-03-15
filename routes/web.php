<?php

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/template', function () {
//     return view('layouts.template');
// });

Route::get('/', function () {
    return redirect()->route('login');
});



Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::get('create', [UserController::class, 'create'])->name('user.create');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::get('{user}', [UserController::class, 'show'])->name('user.show');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('{user}/update', [UserController::class, 'update'])->name('user.update');
        Route::delete('{user}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
    });
    Route::prefix('course')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('course');
        Route::get('create', [CourseController::class, 'create'])->name('course.create');
        Route::post('store', [CourseController::class, 'store'])->name('course.store');
        Route::get('{course}', [CourseController::class, 'show'])->name('course.show');
        Route::get('{course}/edit', [CourseController::class, 'edit'])->name('course.edit');
        Route::put('{course}/update', [CourseController::class, 'update'])->name('course.update');
        Route::delete('{course}/destroy', [CourseController::class, 'destroy'])->name('course.destroy');
    });

    Route::prefix('module')->group(function () {
        Route::get('/', [ModuleController::class, 'index'])->name('module');
        Route::get('create', [ModuleController::class, 'create'])->name('module.create');
        Route::post('store', [ModuleController::class, 'store'])->name('module.store');
        Route::get('{module}/edit', [ModuleController::class, 'edit'])->name('module.edit');
        Route::put('{module}/update', [ModuleController::class, 'update'])->name('module.update');
        Route::delete('{module}/destroy', [ModuleController::class, 'destroy'])->name('module.destroy');
    });
});
