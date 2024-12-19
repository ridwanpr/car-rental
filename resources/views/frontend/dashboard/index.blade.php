@extends('layouts.frontend.app')
@section('content')
    <div class="container py-5 min-vh-100">
        <!-- Dashboard Header -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="h3 mb-0 text-gray-800">Hello, {{ auth()->user()->name }}</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>

        <!-- Stats Cards Row -->
        <div class="row g-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                                    <i class="fas fa-car text-primary fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Active Rentals</h6>
                                <h2 class="mb-0 fs-5">{{ $countActiveRent }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="rounded-circle bg-success bg-opacity-10 p-3">
                                    <i class="fas fa-history text-success fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Total Rents</h6>
                                <h2 class="mb-0 fs-5">{{ $countTotalRent }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="rounded-circle bg-warning bg-opacity-10 p-2">
                                    <i class="fas fa-wallet text-warning fs-5"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Total Spent</h6>
                                <h2 class="mb-0 text-nowrap overflow-hidden text-truncate fs-5">Rp
                                    {{ number_format($totalSpent, 0, ',', ',') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="rounded-circle bg-info bg-opacity-10 p-2">
                                    <i class="fas fa-ticket-alt text-info fs-5"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Pending Payment</h6>
                                <h2 class="mb-0 fs-5">{{ $countPendingPayment }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card my-4 shadow-sm rounded">
            <div id="cardNav">
                <div class="card-body">
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">
                            <a href="#" class="text-decoration-none text-dark">Dashboard</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('payment-list.index') }}" class="text-decoration-none text-dark">Payment
                                List</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('rent-list.index') }}" class="text-decoration-none text-dark">Rent List</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('profile') }}" class="text-decoration-none text-dark">Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-5">
            <div class="card-header bg-white py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Latest Payment</h5>
                    <a href="{{ route('payment-list.index') }}" class="btn btn-link btn-sm">View All</a>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 text-center">Payment Code</th>
                                <th class="border-0 text-center">Total Amount</th>
                                <th class="border-0 text-center">Status</th>
                                <th class="border-0 text-center">Payment Method</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td class="text-center">{{ $payment->payment_code }}</td>
                                    <td class="text-center">{{ $payment->total_amount }}</td>
                                    <td class="text-center">
                                        @if ($payment->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif ($payment->status == 'waiting confirmation')
                                            <span class="badge bg-info">Waiting Confirmation</span>
                                        @elseif ($payment->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif ($payment->status == 'declined')
                                            <span class="badge bg-danger">Declined</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $payment->paymentMethod->name }} -
                                        {{ $payment->paymentMethod->bank_name }}
                                        {{ $payment->paymentMethod->account_number }} |
                                        {{ $payment->paymentMethod->account_name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('payment-created', $payment->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    @vite(['resources/scss/user-dashboard.scss'])
@endpush
