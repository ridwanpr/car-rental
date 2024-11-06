@extends('layouts.backend.app')

@section('content')
    <div>
        <div class="row mb-4 mt-3">
            <div class="col">
                <h2 class="fw-semibold text-dark">Profile</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>

        @if (auth()->user()->role_id != 'admin')
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
