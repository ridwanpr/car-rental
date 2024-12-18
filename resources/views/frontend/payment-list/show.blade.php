@extends('layouts.frontend.app')
@section('content')
    <div class="container py-5 min-vh-100">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="h3 mb-0 text-gray-800">Payment Details</h1>
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

        {{-- Content --}}
    </div>
@endsection

@push('css')
    @vite(['resources/scss/user-dashboard.scss'])
@endpush
