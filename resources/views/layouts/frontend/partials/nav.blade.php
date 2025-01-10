<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand fs-4 text-capitalize" href="{{ route('welcome') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <ul class="navbar-nav me-4 mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('car-list') }}">Car List</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="/calculate-price">Calculate Price</a>
                </li> --}}
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
                <a href="{{ route('register') }}" class="btn btn-warning">Get Started</a>
            @endguest
            @auth
                @if (auth()->user()->role_id != 'admin')
                    <a href="{{ route('booking-list.index') }}" class="btn btn-outline-info me-2"><i
                            class="fa fa-shopping-cart"></i></a>
                @endif
                <a href="{{ auth()->user()->role_id == 'admin' ? route('dashboard') : route('user.dashboard') }}"
                    class="btn btn-outline-primary">Dashboard</a>
            @endauth
        </div>
    </div>
</nav>
@auth
    @if (auth()->user()->role_id == 'user')
        @if (
            \App\Models\UserDetail::where('user_id', auth()->user()->id)->where(function ($query) {
                    $query->whereNull('phone')->orWhereNull('address')->orWhereNull('id_card')->orWhereNull('bank_name')->orWhereNull('account_name')->orWhereNull('account_number');
                })->exists())
            <div class="container-fluid py-2 text-center bg-warning">
                <i class="fa fa-exclamation-circle me-2"></i>
                <p class="d-inline">Please complete your user data verification to ensure full access to all features.
                    <a href="{{ route('profile.user') }}" class="text-decoration-underline">Click here</a>
                </p>
            </div>
        @endif
    @endif

@endauth
