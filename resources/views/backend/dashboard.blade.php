@extends('layouts.backend.app')

@section('content')
    <div class="py-1">
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
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Dashboard</h1>
                <p class="mb-3">Welcome to Ambatucar admin.</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 mb-3 mb-md-0">
                <div class="card border-0 shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                                    <i class="fas fa-car text-primary fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Active Rentals</h6>
                                <h2 class="mb-0 fs-5">{{ $countActiveRental }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <div class="card border-0 shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="rounded-circle bg-success bg-opacity-10 p-3">
                                    <i class="fas fa-history text-success fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Completed Rentals</h6>
                                <h2 class="mb-0 fs-5">{{ $countCompletedRental }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <div class="card border-0 shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="rounded-circle bg-secondary bg-opacity-10 p-3">
                                    <i class="fas fa-tags text-secondary fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Total Car Brands</h6>
                                <h2 class="mb-0 fs-5">{{ $countTotalCarBrands }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <div class="card border-0 shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="rounded-circle bg-danger bg-opacity-10 p-3">
                                    <i class="fas fa-car-side text-danger fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Total Car Units</h6>
                                <h2 class="mb-0 fs-5">{{ $countTotalCars }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="mb-3">
                    <div class="card border-0 shadow-sm h-100 py-2">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="rounded-circle bg-warning bg-opacity-10 p-2">
                                        <i class="fas fa-coins text-warning fs-5"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">Revenue Generated</h6>
                                    <h2 class="mb-0 text-nowrap overflow-hidden text-truncate fs-5">Rp
                                        {{ number_format($sumRevenueGenerated, 0, ',', '.') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="card border-0 shadow-sm h-100 py-2">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="rounded-circle bg-info bg-opacity-10 p-2">
                                        <i class="fas fa-clock text-info fs-5"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">Pending Payments</h6>
                                    <h2 class="mb-0 fs-5">{{ $countPendingPayment }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="card border-0 shadow-sm h-100 py-2">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="rounded-circle bg-secondary bg-opacity-10 p-2">
                                        <i class="fas fa-users text-secondary fs-5"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">Total Users</h6>
                                    <h2 class="mb-0 fs-5">{{ $countTotalUsers }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Revenue Overview</h5>
                        <canvas id="chartjs-dashboard"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('chartjs-dashboard').getContext('2d');
            const months = @json($months);
            const revenues = @json($revenuesData); 

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months, 
                    datasets: [{
                        label: 'Revenue',
                        data: revenues,
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.2)',
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endpush
