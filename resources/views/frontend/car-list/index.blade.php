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

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('assets/img/hero_car.png') }}" class="card-img-top" alt="Car 1">
                        <div class="card-body">
                            <h5 class="card-title">Toyota Camry 2024</h5>
                            <p class="card-text text-muted">
                                <i class="bi bi-gear"></i> Automatic •
                                <i class="bi bi-people"></i> 5 Seats •
                                <i class="bi bi-fuel-pump"></i> Hybrid
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0">Rp. 200.000 / day</span>
                                <button class="btn btn-primary">Rent Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('assets/img/hero_car.png') }}" class="card-img-top" alt="Car 2">
                        <div class="card-body">
                            <h5 class="card-title">Honda CR-V</h5>
                            <p class="card-text text-muted">
                                <i class="bi bi-gear"></i> Automatic •
                                <i class="bi bi-people"></i> 5 Seats •
                                <i class="bi bi-fuel-pump"></i> Gasoline
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0">Rp. 300.000 / day</span>
                                <button class="btn btn-primary">Rent Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('assets/img/hero_car.png') }}" class="card-img-top" alt="Car 3">
                        <div class="card-body">
                            <h5 class="card-title">Tesla Model 3</h5>
                            <p class="card-text text-muted">
                                <i class="bi bi-gear"></i> Automatic •
                                <i class="bi bi-people"></i> 5 Seats •
                                <i class="bi bi-battery-charging"></i> Electric
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0">Rp. 400.000 / day</span>
                                <button class="btn btn-primary">Rent Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('assets/img/hero_car.png') }}" class="card-img-top" alt="Car 1">
                        <div class="card-body">
                            <h5 class="card-title">Toyota Camry 2024</h5>
                            <p class="card-text text-muted">
                                <i class="bi bi-gear"></i> Automatic •
                                <i class="bi bi-people"></i> 5 Seats •
                                <i class="bi bi-fuel-pump"></i> Hybrid
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0">Rp. 200.000 / day</span>
                                <button class="btn btn-primary">Rent Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('assets/img/hero_car.png') }}" class="card-img-top" alt="Car 2">
                        <div class="card-body">
                            <h5 class="card-title">Honda CR-V</h5>
                            <p class="card-text text-muted">
                                <i class="bi bi-gear"></i> Automatic •
                                <i class="bi bi-people"></i> 5 Seats •
                                <i class="bi bi-fuel-pump"></i> Gasoline
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0">Rp. 300.000 / day</span>
                                <button class="btn btn-primary">Rent Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('assets/img/hero_car.png') }}" class="card-img-top" alt="Car 3">
                        <div class="card-body">
                            <h5 class="card-title">Tesla Model 3</h5>
                            <p class="card-text text-muted">
                                <i class="bi bi-gear"></i> Automatic •
                                <i class="bi bi-people"></i> 5 Seats •
                                <i class="bi bi-battery-charging"></i> Electric
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0">Rp. 400.000 / day</span>
                                <button class="btn btn-primary">Rent Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('assets/img/hero_car.png') }}" class="card-img-top" alt="Car 1">
                        <div class="card-body">
                            <h5 class="card-title">Toyota Camry 2024</h5>
                            <p class="card-text text-muted">
                                <i class="bi bi-gear"></i> Automatic •
                                <i class="bi bi-people"></i> 5 Seats •
                                <i class="bi bi-fuel-pump"></i> Hybrid
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0">Rp. 200.000 / day</span>
                                <button class="btn btn-primary">Rent Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('assets/img/hero_car.png') }}" class="card-img-top" alt="Car 2">
                        <div class="card-body">
                            <h5 class="card-title">Honda CR-V</h5>
                            <p class="card-text text-muted">
                                <i class="bi bi-gear"></i> Automatic •
                                <i class="bi bi-people"></i> 5 Seats •
                                <i class="bi bi-fuel-pump"></i> Gasoline
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0">Rp. 300.000 / day</span>
                                <button class="btn btn-primary">Rent Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('assets/img/hero_car.png') }}" class="card-img-top" alt="Car 3">
                        <div class="card-body">
                            <h5 class="card-title">Tesla Model 3</h5>
                            <p class="card-text text-muted">
                                <i class="bi bi-gear"></i> Automatic •
                                <i class="bi bi-people"></i> 5 Seats •
                                <i class="bi bi-battery-charging"></i> Electric
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0">Rp. 400.000 / day</span>
                                <button class="btn btn-primary">Rent Now</button>
                            </div>
                        </div>
                    </div>
                </div>

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
