@extends('layouts.frontend.app')
@section('content')
    <div class="container mt-4">
        <!-- Carousel Section -->
        <div class="shadow-sm rounded">
            <div id="carCarouselImage" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carCarouselImage" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carCarouselImage" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carCarouselImage" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    @foreach ($car->images as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ asset('storage/cars/' . $image->image) }}" class="d-block w-100 rounded"
                                alt="car images">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carCarouselImage"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carCarouselImage"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body py-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="card-title display-5 mb-0 fw-bold">{{ $car->brand->name }} {{ $car->model }}</h2>
                            <span class="badge bg-primary rounded-pill fs-4 px-4">Rp.
                                {{ number_format($car->harga_sewa, 0, ',', ',') }} / day</span>
                        </div>
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <div class="card h-100 bg-light border-0">
                                    <div class="card-body py-4">
                                        <div class="d-flex align-items-center mb-4">
                                            <i class="bi bi-gear-fill text-primary display-5 me-3"></i>
                                            <div>
                                                <h6 class="text-muted text-uppercase mb-1">Transmission</h6>
                                                <span class="fs-4 fw-medium text-capitalize">{{ $car->transmission }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-fuel-pump-fill text-primary display-5 me-3"></i>
                                            <div>
                                                <h6 class="text-muted text-uppercase mb-1">Fuel Type</h6>
                                                <span class="fs-4 fw-medium text-capitalize">{{ $car->bahan_bakar }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100 bg-light border-0">
                                    <div class="card-body py-4">
                                        <div class="d-flex align-items-center mb-4">
                                            <i class="bi bi-people-fill text-primary display-5 me-3"></i>
                                            <div>
                                                <h6 class="text-muted text-uppercase mb-1">Capacity</h6>
                                                <span class="fs-4 fw-medium text-capitalize">{{ $car->jumlah_kursi }}
                                                    Seats</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-fill text-primary display-5 me-3"></i>
                                            <div>
                                                <h6 class="text-muted text-uppercase mb-1">Year</h6>
                                                <span class="fs-4 fw-medium text-capitalize">{{ $car->tahun }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-primary border-0 text-white mb-4">
                            <div class="card-body py-4">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h3 class="fs-4 mb-2">Ready to rent this car?</h3>
                                        <p class="mb-md-0">Book now and get confirmation for your rental</p>
                                    </div>
                                    <div class="col-md-4 text-md-end d-flex justify-content-end">
                                        <button class="btn btn-success btn-lg me-2" id="addToBookingList"
                                            data-car-id="{{ $car->id }}" data-car-brand="{{ $car->brand->name }}"
                                            data-car-model="{{ $car->model }}"
                                            @if ($isInBookingList) disabled @endif>
                                            <i class="fa-solid fa-cart-plus"></i> <span class="text-nowrap">
                                                @if ($isInBookingList)
                                                    Car in Booking List
                                                @else
                                                    Add to Booking List
                                                @endif
                                            </span>
                                        </button>
                                        <a href="" class="btn btn-white btn-lg">
                                            <i class="fa-solid fa-arrow-right"></i> <span class="text-nowrap">Book
                                                Now</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body py-4">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-car-front-fill text-primary display-5 me-3"></i>
                                    <div>
                                        <h6 class="text-muted text-uppercase mb-1">License Plate</h6>
                                        <span class="fs-4 fw-medium text-capitalize">{{ $car->plat_nomor }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

        .notyf__toast {
            position: fixed;
            top: 10px;
            right: 10px;
        }
    </style>
@endpush

@push('js')
    @vite(['resources/js/booking.js'])
@endpush
