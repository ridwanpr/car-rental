$(document).ready(function () {
    function calculateDays(startDate, endDate) {
        const start = new Date(startDate);
        const end = new Date(endDate);
        const diffTime = Math.abs(end - start);
        return Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    }

    function calculateRowTotal(row) {
        const startDate = row.find('.rent-start').val();
        const endDate = row.find('.rent-end').val();

        if (startDate && endDate) {
            const days = calculateDays(startDate, endDate);
            const pricePerDay = parseFloat(row.find('.price-per-day').text()
                .replace('Rp.', '')
                .replace(/,/g, ''));

            const total = days * pricePerDay;
            row.find('.total-price').text('Rp.' + total.toFixed(0)
                .replace(/\d(?=(\d{3})+$)/g, '$&,'));
        }
    }

    function updateGrandTotal() {
        let grandTotal = 0;
        $('.total-price').each(function () {
            const price = $(this).text().replace('Rp.', '').replace(/,/g, '');
            if (!isNaN(price)) {
                grandTotal += parseFloat(price);
            }
        });
        $('#total-price').text('Rp.' + grandTotal.toFixed(0)
            .replace(/\d(?=(\d{3})+$)/g, '$&,'));
    }

    $(document).on('change', '.rent-start, .rent-end', function () {
        const row = $(this).closest('tr');
        const startDate = row.find('.rent-start').val();
        const endDate = row.find('.rent-end').val();

        if (startDate && endDate) {
            if (new Date(endDate) <= new Date(startDate)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'End date must be after start date'
                });
                $(this).val('');
                return;
            }
            calculateRowTotal(row);
            updateGrandTotal();
        }
    });

    $('#checkout').on('click', function () {
        let isValid = true;
        let rentalsData = [];

        $('table tbody tr').each(function () {
            const row = $(this);
            const startDate = row.find('.rent-start').val();
            const endDate = row.find('.rent-end').val();

            if (!startDate || !endDate) {
                isValid = false;
                Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'Please fill in all rental dates'
                });
                return false;
            }

            const totalPrice = parseFloat(row.find('.total-price').text()
                .replace('Rp.', '')
                .replace(/,/g, ''));
            const pricePerDay = parseFloat(row.find('.price-per-day').text()
                .replace('Rp.', '')
                .replace(/,/g, ''));

            rentalsData.push({
                car_id: row.data('car-id'),
                rent_start: startDate,
                rent_end: endDate,
                price_per_day: pricePerDay,
                total_price: totalPrice
            });
        });

        if (!isValid) return;

        const paymentMethod = $('#payment_method').find(":selected").val();
        console.log(paymentMethod);

        $.ajax({
            url: '/checkout',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                rentals: rentalsData,
                total_amount: parseFloat($('#total-price').text()
                    .replace('Rp.', '')
                    .replace(/,/g, '')),
                payment_method: paymentMethod
            },
            success: function (response) {
                if (response.redirect) {
                    window.location.href = response.redirect;
                }
            },
            error: function (xhr, status, error) {
                console.error('Checkout error:', error);
                const errorMessage = xhr.responseJSON.message || 'An error occurred during checkout. Please try again.';
                Swal.fire({
                    icon: 'error',
                    title: 'Attention',
                    text: errorMessage
                });
            }
        });
    });
});
