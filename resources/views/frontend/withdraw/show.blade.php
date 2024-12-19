@extends('layouts.frontend.app')
@section('content')
    <div class="container py-5 min-vh-100">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="h3 mb-0 text-gray-800">Withdrawal Details</h1>
            <a href="{{ route('withdraw.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title mb-4">Request Information</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th class="bg-light" width="40%">Request ID</th>
                                <td>{{ $withdraw->id }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Amount</th>
                                <td>Rp {{ number_format($withdraw->amount, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Bank Name</th>
                                <td>{{ $userDetail->bank_name }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Account Number</th>
                                <td>{{ $userDetail->account_number }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Account Name</th>
                                <td>{{ $userDetail->account_name }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Status</th>
                                <td>
                                    <span
                                        class="badge bg-{{ $withdraw->status === 'pending' ? 'warning' : ($withdraw->status === 'approved' ? 'success' : 'danger') }}">
                                        {{ ucfirst($withdraw->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light">Request Date</th>
                                <td>{{ $withdraw->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                            @if ($withdraw->updated_at != $withdraw->created_at)
                                <tr>
                                    <th class="bg-light">Last Updated</th>
                                    <td>{{ $withdraw->updated_at->format('d M Y, H:i') }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h5 class="card-title mb-4">Transfer Information</h5>
                        @if ($withdraw->proof)
                            <div class="card">
                                <div class="card-body bg-light">
                                    <h6 class="card-subtitle mb-3 text-muted">Transfer Proof</h6>
                                    <p class="card-text">{{ $withdraw->proof }}</p>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> Transfer proof will be added by admin after processing
                                your withdrawal request.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
