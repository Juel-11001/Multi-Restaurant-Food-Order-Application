<?php

use App\Http\Controllers\Admin\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [ClientController::class, 'loginForm'])->name('login');
Route::post('/login', [ClientController::class, 'login'])->name('login');
Route::get('/register', [ClientController::class, 'clientRegister'])->name('register');
Route::post('/register', [ClientController::class, 'clientRegisterCreate'])->name('register.create');
Route::middleware('client')->group(function () {
   Route::get('/dashboard', [ClientController::class, 'Dashboard'])->name('dashboard'); 
});
