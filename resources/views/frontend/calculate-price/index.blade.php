@extends('layouts.frontend.app')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                <div id="map" style="width: 100%; height: 500px;"></div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm p-4 border-0">
                    <h4 class="card-title mb-3 text-center">Rental Car Price Calculation</h4>
                    <div class="form-group mb-4">
                        <label for="rent-price">Enter Daily Rent Price (IDR)</label>
                        <input type="number" class="form-control" id="rent-price" placeholder="Enter daily rent price..."
                            min="0" value="0">
                    </div>
                    <div class="form-group mb-4">
                        <label for="fuel-price">Enter Fuel Price (IDR per liter)</label>
                        <input type="number" class="form-control" id="fuel-price" placeholder="Enter fuel price..."
                            min="0" value="10000">
                    </div>
                    <div class="form-group mb-4">
                        <label for="fuel-consumption">Select Car Type (Fuel Efficiency)</label>
                        <select class="form-control" id="fuel-consumption">
                            <option value="12">Sedan (12 km/l)</option>
                            <option value="8">SUV (8 km/l)</option>
                            <option value="15">Hatchback (15 km/l)</option>
                            <option value="5">Truck (5 km/l)</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <h5 class="text-muted" style="font-size: 16px">Distance: <span id="distance">0.00</span> km</h5>
                        <h5 class="text-muted" style="font-size: 16px">Fuel Cost: <span id="fuel-cost">0.00</span></h5>
                        <h4 class="font-weight-bold" style="font-size: 18px">Total Price: <span id="total-price">0</span>
                        </h4>
                    </div>
                    <button class="btn btn-primary w-100" id="reset-map">Reset</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" rel="stylesheet" />
    <link href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    @vite(['resources/js/price-estimator.js'])
@endpush
