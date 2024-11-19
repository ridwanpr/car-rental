@extends('layouts.backend.guest')

@section('content')
    <main>
        <section class="mt-4 d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 mb-4 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">Confirm Password</h1>
                            </div>
                            <div class="text-sm text-gray-600 mb-4">
                                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                            </div>
                            <form method="POST" action="{{ route('password.confirm') }}" class="mt-4">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="password">{{ __('Password') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                        <input type="password" id="password" name="password" required
                                            autocomplete="current-password" class="form-control" placeholder="Password">
                                    </div>
                                    @if ($errors->has('password'))
                                        <div class="mt-2 text-danger">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-gray-800">
                                        {{ __('Confirm') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
