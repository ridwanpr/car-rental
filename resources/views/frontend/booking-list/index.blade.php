@extends('layouts.frontend.app')
@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0 fw-bold">Your Booking List</h3>
            <a href="{{ route('car-list') }}" class="btn btn-outline-primary">
                <i class="fa fa-arrow-left me-2"></i>Back to Car List
            </a>
        </div>

        @if ($bookingLists->isEmpty())
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <i class="fa fa-shopping-cart fa-3x text-muted"></i>
                    </div>
                    <h5 class="fw-bold text-muted">Your booking list is empty</h5>
                    <p class="text-muted">Please add cars to your booking list before proceeding.</p>
                    <a href="{{ route('car-list') }}" class="btn btn-primary px-4">
                        Browse Cars
                    </a>
                </div>
            </div>
        @else
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Selected Cars</h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Car Details</th>
                                    <th>Price Per Day</th>
                                    <th>Rental Period</th>
                                    <th>Total Price</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookingLists as $item)
                                    <tr data-car-id="{{ $item->car->id }}">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/cars/' . $item->car->images->firstWhere('is_primary', 1)->image) }}"
                                                    alt="{{ $item->car->model }}" class="rounded-3 me-3"
                                                    style="width: 64px; height: 64px; object-fit: cover;">
                                                <div>
                                                    <h6 class="fw-bold mb-1">{{ $item->car->model }}</h6>
                                                    <span class="text-muted">{{ $item->car->brand->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="price-per-day fw-semibold">
                                            Rp.{{ number_format($item->car->harga_sewa, 2) }}
                                        </td>
                                        <td style="min-width: 300px;">
                                            <div class="row g-2">
                                                <div class="col-sm-6">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control rent-start"
                                                            id="rent_start_{{ $loop->index }}" min="{{ date('Y-m-d') }}"
                                                            name="rent_start" required autocomplete="off">
                                                        <label for="rent_start_{{ $loop->index }}">Start Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control rent-end"
                                                            id="rent_end_{{ $loop->index }}" min="{{ date('Y-m-d') }}"
                                                            name="rent_end" required autocomplete="off">
                                                        <label for="rent_end_{{ $loop->index }}">End Date</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="rental-duration mt-2 small text-muted"></div>
                                        </td>
                                        <td>
                                            <div class="total-price fw-bold text-primary">Rp.0</div>
                                        </td>
                                        <td class="text-center">
                                            <form action="" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    data-bs-toggle="tooltip" title="Remove from list">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pt-4 mt-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label class="form-label fw-bold">Payment Method</label>
                                    <select class="form-select" id="payment_method">
                                        @foreach ($paymentMethods as $paymentMethod)
                                            <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }} (Manual)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end">
                                    <div class="text-muted mb-2">Total Amount</div>
                                    <h3 class="mb-3" id="total-price">Rp.0</h3>
                                    <button type="button" class="btn btn-primary mt-3" id="checkout">
                                        <i class="fa fa-check me-2"></i>Proceed to Checkout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('css')
    @vite('resources/scss/booking-list.scss')
@endpush

@push('js')
    @vite('resources/js/booking-list.js')
@endpush
