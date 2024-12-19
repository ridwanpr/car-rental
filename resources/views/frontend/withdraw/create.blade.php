@extends('layouts.frontend.app')
@section('content')
    <div class="container py-5 min-vh-100">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="h3 mb-0 text-gray-800">Withdrawal Balance</h1>
            <a href="{{ route('withdraw.index') }}" class="btn btn-outline-primary">
                <span class="text-primary"><i class="fas fa-arrow-left"></i> Back to List</span>
            </a>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <div class="alert alert-info mb-4">
                    <strong>Current Balance:</strong> Rp {{ number_format($userBalance, 0, ',', '.') }}
                    <br>
                    <small>Minimum withdrawal amount: Rp 10,000</small>
                </div>

                <form action="{{ route('withdraw.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount"
                                name="amount" min="10000" max="{{ $userBalance }}" value="{{ old('amount') }}"
                                required>
                        </div>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
