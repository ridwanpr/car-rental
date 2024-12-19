@extends('layouts.frontend.app')

@section('content')
    <div class="container py-5 min-vh-100">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
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

        <!-- Profile Edit Form -->
        <div class="card shadow-sm rounded">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            value="{{ old('phone', $userDetail->phone) }}">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control"
                            value="{{ old('address', $userDetail->address) }}">
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_card" class="form-label">ID Card (Image)</label>
                        <input type="file" name="id_card" id="id_card" class="form-control">
                        @if ($userDetail->id_card)
                            <img src="{{ route('profile.id-card') }}" alt="ID Card" class="mt-3 img-fluid"
                                style="max-height: 200px">
                        @endif
                        @error('id_card')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
    @vite(['resources/scss/user-dashboard.scss'])
@endpush
