<?php

use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [ClientController::class, 'loginForm'])->name('login');
Route::post('/login', [ClientController::class, 'login'])->name('login');
Route::get('/logout', [ClientController::class, 'logout'])->name('logout');
Route::get('/register', [ClientController::class, 'clientRegister'])->name('register');
Route::post('/register', [ClientController::class, 'clientRegisterCreate'])->name('register.create');

Route::middleware('client')->group(function () {
   Route::controller(ClientController::class)->group(function () {
      Route::get('/dashboard', 'dashboard')->name('dashboard');
      Route::get('/profile', 'profile')->name('profile');
		Route::post('/profile/update', 'profileUpdate')->name('profile.update');
      Route::get('profile/password-change', 'passwordChange')->name('profile.password-change');
      Route::post('profile/password-update', 'passwordUpdate')->name('profile.password-update');
   });

   /** menu route */
   Route::put('/menu/change-status', [MenuController::class, 'changeStatus'])->name('menu.change-status');
   Route::resource('menu', MenuController::class);
});
