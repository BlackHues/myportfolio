<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\VisitorLogController;
use App\Services\SitePaletteService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('portfolio', [
        'sitePalettes' => SitePaletteService::palettesForFeatured(),
    ]);
})->name('home');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('admin.login.attempt');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->middleware('admin.auth')
    ->name('admin.logout');

Route::get('/admin/forgot-password', [AdminAuthController::class, 'showForgotPassword'])
    ->name('admin.forgot-password');
Route::post('/admin/forgot-password', [AdminAuthController::class, 'sendOtp'])
    ->middleware('throttle:5,1')
    ->name('admin.forgot-password.send-otp');

Route::get('/admin/reset-password', [AdminAuthController::class, 'showResetPassword'])
    ->name('admin.reset-password.form');
Route::post('/admin/reset-password', [AdminAuthController::class, 'resetPassword'])
    ->middleware('throttle:5,1')
    ->name('admin.reset-password.update');

Route::get('/admin/visitors', [VisitorLogController::class, 'index'])
    ->middleware('admin.auth')
    ->name('admin.visitors.index');
