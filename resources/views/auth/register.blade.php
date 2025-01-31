@extends('layouts.backend.guest')

@section('content')
    <main>
        <section class="mt-4 d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center mb-3">
                        <a href="{{ route('welcome') }}" class="d-inline-flex align-items-center justify-content-center">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Back to homepage
                        </a>
                    </div>
                </div>
                <div class="row justify-content-center form-bg-image">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 mb-4 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">Create Account</h1>
                            </div>
                            <form method="POST" action="{{ route('register') }}" class="mt-4">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="name">Your Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                width="24" height="24" stroke-width="3">
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>
                                                <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z">
                                                </path>
                                            </svg>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Full Name" name="name"
                                            id="name" autofocus required>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="email">Your Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                </path>
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                            </svg>
                                        </span>
                                        <input type="email" class="form-control" placeholder="Email" name="email"
                                            id="email" autofocus required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group mb-4">
                                        <label for="password">Your Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <svg class="icon icon-xs text-gray-600" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                            <input type="password" placeholder="Password" class="form-control"
                                                name="password" id="password" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <svg class="icon icon-xs text-gray-600" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                            <input type="password" placeholder="Confirm Password" class="form-control"
                                                name="password_confirmation" id="password_confirmation" required>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="remember"
                                                required>
                                            <label class="form-check-label fw-normal mb-0" for="remember">
                                                I agree to the <a href="{{ route('terms') }}" target="_blank"
                                                    class="fw-bold">terms and
                                                    conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                    <x-turnstile data-theme="light" />
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gray-800 mt-2">Sign up</button>
                                </div>
                            </form>
                            {{-- <div class="mt-3 mb-4 text-center">
                                <span class="fw-normal">or login with</span>
                            </div>
                            <div class="d-flex justify-content-center my-4">
                                <a href="{{ route('login.google') }}"
                                    class="btn btn-icon-only btn-pill btn-outline-gray-500 me-2"
                                    aria-label="twitter button" title="twitter button">
                                    <svg xmlns="http://www.w3.org/2000/svg" x-bind:width="size"
                                        x-bind:height="size" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" x-bind:stroke-width="stroke" stroke-linecap="round"
                                        stroke-linejoin="round" width="24" height="24" stroke-width="2">
                                        <path
                                            d="M20.945 11a9 9 0 1 1 -3.284 -5.997l-2.655 2.392a5.5 5.5 0 1 0 2.119 6.605h-4.125v-3h7.945z">
                                        </path>
                                    </svg>
                                </a>
                            </div> --}}
                            <div class="d-flex justify-content-center align-items-center mt-4">
                                <span class="fw-normal">
                                    Already have an account?
                                    <a href="{{ route('login') }}" class="fw-bold">Login here</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
