@extends('layouts.frontend.app')
@section('content')
    <div class="container py-5 min-vh-100">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="h3 mb-0 text-gray-800">Rental Details</h1>
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

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header">
                        <h5 class="mb-0">Rental Information</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold" width="40%">Rental Code</td>
                                <td>: {{ $rent->rental_code }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Status</td>
                                <td>: @if ($rent->rent_status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($rent->rent_status == 'approved')
                                        <span class="badge bg-success">Approved - Ongoing</span>
                                    @elseif ($rent->rent_status == 'declined')
                                        <span class="badge bg-danger">Declined</span>
                                    @else
                                        <span class="badge bg-info">Completed - Returned</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Rental Period</td>
                                <td>: {{ date('d M Y', strtotime($rent->rent_start)) }} -
                                    {{ date('d M Y', strtotime($rent->rent_end)) }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Price Per Day</td>
                                <td>: Rp {{ number_format($rent->price_per_day, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Total Price</td>
                                <td>: Rp {{ number_format($rent->total_price, 0, ',', '.') }}</td>
                            </tr>
                            @if ($rent->decline_message)
                                <tr>
                                    <td class="fw-bold">Decline Reason</td>
                                    <td>: {{ $rent->decline_message }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="fw-bold">Return Date</td>
                                <td>: {{ date('d M Y', strtotime($rent->return_date)) }} @if ($rent->days_late > 0)
                                    <span class="badge bg-danger">{{ $rent->days_late }} days late</span>
                                @endif</td>
                            </tr>
                            @if ($rent->days_late > 0)
                                <tr>
                                    <td class="fw-bold">Penalty</td>
                                    <td>: Rp {{ number_format($rent->penalty_amount, 0, ',', '.') }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header">
                        <h5 class="mb-0">Car Information</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold" width="40%">Brand & Model</td>
                                <td>: {{ $rent->model }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Year</td>
                                <td>: {{ $rent->tahun }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">License Plate</td>
                                <td>: {{ $rent->plat_nomor }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Seats</td>
                                <td>: {{ $rent->jumlah_kursi }} Seats</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Fuel Type</td>
                                <td>: {{ $rent->bahan_bakar }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Transmission</td>
                                <td>: {{ $rent->transmission }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Payment Information</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold" width="20%">Payment Code</td>
                                <td>: {{ $rent->payment_code }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Payment Method</td>
                                <td>: {{ $rent->payment_method }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Total Amount</td>
                                <td>: Rp {{ number_format($rent->total_amount, 0, ',', '.') }}</td>
                            </tr>
                            @if ($rent->payment_proof)
                                <tr>
                                    <td class="fw-bold">Payment Proof</td>
                                    <td>
                                        <img src="{{ route('payment.proof', ['filename' => basename($rent->payment_proof)]) }}"
                                            alt="Payment Proof" class="img-fluid" style="max-width: 300px">
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    @vite(['resources/scss/user-dashboard.scss'])
@endpush
