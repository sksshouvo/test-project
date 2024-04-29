<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveApplicationController;

use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboardController,
    ProfileController as AdminProfileController
};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuth;
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
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('leave', LeaveApplicationController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware([AdminAuth::class])->group(function () {
    Route::group(['prefix' => 'admin'], function() {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        Route::get('profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::patch('profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
        Route::delete('profile', [AdminProfileController::class, 'destroy'])->name('admin.profile.destroy');
    });
});

require __DIR__.'/auth.php';
