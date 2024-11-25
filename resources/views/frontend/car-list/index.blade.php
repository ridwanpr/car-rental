@extends('layouts.frontend.app')
@section('content')
    <!-- Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/img/car1.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/img/car2.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/img/car3.jpg') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Car List -->
    <section class="car-list bg-light py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Car List</h2>
                <p class="text-muted">Choose from our selection of high quality vehicles</p>
            </div>

            <div class="row g-4">
                @foreach ($cars as $car)
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
                                        <span class="h5 mb-0">Rp. {{ number_format($car->harga_sewa, 0, ',', ',') }} / day</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
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
