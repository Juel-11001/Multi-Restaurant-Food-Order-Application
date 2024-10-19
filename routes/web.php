<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
// 	return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('user')->as('user.')->group(function () {
	Route::post('/profile', [UserDashboardController::class, 'update'])->name('profile.update');
	Route::get('/profile', [UserDashboardController::class, 'destroy'])->name('logout');
	Route::get('/change/password', [UserDashboardController::class, 'changePassword'])->name('change.password');
	Route::post('/update/password', [UserDashboardController::class, 'updatePassword'])->name('update.password');
});

require __DIR__.'/auth.php';

/** admin routes */
// Route::middleware('admin')->prefix('admin')->as('admin.')->group(function () {
// 	Route::controller(AdminController::class)->group(function () {
// 		Route::get('/dashboard', 'dashboard')->name('dashboard');
// 		Route::get('/profile', 'adminProfile')->name('profile');
// 		Route::post('/profile/update', 'adminProfileUpdate')->name('profile.update');
//         Route::get('profile/password-change', 'adminPasswordChange')->name('profile.password-change');
//         Route::post('profile/password-update', 'adminPasswordUpdate')->name('profile.password-update');
// 	});
// });

Route::post('admin/login', [AdminController::class, 'adminLoginSubmit'])->name('admin.login-submit');
Route::get('admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
Route::get('admin/forgot-password', [AdminController::class, 'forgotPassword'])->name('admin.forgot-password');
Route::get('admin/reset-password/{token}/{email}', [AdminController::class, 'resetPassword']);
Route::post('admin/forgot-password', [AdminController::class, 'forgotPasswordSubmit'])->name('admin.forgot-password-submit');
Route::post('admin/reset-password', [AdminController::class, 'resetPasswordSubmit'])->name('admin.reset-password-submit');
Route::get('admin/show', [AdminController::class, 'show'])->name('admin.show');
