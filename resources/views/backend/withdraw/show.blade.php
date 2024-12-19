@extends('layouts.backend.app')
@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('withdraw-request.index') }}">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('withdraw-request.index') }}">Withdraw Requests</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow mb-4">
        <div class="card-header">
            <h2 class="h5 mb-0">Withdrawal Request Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="text-primary">User Information</h5>
                    <p><strong>Name:</strong> {{ $withdraw->name }}</p>
                    <p><strong>Phone:</strong> {{ $withdraw->phone }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <h5 class="text-primary">Bank Details</h5>
                    <ul class="list-unstyled">
                        <li><strong>Bank Name:</strong> {{ $withdraw->bank_name }}</li>
                        <li><strong>Account Number:</strong> {{ $withdraw->account_number }}</li>
                        <li><strong>Account Name:</strong> {{ $withdraw->account_name }}</li>
                    </ul>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-primary">Withdrawal Details</h5>
                    <p><strong>Amount:</strong> Rp {{ number_format($withdraw->amount, 0, ',', '.') }}</p>
                    <p><strong>Status:</strong>
                        <span
                            class="badge bg-{{ $withdraw->status === 'pending' ? 'warning' : ($withdraw->status === 'transferred' ? 'success' : 'danger') }}">
                            {{ ucfirst($withdraw->status) }}
                        </span>
                    </p>
                </div>

                <div class="col-md-6">
                    @if ($withdraw->proof)
                        <h5 class="text-primary">Transfer Proof</h5>
                        <img src="{{ asset('storage/' . $withdraw->proof) }}" alt="Proof Image"
                            class="img-fluid rounded shadow" style="max-height: 250px">
                    @elseif($withdraw->status === 'pending')
                        <h5 class="text-primary">Upload Proof</h5>
                        <form action="{{ route('withdraw-request.update', $withdraw->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="proof" class="form-label">Upload Proof</label>
                                <input type="file" class="form-control" id="proof" name="proof" accept="image/*"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Upload</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
