<?php

use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ImageGalleryController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(ClientController::class)->group(function () {
   Route::get('/dashboard', 'dashboard')->name('dashboard');
   Route::get('/profile', 'profile')->name('profile');
   Route::post('/profile/update', 'profileUpdate')->name('profile.update');
   Route::get('profile/password-change', 'passwordChange')->name('profile.password-change');
   Route::post('profile/password-update', 'passwordUpdate')->name('profile.password-update');
});
Route::middleware(['clientStatus'])->group(function () {
   /** menu route */
   Route::put('/menu/change-status', [MenuController::class, 'changeStatus'])->name('menu.change-status');
   Route::resource('menu', MenuController::class);

   /** product route */
   Route::put('/product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
   Route::resource('product', ProductController::class);

   /** image gallery route */
   Route::resource('gallery', ImageGalleryController::class);

   /** coupon route */
   Route::prefix('coupon')->as('coupon.')->group(function () {
      Route::controller(CouponController::class)->group(function () {
         Route::get('/', 'index')->name('index');
         Route::get('/create', 'create')->name('create');
         Route::post('/store', 'store')->name('store');
         Route::get('/edit/{id}', 'edit')->name('edit');
         Route::post('/update', 'update')->name('update');
         Route::delete('/destroy/{id}', 'destroy')->name('destroy');
         Route::put('/change-status', 'changeStatus')->name('change-status');
      });
   });
});
