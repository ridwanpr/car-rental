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
                <li class="breadcrumb-item"><a href="#">Report</a></li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between w-100 flex-wrap mb-4">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Car Rental Report</h1>
                <p class="mb-0">This report contains information about car rentals, rental status, penalties, and other
                    details.</p>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Rental Data</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <form id="filterForm" method="GET" action="{{ route('report.index') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="startDate">Start Date</label>
                                <input type="date" class="form-control" id="startDate" name="startDate"
                                    value="{{ $startDate }}">
                            </div>
                            <div class="col-md-3">
                                <label for="endDate">End Date</label>
                                <input type="date" class="form-control" id="endDate" name="endDate"
                                    value="{{ $endDate }}">
                            </div>
                            <div class="col-md-3">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">All</option>
                                    <option value="returned" {{ $status == 'returned' ? 'selected' : '' }}>Returned</option>
                                    <option value="declined" {{ $status == 'declined' ? 'selected' : '' }}>Declined</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary" id="filterButton">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="mb-4">
                    <form id="exportForm" method="GET" action="{{ route('report.exportPdf') }}" target="_blank"
                        class="d-inline">
                        <input type="hidden" name="startDate" value="{{ $startDate }}">
                        <input type="hidden" name="endDate" value="{{ $endDate }}">
                        <input type="hidden" name="status" value="{{ $status }}">
                        <button type="submit" class="btn btn-danger" id="exportPdfButton">
                            <i class="fas fa-file-pdf"></i> Export to PDF
                        </button>
                    </form>
                    <form id="exportExcelForm" method="GET" action="{{ route('report.exportExcel') }}" target="_blank"
                        class="d-inline">
                        <input type="hidden" name="startDate" value="{{ $startDate }}">
                        <input type="hidden" name="endDate" value="{{ $endDate }}">
                        <input type="hidden" name="status" value="{{ $status }}">
                        <button type="submit" class="btn btn-success text-white" id="exportExcelButton">
                            <i class="fas fa-file-excel"></i> Export to Excel
                        </button>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="rentalTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Payment Code</th>
                                <th>Rental Code</th>
                                <th>Car Model</th>
                                <th>Rented By</th>
                                <th>Rent Start</th>
                                <th>Rent End</th>
                                <th>Return Date</th>
                                <th>Penalty</th>
                                <th>Status</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($rentals as $rental)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $rental->payment->payment_code }}</td>
                                    <td>{{ $rental->rental_code }}</td>
                                    <td>{{ $rental->car->model }}</td>
                                    <td>{{ $rental->user->name }}</td>
                                    <td>{{ $rental->rent_start }}</td>
                                    <td>{{ $rental->rent_end }}</td>
                                    <td>{{ $rental->return_date ?? '-' }}</td>
                                    <td>Rp. {{ number_format($rental->penalty_amount, 0, ',', '.') ?? 0 }}</td>
                                    <td><span class="text-capitalize">{{ $rental->status }}</span></td>
                                    <td>{{ \Illuminate\Support\Str::limit($rental->decline_message ?? '-', 50) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#exportExcelButton').on('click', function() {
                $('#exportExcelForm').submit();
            });

            $('#exportPdfButton').on('click', function() {
                $('#exportForm').submit();
            });
        });
    </script>
@endpush
