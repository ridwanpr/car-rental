@extends('layouts.frontend.app')
@section('content')
    <section class="car-list bg-light py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Car List</h2>
                <p class="text-muted">Choose from our selection of high quality vehicles</p>
            </div>

            <div class="row g-4">
                @forelse ($cars as $car)
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('car-list.show', $car->slug) }}">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('storage/cars/' . $car->images->firstWhere('is_primary', 1)->image) }}"
                                    class="card-img-top" alt="Car 2">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $car->brand->name }} {{ $car->model }}</h5>
                                    <p class="card-text text-muted text-capitalize">
                                        <i class="bi bi-gear"></i> {{ $car->transmission }} •
                                        <i class="bi bi-people"></i> {{ $car->jumlah_kursi }} Seats •
                                        <i class="bi bi-fuel-pump"></i> {{ $car->bahan_bakar }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="h5 mb-0">Rp. {{ number_format($car->harga_sewa, 0, ',', ',') }} /
                                            day</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle me-2"></i>
                            No cars found.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
@push('css')
    <style>
        .carousel-inner {
            height: 450px
        }

        .carousel-item {
            height: 100%
        }

        .carousel-item img {
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        @media (max-width: 768px) {
            .carousel-inner {
                height: 300px;
            }
        }
    </style>
@endpush
