<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', fn() => Inertia::render('Dashboard'))->name('dashboard');
    Route::resource('users', App\Http\Controllers\UserController::class)->except('show');
    Route::resource('roles', App\Http\Controllers\RoleController::class)->except('show');
    Route::resource('permissions', App\Http\Controllers\PermissionController::class)->except('show');
    Route::resource('activities', App\Http\Controllers\ActivityController::class)->only(['index', 'show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
