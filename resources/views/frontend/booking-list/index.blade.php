@extends('layouts.frontend.app')
@section('content')
    <div class="container my-5">
        <h3 class="mb-4">Your Booking List</h3>

        @if ($bookingLists->isEmpty())
            <div class="alert alert-warning" role="alert">
                Your booking list is empty. Please add cars to your booking list before proceeding.
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Car List</h5>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-link btn-sm">Dashboard</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Car Model</th>
                                    <th>Brand</th>
                                    <th>Quantity</th>
                                    <th>Price per Day</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookingLists as $item)
                                    <tr>
                                        <td>{{ $item->car->model }}</td>
                                        <td>{{ $item->car->brand->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rp.{{ number_format($item->car->harga_sewa, 2) }}</td>
                                        <td>Rp.{{ number_format($item->quantity * $item->car->harga_sewa, 2) }}</td>
                                        <td>
                                            <form action="" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <h4>Total: <span id="total-price"></span></h4>
                        <a href="" class="btn btn-primary">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('css')
    <style>
        .table th,
        .table td {
            text-align: center;
        }
    </style>
@endpush

@push('js')
    @vite('resources/js/booking-list.js')
@endpush
