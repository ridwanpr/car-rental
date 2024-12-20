@extends('layouts.frontend.app')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h4 class="mb-0 fw-bold">Payment Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 class="fw-bold mb-3">Booking Information</h5>
                                <div class="mb-2">
                                    <strong>Payment Code:</strong>
                                    <span class="text-muted">{{ $payment->payment_code }}</span>
                                </div>
                                <div class="mb-2">
                                    <strong>Payment Date:</strong>
                                    <span class="text-muted">{{ $payment->created_at }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <h5 class="fw-bold mb-3">Customer Details</h5>
                                <div class="mb-2">
                                    <strong>Name:</strong>
                                    <span class="text-muted">{{ auth()->user()->name }}</span>
                                </div>
                                <div class="mb-2">
                                    <strong>Email:</strong>
                                    <span class="text-muted">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Car</th>
                                        <th>Rental Period</th>
                                        <th>Price per Day</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payment->rent as $rent)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h6 class="fw-bold mb-1">{{ $rent->car->brand->name }}
                                                            {{ $rent->car->model }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>Start:</strong>
                                                    {{ date('d M Y', strtotime($rent->rent_start)) }}<br>
                                                    <strong>End:</strong>
                                                    {{ date('d M Y', strtotime($rent->rent_end)) }}<br>
                                                    <span class="text-muted">(
                                                        {{ abs((strtotime($rent->rent_end) - strtotime($rent->rent_start)) / (60 * 60 * 24)) }}
                                                        days
                                                        )
                                                    </span>
                                                </div>
                                            </td>
                                            <td>Rp. {{ number_format($rent->price_per_day, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($rent->total_price, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h4 class="mb-0 fw-bold">Payment Method</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-check-label" for="bankTransfer">
                                        {{ $paymentMethod->name }}
                                    </label>
                                    <div class="text-muted mt-2">
                                        <strong>Account Number:</strong> {{ $paymentMethod->account_number }}<br>
                                        <strong>Account Name:</strong> {{ $paymentMethod->account_name }}<br>
                                        <strong>Bank Name:</strong> {{ $paymentMethod->bank_name }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Payment Summary</h5>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Subtotal</span>
                                            <span>Rp.{{ number_format($payment->total_amount, 0, ',', '.') }}</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between fw-bold">
                                            <span>Total</span>
                                            <span
                                                class="text-primary">Rp.{{ number_format($payment->total_amount, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h4 class="mb-0 fw-bold">Payment Confirmation</h4>
                    </div>
                    <div class="card-body">
                        @if ($payment->payment_proof == null)
                            <div class="alert alert-info" role="alert">
                                <i class="fa fa-info-circle me-2"></i>
                                Please complete your payment within 24 hours.
                            </div>

                            <form action="{{ route('upload-payment-proof') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                                <div class="mb-3">
                                    <label for="proofUpload" class="form-label fw-bold">Upload Payment Proof</label>
                                    <input class="form-control" type="file" id="proofUpload" name="payment_proof">
                                </div>

                                <button class="btn btn-primary w-100" id="confirmPayment">
                                    <i class="fa fa-check me-2"></i>Confirm Payment
                                </button>
                            </form>
                        @else
                            @if ($payment->status == 'pending')
                                <div class="alert alert-warning" role="alert">
                                    <i class="fa fa-hourglass-half me-2"></i>
                                    Your payment is pending. Please wait for confirmation.
                                </div>
                            @elseif ($payment->status == 'waiting confirmation')
                                <div class="alert alert-info" role="alert">
                                    <i class="fa fa-spinner me-2"></i>
                                    Your payment is waiting for confirmation.
                                </div>
                            @elseif ($payment->status == 'declined')
                                <div class="alert alert-danger" role="alert">
                                    <i class="fa fa-times-circle me-2"></i>
                                    Your payment was declined. Please try again or contact support.
                                </div>
                            @elseif ($payment->status == 'approved')
                                <div class="alert alert-success" role="alert">
                                    <i class="fa fa-check-circle me-2"></i>
                                    Payment confirmed! Waiting for rent confirmation.
                                </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label fw-bold">Payment Proof</label>
                                <div>
                                    <img src="{{ route('payment.proof', ['filename' => basename($payment->payment_proof)]) }}"
                                        alt="Payment Proof" class="img-fluid" style="max-height: 200px;">
                                </div>
                            </div>
                        @endif

                        <div class="mt-3 text-center">
                            <a href="{{ route('user.dashboard') }}" class="text-muted">
                                <i class="fa fa-arrow-left me-2"></i>Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
