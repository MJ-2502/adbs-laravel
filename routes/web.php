<?php

use App\Http\Controllers\Admin\AdminCertificateController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CertificateRequestController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected routes for residents
Route::middleware(['auth'])->group(function () {
    Route::resource('certificates', CertificateRequestController::class)->except(['edit', 'update', 'destroy']);
});

// Protected routes for admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('certificates', AdminCertificateController::class)->except(['create', 'store', 'edit', 'destroy']);
});
