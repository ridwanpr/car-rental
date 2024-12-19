@extends('layouts.frontend.app')
@section('content')
    <div class="container py-5 min-vh-100">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="h3 mb-0 text-gray-800">Rental List</h1>
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
                    <h5 class="mb-0">Rental List</h5>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="datatable">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0">#</th>
                                <th class="border-0">Payment Code</th>
                                <th class="border-0">Rental Code</th>
                                <th class="border-0">Status</th>
                                <th class="border-0">Car</th>
                                <th class="border-0">Rent Date</th>
                                <th class="border-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($rents as $rent)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $rent->payment_code }}</td>
                                    <td>{{ $rent->rental_code }}</td>
                                    <td>
                                        @if ($rent->rent_status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif ($rent->rent_status == 'approved')
                                            <span class="badge bg-success">Approved - Ongoing</span>
                                        @elseif ($rent->rent_status == 'declined')
                                            <span class="badge bg-danger">Declined</span>
                                        @else
                                            <span class="badge bg-info">Completed - Returned</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('car-list.show', $rent->slug) }}" target="_blank"
                                            class="text-info text-decoration-underline">{{ $rent->car->brand->name }}
                                            {{ $rent->car->model }}</a>
                                    </td>
                                    <td>
                                        {{ date('d M Y', strtotime($rent->rent_start)) }} -
                                        {{ date('d M Y', strtotime($rent->rent_end)) }}
                                    </td>
                                    <td>
                                        <a href="{{ route('rent-list.show', $rent->rent_id) }}"
                                            class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
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
