$(document).ready(function () {
    const notyf = new Notyf();

    function addToBookingList(carId, carBrand, carModel) {
        $.ajax({
            url: '/booking-list/add',
            type: 'POST',
            data: {
                car_id: carId,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            success: function (response) {
                if (response.success) {
                    notyf.success('Car successfully added to booking list!');
                } else {
                    notyf.error('Failed to add car to booking list');
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = '';

                    $.each(errors, function (field, messages) {
                        errorMessages += messages.join('<br>') + '<br>';
                    });

                    notyf.error('Validation Error: <br>' + errorMessages);
                } else {
                    notyf.error('An error occurred. Please try again.');
                }
            }
        });
    }

    $('#addToBookingList').click(function () {
        const carId = $(this).data('car-id');
        const carBrand = $(this).data('car-brand');
        const carModel = $(this).data('car-model');

        $(this).prop('disabled', true);

        addToBookingList(carId, carBrand, carModel);
    });
});