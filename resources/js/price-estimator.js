$(document).ready(function () {
    const map = L.map('map').setView([-6.2867, 106.8087], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    let markers = [];
    const distanceDisplay = $('#distance');
    const fuelCostDisplay = $('#fuel-cost');
    const totalPriceDisplay = $('#total-price');

    function onMapClick(e) {
        if (markers.length < 2) {
            const marker = L.marker(e.latlng).addTo(map);
            markers.push(marker);

            if (markers.length === 2) {
                calculatePrice();
            }
        } else {
            resetMap();
        }
    }

    map.on('click', onMapClick);

    function calculateDistance() {
        if (markers.length === 2) {
            const latlng1 = markers[0].getLatLng();
            const latlng2 = markers[1].getLatLng();
            return map.distance(latlng1, latlng2) / 1000;
        }
        return 0;
    }

    function calculateFuelCost(distance) {
        const fuelConsumption = parseFloat($('#fuel-consumption').val()) || 12;
        const fuelPrice = parseFloat($('#fuel-price').val()) || 10000;
        const fuelUsed = distance / fuelConsumption;
        return fuelUsed * fuelPrice;
    }

    function calculateRentalCost() {
        const rentPrice = parseFloat($('#rent-price').val()) || 0;
        return rentPrice;
    }

    function calculateTotalPrice(fuelCost, rentalCost) {
        return fuelCost + rentalCost;
    }

    function formatRupiah(amount) {
        return amount.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
    }

    function calculatePrice() {
        const distance = calculateDistance();
        const fuelCost = calculateFuelCost(distance);
        const rentalCost = calculateRentalCost();
        const totalPrice = calculateTotalPrice(fuelCost, rentalCost);

        distanceDisplay.text(distance.toFixed(2));
        fuelCostDisplay.text(formatRupiah(fuelCost));
        totalPriceDisplay.text(formatRupiah(totalPrice));
    }

    function resetMap() {
        markers.forEach(marker => marker.remove());
        markers = [];
        distanceDisplay.text('0.00');
        fuelCostDisplay.text('0.00');
        totalPriceDisplay.text(formatRupiah(0));
    }

    $('#reset-map').click(resetMap);

    const geocoder = L.Control.Geocoder.nominatim();
    const searchControl = L.Control.geocoder({
        query: '',
        placeholder: 'Search for a place...',
        errorMessage: 'Address not found!',
        geocoder: geocoder
    })
        .on('markgeocode', function (e) {
            const latlng = e.geocode.center;
            if (markers.length < 2) {
                const marker = L.marker(latlng).addTo(map);
                markers.push(marker);

                if (markers.length === 2) {
                    calculatePrice();
                }
            } else {
                resetMap();
            }
        })
        .addTo(map);
});