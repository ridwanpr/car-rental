<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand fs-4 text-capitalize" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>

            <!-- Login Button -->
            <ul class="navbar-nav me-4 mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('car-list') }}">Car List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/calculate-price">Calculate Price</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        About
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('terms') }}" target="_blank">TOS</a></li>
                        <li><a class="dropdown-item" href="{{ route('privacy') }}" target="_blank">Privacy Policy</a>
                        </li>
                    </ul>
                </li>
            </ul>
            @guest
                <a href="{{ route('register') }}" class="btn btn-outline-primary">Get Started</a>
            @endguest
            @auth
                <a href="{{ route('booking-list.index') }}" class="btn btn-outline-info me-2"><i class="fa fa-list"></i></a>
                <a href="{{ auth()->user()->role_id == 'admin' ? route('dashboard') : route('user.dashboard') }}"
                    class="btn btn-outline-primary">Dashboard</a>
            @endauth
        </div>
    </div>
</nav>
