<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/** admin routes */
Route::middleware('admin')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::post('admin/login', [AdminController::class, 'adminLoginSubmit'])->name('admin.login-submit');
Route::get('admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
Route::get('admin/forgot-password', [AdminController::class, 'forgotPassword'])->name('admin.forgot-password');
Route::get('admin/reset-password/{token}/{email}', [AdminController::class, 'resetPassword']);
Route::post('admin/forgot-password', [AdminController::class, 'forgotPasswordSubmit'])->name('admin.forgot-password-submit');
Route::post('admin/reset-password', [AdminController::class, 'resetPasswordSubmit'])->name('admin.reset-password-submit');
Route::get('admin/admin-route-file', [AdminController::class, 'adminRouteFile']);


