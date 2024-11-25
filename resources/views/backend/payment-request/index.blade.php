@extends('layouts.backend.app')
@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Payment Request</a></li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Payment Request</h1>
                <p class="mb-0">Here is a list of all Payment request. You can approve or decline Payment request.</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow mb-4">
        <div class="card-header">
            <h2 class="h5 mb-0">Request List</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded" id="datatable">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start text-center">#</th>
                            <th class="border-0 text-center">Payment Code</th>
                            <th class="border-0 text-center">Total Amount</th>
                            <th class="border-0 text-center">Status</th>
                            <th class="border-0 text-center">Payment Method</th>
                            <th class="border-0 text-center">Account Name</th>
                            <th class="border-0 text-center">Account Number</th>
                            <th class="border-0 text-center">Bank Name</th>
                            <th class="border-0 rounded-end text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $payment->payment_code }}</td>
                                <td class="text-center">{{ $payment->total_amount }}</td>
                                <td class="text-center">
                                    @if ($payment->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($payment->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif ($payment->status == 'declined')
                                        <span class="badge bg-danger">Declined</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $payment->paymentMethod->name }}</td>
                                <td class="text-center">{{ $payment->paymentMethod->account_name }}</td>
                                <td class="text-center">{{ $payment->paymentMethod->account_number }}</td>
                                <td class="text-center">{{ $payment->paymentMethod->bank_name }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#paymentModal" id="viewPaymentButton"
                                        data-payment-id="{{ $payment->id }}"><i class="fa fa-eye"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
@push('modals')
    @include('backend.payment-request.show')
@endpush
@push('css')
    <style>
        .modal-content {
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            border: none;
            border-bottom: 1px solid #f1f3f5;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .btn-approve {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-decline {
            background-color: #dc3545;
            border-color: #dc3545;
        }
    </style>
@endpush
@push('js')
    @vite('resources/js/payment-request.js')
@endpush
