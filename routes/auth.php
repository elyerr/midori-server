<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController; 
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisterClientController;
use App\Http\Controllers\Factor\CodeController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
 
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create']);
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.store');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisterClientController::class, 'register'])->name('client.register');
Route::get('/verify/account', [RegisterClientController::class, 'verify_account'])->name('verify.account');

/**
 * 2FA
 */
Route::get('/verify/2fa-factor', [CodeController::class, 'create'])->name('factor.email');
Route::post('/verify/2fa-factor', [CodeController::class, 'loginBy2FA'])->name('factor.email.login');
//activate 2FA
Route::post('/m2fa/authorize', [CodeController::class, 'requestToken2FA'])->name('m2fa.authorize');
Route::post('/m2fa/activate', [CodeController::class, 'factor2faEnableOrDisable'])->name('m2fa.activate');

