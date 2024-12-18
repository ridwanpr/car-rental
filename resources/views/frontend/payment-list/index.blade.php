@extends('layouts.frontend.app')
@section('content')
    <div class="container py-5 min-vh-100">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="h3 mb-0 text-gray-800">Payment List</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>

        <!-- Navigation -->
        <div class="card my-4 shadow-sm rounded">
            <div id="cardNav">
                <div class="card-body">
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">
                            <a href="{{ route('user.dashboard') }}" class="text-decoration-none text-dark">Dashboard</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('payment-list.index') }}" class="text-decoration-none text-dark">Payment
                                List</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('rent-list.index') }}" class="text-decoration-none text-dark">Rent List</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-5">
            <div class="card-header bg-white py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Payment List</h5>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="datatable">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0">#</th>
                                <th class="border-0 text-center">Payment Code</th>
                                <th class="border-0 text-center">Total Amount</th>
                                <th class="border-0 text-center">Status</th>
                                <th class="border-0 text-center">Payment Method</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($payments as $payment)
                                <tr>
                                    <td class="text-center">{{ ++$count }}</td>
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
