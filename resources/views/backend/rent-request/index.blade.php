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
                <li class="breadcrumb-item"><a href="javascript:void(0);">Rent Request</a></li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Rent Request</h1>
                <p class="mb-0">Here is a list of all rent request. You can approve or decline rent request.</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow mb-4">
        <div class="card-header">
            <h2 class="h5 mb-0">Car List</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-centered table-nowrap mb-0 rounded" id="datatable">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start text-center">#</th>
                            <th class="border-0 text-center">Payment Code</th>
                            <th class="border-0 text-center">Payment Method</th>
                            <th class="border-0 text-center">Total Amount</th>
                            <th class="border-0 text-center">Status</th>
                            <th class="border-0 text-center">Rental Code</th>
                            <th class="border-0 text-center">Car Details</th>
                            <th class="border-0 text-center">Rent Date</th>
                            <th class="border-0 rounded-end text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                            @foreach ($request->rent as $rent)
                                <tr>
                                    <td class="text-center">{{ $loop->parent->iteration }}</td>
                                    <td class="text-center">{{ $request->payment_code }}</td>
                                    <td class="text-center">{{ $request->paymentMethod->name }}</td>
                                    <td class="text-center">Rp. {{ number_format($request->total_amount, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        @if ($request->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif ($request->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif ($request->status == 'declined')
                                            <span class="badge bg-danger">Declined</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $rent->rental_code }}</td>
                                    <td class="text-center">
                                        {{ $rent->car->brand->name }} - {{ $rent->car->model }}<br>
                                        Rp. {{ number_format($rent->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">{{ $rent->rent_start }} to {{ $rent->rent_end }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm">View</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
@push('modals')
@endpush
@push('js')
    <script></script>
@endpush
