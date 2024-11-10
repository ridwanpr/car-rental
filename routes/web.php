<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Auth\Socialite\LoginController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CarController;
use App\Http\Controllers\Frontend\CarListController;
use App\Http\Controllers\Frontend\WelcomeController;

Route::get('/', WelcomeController::class)->name('welcome');

// Socialite Auth
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::view('privacy', 'layouts.frontend.privacy')->name('privacy');
Route::view('terms', 'layouts.frontend.terms')->name('terms');

Route::middleware('auth')->group(function () {
    Route::middleware('role:' . User::ROLE_ADMIN)->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::resource('user/admin', AdminController::class);
        Route::resource('brand', BrandController::class);
        Route::resource('car', CarController::class);
    });

    Route::middleware('role:' . User::ROLE_USER)->group(function () {
        Route::middleware('verified')->group(function () {
            Route::get('mypanel/dashboard', function () {
                return 'dashboard';
            })->name('user.dashboard');
        });
    });
});

Route::get('car-list', [CarListController::class, 'index'])->name('car-list');
Route::get('car-list/{slug}', [CarListController::class, 'show'])->name('car-list.show');

require __DIR__ . '/auth.php';
