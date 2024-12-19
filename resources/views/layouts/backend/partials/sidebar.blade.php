<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
    <a class="navbar-brand me-lg-5" href="{{ route('dashboard') }}">
        <svg xmlns="http://www.w3.org/2000/svg" x-bind:width="size" x-bind:height="size"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" x-bind:stroke-width="stroke" stroke-linecap="round"
            stroke-linejoin="round" width="24" height="24" stroke-width="2">
            <path d="M12 15h-6.5a2.5 2.5 0 1 1 0 -5h.5"></path>
            <path d="M15 12v6.5a2.5 2.5 0 1 1 -5 0v-.5"></path>
            <path d="M12 9h6.5a2.5 2.5 0 1 1 0 5h-.5"></path>
            <path d="M9 12v-6.5a2.5 2.5 0 0 1 5 0v.5"></path>
        </svg>
    </a>
    <div class="d-flex align-items-center">
        <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div
            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="avatar-lg me-4">
                    <img src="{{ asset('assets/img/user-icon.png') }}" class="card-img-top rounded-circle border-white"
                        alt="Bonnie Green">
                </div>
                <div class="d-block">
                    <h2 class="h5 mb-3">Hi, Jane</h2>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                            <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>
        <ul class="nav flex-column pt-3 pt-md-0">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center">
                    <span class="sidebar-icon text-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" x-bind:width="size"
                            x-bind:height="size" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            x-bind:stroke-width="stroke" stroke-linecap="round" stroke-linejoin="round" width="24"
                            height="24" stroke-width="2">
                            <path d="M12 15h-6.5a2.5 2.5 0 1 1 0 -5h.5"></path>
                            <path d="M15 12v6.5a2.5 2.5 0 1 1 -5 0v-.5"></path>
                            <path d="M12 9h6.5a2.5 2.5 0 1 1 0 5h-.5"></path>
                            <path d="M9 12v-6.5a2.5 2.5 0 0 1 5 0v.5"></path>
                        </svg>
                    </span>
                    <span class="mt-1 ms-1 sidebar-text fs-4">Ambatucar</span>
                </a>
            </li>
            <hr>
            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" x-bind:width="size"
                            x-bind:height="size" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            x-bind:stroke-width="stroke" stroke-linecap="round" stroke-linejoin="round" width="24"
                            height="24" stroke-width="2">
                            <path d="M3 3v18h18"></path>
                            <path d="M20 18v3"></path>
                            <path d="M16 16v5"></path>
                            <path d="M12 13v8"></path>
                            <path d="M8 16v5"></path>
                            <path d="M3 11c6 0 5 -5 9 -5s3 5 9 5"></path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('brand.index') ? 'active' : '' }}"">
                <a href="{{ route('brand.index') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" x-bind:width="size"
                            x-bind:height="size" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            x-bind:stroke-width="stroke" stroke-linecap="round" stroke-linejoin="round" width="24"
                            height="24" stroke-width="2">
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                            <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                            <path d="M12 14l0 7"></path>
                            <path d="M10 12l-6.75 -2"></path>
                            <path d="M14 12l6.75 -2"></path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Manage Brand</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('car.index') ? 'active' : '' }}">
                <a href="{{ route('car.index') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" x-bind:width="size"
                            x-bind:height="size" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            x-bind:stroke-width="stroke" stroke-linecap="round" stroke-linejoin="round"
                            width="24" height="24" stroke-width="2">
                            <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                            <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                            <path d="M5 17h-2v-6l2 -5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5"></path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Manage Cars</span>
                </a>
            </li>
            <li class="nav-item">
                <!-- Dropdown Toggler Button with Icons -->
                <span class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    data-bs-target="#submenu-components"
                    aria-expanded="{{ request()->routeIs('user.admin') ? 'true' : 'false' }}">
                    <span>
                        <span class="sidebar-icon">
                            <!-- SVG Icon for Sidebar (Person Icon) -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h2.5"></path>
                                <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M19.001 15.5v1.5"></path>
                                <path d="M19.001 21v1.5"></path>
                                <path d="M22.032 17.25l-1.299 .75"></path>
                                <path d="M17.27 20l-1.3 .75"></path>
                                <path d="M15.97 17.25l1.3 .75"></path>
                                <path d="M20.733 20l1.3 .75"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Manage User</span>
                    </span>
                    <span class="link-arrow">
                        <!-- SVG Icon for Arrow (Right Arrow) -->
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </span>

                <!-- Collapsible Dropdown Content -->
                <div class="multi-level collapse {{ request()->routeIs('admin.index') ? 'show' : '' }}"
                    id="submenu-components">
                    <ul class="flex-column nav">
                        <!-- Admin Link -->
                        <li class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.index') }}">
                                <span class="sidebar-text">Admin</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <span class="sidebar-text">Customer</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ request()->routeIs('payment-method.index') ? 'active' : '' }}">
                <a href="{{ route('payment-method.index') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" x-bind:width="size"
                            x-bind:height="size" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            x-bind:stroke-width="stroke" stroke-linecap="round" stroke-linejoin="round"
                            width="24" height="24" stroke-width="2">
                            <path d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5"></path>
                            <path d="M3 10h18"></path>
                            <path d="M16 19h6"></path>
                            <path d="M19 16l3 3l-3 3"></path>
                            <path d="M7.005 15h.005"></path>
                            <path d="M11 15h2"></path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Payment Method</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('payment-request.index') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" width="24"
                            height="24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"
                            stroke="currentColor">
                            <path d="M3 5m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z">
                            </path>
                            <path d="M3 10l18 0"></path>
                            <path d="M7 15l.01 0"></path>
                            <path d="M11 15l2 0"></path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Payment Request</span>
                    @php
                        $paymentRequests = \App\Models\Payment::where(function ($query) {
                            $query
                                ->where('payments.status', 'pending')
                                ->orWhere('payments.status', 'waiting confirmation');
                        })
                            ->where('payments.payment_proof', '!=', null)
                            ->count();
                    @endphp
                    <span
                        class="badge badge-sm bg-secondary ms-1 text-gray-800">{{ $paymentRequests ? $paymentRequests : '0' }}</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('rent-request.index') ? 'active' : '' }}">
                <a href="{{ route('rent-request.index') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" x-bind:width="size"
                            x-bind:height="size" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            x-bind:stroke-width="stroke" stroke-linecap="round" stroke-linejoin="round"
                            width="24" height="24" stroke-width="2">
                            <path
                                d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z">
                            </path>
                            <path d="M12 8v3"></path>
                            <path d="M12 14v.01"></path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Rent Request</span>
                    @php
                        $rentRequests = \App\Models\Rent::where('rents.status', 'pending')
                            ->join('payments', 'rents.payment_id', '=', 'payments.id')
                            ->where('payments.status', 'approved')
                            ->count();
                    @endphp
                    <span
                        class="badge badge-sm bg-secondary ms-1 text-gray-800">{{ $rentRequests ? $rentRequests : '0' }}</span>
                </a>
            </li>
            <li class="nav-item  {{ request()->routeIs('report.index') ? 'active' : '' }}">
                <a href="{{ route('report.index') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" x-bind:width="size"
                            x-bind:height="size" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            x-bind:stroke-width="stroke" stroke-linecap="round" stroke-linejoin="round"
                            width="24" height="24" stroke-width="2">
                            <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2">
                            </path>
                            <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                            </path>
                            <path d="M9 12h6"></path>
                            <path d="M9 16h6"></path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Report</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
