<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\CarController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Frontend\CarListController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Auth\Socialite\LoginController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Frontend\BookingListController;
use App\Http\Controllers\Backend\PaymentMethodController;
use App\Http\Controllers\Backend\PaymentRequestController;
use App\Http\Controllers\Backend\RentRequestController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Frontend\DashboardController as UserDashboardController;
use App\Http\Controllers\Frontend\PaymentListController;
use App\Http\Controllers\Frontend\RentListController;
use App\Http\Controllers\Frontend\UserDetailController;
use App\Http\Controllers\Frontend\WithdrawController;

Route::get('/', WelcomeController::class)->name('welcome');

// Socialite Auth
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::view('privacy', 'layouts.frontend.privacy')->name('privacy');
Route::view('terms', 'layouts.frontend.terms')->name('terms');

Route::middleware('auth')->group(function () {
    Route::get('/payment/proof/{filename}', [PaymentRequestController::class, 'getPaymentProof'])->name('payment.proof');
    Route::middleware('role:' . User::ROLE_ADMIN)->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('payments/{id}', [PaymentRequestController::class, 'getPaymentById']);
        Route::post('payments/{id}/approve', [PaymentRequestController::class, 'approvePayment'])->name('payments.approve');
        Route::post('payments/{id}/decline', [PaymentRequestController::class, 'rejectPayment'])->name('payments.reject');

        Route::post('rents/{id}/approve', [RentRequestController::class, 'approveRent'])->name('rents.approve');
        Route::post('rents/{id}/decline', [RentRequestController::class, 'rejectRent'])->name('rents.reject');

        Route::post('/rent-requests/{id}/return', [RentRequestController::class, 'returnCar'])->name('rent-requests.return');
        Route::post('/rent-requests/{id}/check-penalty', [RentRequestController::class, 'checkPenalty'])->name('rent-requests.check-penalty');

        Route::get('report', [ReportController::class, 'index'])->name('report.index');
        Route::get('report/pdf', [ReportController::class, 'exportPdf'])->name('report.exportPdf');
        Route::get('/report/export-excel', [ReportController::class, 'exportExcel'])->name('report.exportExcel');

        Route::resource('user/admin', AdminController::class);
        Route::resource('brand', BrandController::class);
        Route::resource('car', CarController::class);
        Route::resource('payment-method', PaymentMethodController::class);
        Route::resource('rent-request', RentRequestController::class);
        Route::resource('payment-request', PaymentRequestController::class);
        Route::resource('customer', CustomerController::class);
    });

    Route::middleware('role:' . User::ROLE_USER)->group(function () {
        Route::middleware('verified')->group(function () {
            Route::get('mypanel/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

            Route::post('booking-list/add', [BookingListController::class, 'add'])->name('booking-list.add');
            Route::get('booking-list', [BookingListController::class, 'index'])->name('booking-list.index');

            Route::post('checkout', [CheckoutController::class, 'checkout'])->name('booking-list.checkout');
            Route::get('payment-created/{id}', [CheckoutController::class, 'paymentCreated'])->name('payment-created');
            Route::post('upload-payment-proof', [CheckoutController::class, 'uploadPaymentProof'])->name('upload-payment-proof');
            Route::resource('rent-list', RentListController::class);
            Route::resource('payment-list', PaymentListController::class);
            Route::match(['get', 'post'], 'profile', [UserDetailController::class, 'editOrUpdate'])->name('profile');
            Route::get('id-card', [UserDetailController::class, 'getIdCard'])->name('profile.id-card');
            Route::resource('withdraw', WithdrawController::class);
        });
    });
});

Route::get('car-list', [CarListController::class, 'index'])->name('car-list');
Route::get('car-list/{slug}', [CarListController::class, 'show'])->name('car-list.show');
Route::view('calculate-price', 'frontend.calculate-price.index');

require __DIR__ . '/auth.php';
