<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminManageProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\ManageRestaurantUserController;
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

/** city route */
Route::put('/city/change-status', [CityController::class, 'changeStatus'])->name('city.change-status');
Route::resource('city', CityController::class);

/** manger prduct route */
Route::resource('manage-product', AdminManageProductController::class);

/** manage restaurant user */
Route::controller(ManageRestaurantUserController::class)->group(function () {
   Route::get('/manage-restaurant-user-list', 'index')->name('manage-restaurant-user.list');
   Route::get('/manage-restaurant-user-pending', 'pendingUsers')->name('manage-restaurant-user.pending');
   Route::put('/manage-restaurant-user-change-status', 'changeStatus')->name('manage-restaurant-user.change-status');
});