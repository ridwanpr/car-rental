<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\CarController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Frontend\TicketController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Frontend\CarListController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\RentListController;
use App\Http\Controllers\Frontend\WithdrawController;
use App\Http\Controllers\Backend\RentRequestController;
use App\Http\Controllers\Frontend\UserDetailController;
use App\Http\Controllers\Auth\Socialite\LoginController;
use App\Http\Controllers\Frontend\BookingListController;
use App\Http\Controllers\Frontend\PaymentListController;
use App\Http\Controllers\Backend\PaymentMethodController;
use App\Http\Controllers\Backend\TicketRequestController;
use App\Http\Controllers\Backend\PaymentRequestController;
use App\Http\Controllers\Backend\WithdrawRequestController;
use App\Http\Controllers\Frontend\DashboardController as UserDashboardController;

Route::get('/', WelcomeController::class)->name('welcome')->prerender('eager');

// Socialite Auth
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::view('privacy', 'layouts.frontend.privacy')->name('privacy')->prerender('eager');
Route::view('terms', 'layouts.frontend.terms')->name('terms')->prerender('eager');

Route::middleware('auth')->group(function () {
    Route::get('/payment/proof/{filename}', [PaymentRequestController::class, 'getPaymentProof'])->name('payment.proof');
    Route::middleware('role:' . User::ROLE_ADMIN)->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->prerender('eager');

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

        Route::get('report', [ReportController::class, 'index'])->name('report.index')->prerender('eager');
        Route::get('report/pdf', [ReportController::class, 'exportPdf'])->name('report.exportPdf');
        Route::get('/report/export-excel', [ReportController::class, 'exportExcel'])->name('report.exportExcel');

        Route::get('brand', [BrandController::class, 'index'])->name('brand.index')->prerender('eager');
        Route::get('car', [CarController::class, 'index'])->name('car.index')->prerender('eager');
        Route::get('payment-method', [PaymentMethodController::class, 'index'])->name('payment-method.index')->prerender('eager');
        Route::get('rent-request', [RentRequestController::class, 'index'])->name('rent-request.index')->prerender('eager');
        Route::get('payment-request', [PaymentRequestController::class, 'index'])->name('payment-request.index')->prerender('eager');
        Route::get('customer', [CustomerController::class, 'index'])->name('customer.index')->prerender('eager');
        Route::get('withdraw-request', [WithdrawRequestController::class, 'index'])->name('withdraw-request.index')->prerender('eager');

        Route::resource('user/admin', AdminController::class);
        Route::resource('brand', BrandController::class);
        Route::resource('car', CarController::class);
        Route::resource('payment-method', PaymentMethodController::class);
        Route::resource('rent-request', RentRequestController::class);
        Route::resource('payment-request', PaymentRequestController::class);
        Route::resource('customer', CustomerController::class);
        Route::resource('withdraw-request', WithdrawRequestController::class);

        Route::get('ticket-request', [TicketRequestController::class, 'index'])->name('ticket-request.index')->prerender();
        Route::get('ticket-request/{ticket}', [TicketRequestController::class, 'show'])->name('ticket-request.show')->prerender();
        Route::post('ticket-request/{ticket}/messages', [TicketRequestController::class, 'storeMessage'])->name('ticket-request.message.store');
        Route::patch('ticket-request/{ticket}/status', [TicketRequestController::class, 'updateStatus'])->name('ticket-request.status.update');
    });

    Route::middleware('role:' . User::ROLE_USER)->group(function () {
        Route::middleware('verified')->group(function () {
            Route::get('mypanel/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard')->prerender('eager');

            Route::post('booking-list/add', [BookingListController::class, 'add'])->name('booking-list.add');
            Route::get('booking-list', [BookingListController::class, 'index'])->name('booking-list.index')->prerender();
            Route::delete('booking-list/{bookingList}', [BookingListController::class, 'destroy'])->name('booking-list.destroy');

            Route::post('checkout', [CheckoutController::class, 'checkout'])->name('booking-list.checkout');
            Route::get('payment-created/{id}', [CheckoutController::class, 'paymentCreated'])->name('payment-created');
            Route::post('upload-payment-proof', [CheckoutController::class, 'uploadPaymentProof'])->name('upload-payment-proof');

            Route::get('payment-list', [PaymentListController::class, 'index'])->name('payment-list.index')->prerender('eager');
            Route::get('rent-list', [RentListController::class, 'index'])->name('rent-list.index')->prerender('eager');
            Route::get('withdraw', [WithdrawController::class, 'index'])->name('withdraw.index')->prerender('eager');

            Route::resource('rent-list', RentListController::class);
            // Route::resource('payment-list', PaymentListController::class);
            Route::match(['get', 'post'], 'profile', [UserDetailController::class, 'editOrUpdate'])->name('profile.user')->prerender('eager');
            Route::get('id-card', [UserDetailController::class, 'getIdCard'])->name('profile.id-card');
            Route::resource('withdraw', WithdrawController::class);

            Route::get('ticket', [TicketController::class, 'index'])->name('ticket.index')->prerender();
            Route::get('ticket/create', [TicketController::class, 'create'])->name('ticket.create')->prerender();
            Route::post('ticket', [TicketController::class, 'store'])->name('ticket.store');
            Route::get('ticket/{ticket}', [TicketController::class, 'show'])->name('ticket.show')->prerender();
            Route::post('ticket/{ticket}/messages', [TicketController::class, 'storeMessage'])->name('ticket.message.store');
            Route::patch('ticket/{ticket}/status', [TicketController::class, 'updateStatus'])->name('ticket.status.update');
        });
    });
});

Route::get('car-list', [CarListController::class, 'index'])->name('car-list')->prerender('eager');
Route::get('car-list/{slug}', [CarListController::class, 'show'])->name('car-list.show')->prerender();
Route::view('calculate-price', 'frontend.calculate-price.index')->prerender();

require __DIR__ . '/auth.php';
