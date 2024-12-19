@extends('layouts.frontend.app')
@section('content')
    <div class="container py-5 min-vh-100">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="h3 mb-0 text-gray-800">Withdraw</h1>
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
                            <a href="{{ route('user.dashboard') }}"
                                class="text-decoration-none text-{{ request()->routeIs('user.dashboard') ? 'info' : 'dark' }}">Dashboard</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('payment-list.index') }}"
                                class="text-decoration-none text-{{ request()->routeIs('payment-list.index') ? 'info' : 'dark' }}">Payment
                                List</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('rent-list.index') }}"
                                class="text-decoration-none text-{{ request()->routeIs('rent-list.index') ? 'info' : 'dark' }}">Rent
                                List</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('profile') }}"
                                class="text-decoration-none text-{{ request()->routeIs('profile') ? 'info' : 'dark' }}">Profile</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('withdraw.index') }}"
                                class="text-decoration-none text-{{ request()->routeIs('withdraw.index') ? 'info' : 'dark' }}">Withdraw
                                Balance</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-5">
            <div class="card-header bg-white py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Withdraw List</h5>
                    <a href="{{ route('withdraw.create') }}" class="btn btn-primary btn-sm">Withdraw</a>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="datatable">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0">#</th>
                                <th class="border-0">Amount</th>
                                <th class="border-0">Status</th>
                                <th class="border-0">Created At</th>
                                <th class="border-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($withdraws as $withdraw)
                                <tr>
                                    <td class="border-0">{{ ++$count }}</td>
                                    <td class="border-0">Rp. {{ number_format($withdraw->amount, 0, ',', '.') }}</td>
                                    <td class="border-0">
                                        @if ($withdraw->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @else
                                            <span class="badge bg-success">Withdrawed</span>
                                        @endif
                                    </td>
                                    <td class="border-0">{{ $withdraw->created_at->format('d-m-Y H:i') }}</td>
                                    <td class="border-0">
                                        <a href="" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
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
