<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveApplicationController;

use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboardController,
    ProfileController as AdminProfileController,
    UserController as AdminUserController
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
        
        Route::get('leaves', [LeaveApplicationController::class, 'listForAdmin'])->name('admin.leaves');
        Route::put('leave/{id}', [LeaveApplicationController::class, 'updateStatus'])->name('admin.leave.update');
        
        Route::get('users', [AdminUserController::class, 'index']);

        Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    });
});

require __DIR__.'/auth.php';
