<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Auth\Socialite\LoginController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Socialite Auth
Route::get('login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);
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
    });

    Route::middleware('role:' . User::ROLE_USER)->group(function () {
        Route::middleware('verified')->group(function () {
            Route::get('mypanel/dashboard', function () {
                return 'dashboard';
            })->name('user.dashboard');
        });
    });
});

require __DIR__ . '/auth.php';
