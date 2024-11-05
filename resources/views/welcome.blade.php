@extends('layouts.frontend.app')
@section('content')
    <!-- Hero -->
    <section class="hero bg-primary text-white pt-4 pb-4">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6">
                    <p class="fs-1 fw-bold">Find, book, and <br> rental car in <span
                            class="text-warning text-decoration-underline">Easy</span> <br>
                        steps.</p>
                    <p class="fs-6 fw-light">Get a car wherever and whenever you need it by using <br> our service.</p>
                </div>
                <div class="col-md-6">
                    <div class="hero-img-wrapper">
                        <img src="assets/img/hero_car.png" alt="hero car image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Search -->
    <section class="quick-search mt-n4">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="row justify-content-around">
                            <div class="col-md-3">
                                <label for="carBrand" class="form-label">Car Brand</label>
                                <select class="form-select" id="carBrand">
                                    <option selected>Car Brand</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="seats" class="form-label">Number of Seats</label>
                                <select class="form-select" id="seats">
                                    <option selected>Number of Seats</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="pickupDate" class="form-label">Pickup Date</label>
                                <input type="date" class="form-control" id="pickupDate" name="pickupDate">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <button class="btn btn-primary w-100" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Steps -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Hassle-free booking</h2>
                <p class="text-muted">Rent in 3 Simple Steps</p>
            </div>

            <div class="row g-4">
                <!-- Step 1 -->
                <div class="col-12 col-md-4">
                    <div class="bg-primary bg-opacity-10 rounded-3 p-4 text-center h-100">
                        <i class="fa-solid fa-location-dot fa-2x text-primary mb-4"></i>
                        <h3 class="fs-4 fw-semibold mb-3">Choose Location</h3>
                        <p class="text-muted mb-0">Choose your location and find the best car.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="col-12 col-md-4">
                    <div class="bg-primary bg-opacity-10 rounded-3 p-4 text-center h-100">
                        <i class="fa-solid fa-calendar-days fa-2x text-primary mb-4"></i>
                        <h3 class="fs-4 fw-semibold mb-3">Pickup Date</h3>
                        <p class="text-muted mb-0">Select a pickup date to book your car.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="col-12 col-md-4">
                    <div class="bg-primary bg-opacity-10 rounded-3 p-4 text-center h-100">
                        <i class="fa-solid fa-car-side fa-2x text-primary mb-4"></i>
                        <h3 class="fs-4 fw-semibold mb-3">Book Your Car</h3>
                        <p class="text-muted mb-0">Book your car and we will deliver it to you.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Car List -->
    <section class="car-list bg-light py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Featured Cars</h2>
                <p class="text-muted">Choose from our selection of premium vehicles</p>
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

            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Testimonials</h2>
                <p class="text-muted">What Our Clients Say</p>
            </div>

            <!-- Testimonials Row -->
            <div class="row g-4 justify-content-center">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 p-xl-5">
                            <div class="mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="text-muted mb-4">"Exceptional service! The car was in perfect condition, and the
                                rental process was smooth and hassle-free. Will definitely use their service again."</p>
                            <div>
                                <div>
                                    <h6 class="fw-bold mb-0">John Smith</h6>
                                    <p class="text-muted">Business Executive</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 p-xl-5">
                            <div class="mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="text-muted mb-4">"The best car rental experience I've ever had. The staff was
                                friendly and professional, and the prices were very competitive. Highly recommended!"</p>
                            <div>
                                <h6 class="fw-bold mb-0">Sarah Johnson</h6>
                                <p class="text-muted">Travel Blogger</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 p-xl-5">
                            <div class="mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="text-muted mb-4">"Clean cars, transparent pricing, and excellent customer service.
                                They made my family vacation even more enjoyable. Thank you!"</p>
                            <div>
                                <div>
                                    <h6 class="fw-bold mb-0">Michael Chen</h6>
                                    <p class="text-muted">Family Traveler</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light pt-5 pb-4">
        <div class="container">
            <div class="row gy-4">
                <!-- Company Info -->
                <div class="col-12 col-lg-4 pe-lg-5">
                    <h5 class="h4 text-white mb-3">CarRental</h5>
                    <p class="text-muted mb-4">We offer a big range of vehicles for all your driving needs. We have the
                        perfect car to meet your needs.</p>
                    <div class="mb-4">
                        <a href="#" class="text-muted text-decoration-none me-3">
                            <i class="fa-solid fa-phone me-2"></i>
                            (123) 456-7890
                        </a>
                        <br class="d-block d-sm-none">
                        <a href="#" class="text-muted text-decoration-none">
                            <i class="fa-solid fa-envelope me-2"></i>
                            contact@carrental.com
                        </a>
                    </div>
                </div>

                <!-- Company Links -->
                <div class="col-6 col-md-3 col-lg-2">
                    <h6 class="text-white mb-3">Company</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">About Us</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Careers</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Blog</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Press</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Contact</a></li>
                    </ul>
                </div>

                <!-- Support Links -->
                <div class="col-6 col-md-3 col-lg-2">
                    <h6 class="text-white mb-3">Support</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Help Center</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Terms of Service</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Privacy Policy</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">FAQs</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Site Map</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="col-12 col-md-6 col-lg-4">
                    <h6 class="text-white mb-3">Newsletter</h6>
                    <p class="text-muted mb-3">Subscribe to our newsletter for updates and exclusive offers!</p>
                    <form class="mb-4">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email">
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                    <!-- Social Media Links -->
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-dark btn-sm rounded-circle border">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-dark btn-sm rounded-circle border">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-dark btn-sm rounded-circle border">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-dark btn-sm rounded-circle border">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <hr class="my-4 border-secondary">

            <!-- Bottom Footer -->
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="text-muted mb-0">&copy; 2024 CarRental. All rights reserved.</p>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline text-center text-md-end mb-0">
                        <li class="list-inline-item">
                            <a href="#" class="text-muted text-decoration-none">Terms</a>
                        </li>
                        <li class="list-inline-item ms-3">
                            <a href="#" class="text-muted text-decoration-none">Privacy</a>
                        </li>
                        <li class="list-inline-item ms-3">
                            <a href="#" class="text-muted text-decoration-none">Security</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
@endsection
