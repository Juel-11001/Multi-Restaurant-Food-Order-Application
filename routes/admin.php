<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::controller(AdminController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/profile', 'adminProfile')->name('profile');
    Route::post('/profile/update', 'adminProfileUpdate')->name('profile.update');
    Route::get('profile/password-change', 'adminPasswordChange')->name('profile.password-change');
    Route::post('profile/password-update', 'adminPasswordUpdate')->name('profile.password-update');
});
/** category route */
Route::put('/category/change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);