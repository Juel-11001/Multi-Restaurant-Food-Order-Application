<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ClientController;
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

/** admin route */
Route::prefix('admin')->as('admin.')->group(function () {
	Route::controller(AdminController::class)->group(function () {
		Route::post('admin/login', 'adminLoginSubmit')->name('login-submit');
		Route::get('admin/logout', 'adminLogout')->name('logout');
		Route::get('admin/forgot-password', 'forgotPassword')->name('forgot-password');
		Route::get('admin/reset-password/{token}/{email}', 'resetPassword');
		Route::post('admin/forgot-password', 'forgotPasswordSubmit')->name('forgot-password-submit');
		Route::post('admin/reset-password', 'resetPasswordSubmit')->name('reset-password-submit');
	});
});

/** client route */
Route::prefix('client')->as('client.')->group(function () {
	Route::controller(ClientController::class)->group(function () {
		Route::get('/login', 'loginForm')->name('login');
		Route::post('/login', 'login')->name('login');
		Route::get('/logout', 'logout')->name('logout');
		Route::get('/register', 'clientRegister')->name('register');
		Route::post('/register', 'clientRegisterCreate')->name('register.create');
	});
});