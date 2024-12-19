$(document).on('click', '#viewRentButton', function () {
    const rentId = $(this).data('rent-id');
    viewRentDetails(rentId);
});

$(document).on('click', '#approveButton', function () {
    const rentId = $(this).data('rent-id');
    approveRent(rentId);
});


$(document).on('click', '#declineButton', function () {
    const rentId = $(this).data('rent-id');
    declineRent(rentId);
});

$(document).on('click', '#returnCarButton', function () {
    const rentId = $(this).data('rent-id');
    returnCar(rentId);
});

function viewRentDetails(rentId) {
    $.get(`/rent-request/${rentId}`)
        .done(function (response) {
            const rent = response.data;

            $('#carName').text(`${rent.model} (${rent.tahun})`);
            $('#carType').text(`${rent.transmission} - ${rent.bahan_bakar}`);
            $('#carNumber').text(rent.plat_nomor);

            $('#customerName').text(rent.user_name);
            $('#customerEmail').text(rent.user_email);
            $('#customerPhone').text(rent.user_phone);

            $('#rentStartDate').text(rent.rent_start);
            $('#rentEndDate').text(rent.rent_end);
            $('#rentStatus').text(rent.rent_status);
            $('#rentTotalPrice').text(`Rp. ${parseFloat(rent.total_price).toLocaleString('id-ID')}`);
            $('#pricePerDay').text(`Rp. ${parseFloat(rent.price_per_day).toLocaleString('id-ID')}`);

            $('#declineButton').data('rent-id', rentId);
            $('#approveButton').data('rent-id', rentId);

            if (rent.rent_status.toLowerCase() === 'pending') {
                $('.modal-footer .btn-approve, .modal-footer .btn-decline').show();
            } else {
                $('.modal-footer .btn-approve, .modal-footer .btn-decline').hide();
            }

            $('#rentRequestModal').modal('show');
        })
        .fail(function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Unable to fetch rent details'
            });
        });
}

function approveRent(rentId) {
    Swal.fire({
        title: 'Approve Rent',
        text: 'Are you sure you want to approve this rent?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, approve it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/rents/${rentId}/approve`,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Approved!',
                        text: 'Rent has been approved successfully.'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Unable to approve rent'
                    });
                }
            });
        }
    });
}

function declineRent(rentId) {
    const bootstrapModal = bootstrap.Modal.getInstance(document.querySelector('.modal'));
    bootstrapModal.hide();

    setTimeout(() => {
        Swal.fire({
            title: 'Decline Rent',
            text: 'Are you sure you want to decline?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, decline it!',
            input: 'textarea',
            inputPlaceholder: 'Enter decline message',
            backdrop: true,
            showLoaderOnConfirm: true,
            preConfirm: (declineMessage) => {
                if (!declineMessage) {
                    Swal.showValidationMessage('Please provide a reason for declining');
                    return false;
                }

                return $.ajax({
                    url: `/rents/${rentId}/decline`,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        decline_message: declineMessage
                    }
                })
                    .catch(error => {
                        Swal.showValidationMessage(
                            'Request failed: ' + (error.responseJSON?.message || 'Unable to decline rent request')
                        );
                    });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Declined!',
                    text: 'Rent request has been declined successfully.'
                }).then(() => {
                    location.reload();
                });
            } else {
                bootstrapModal.show();
            }
        });
    }, 150);
}

function returnCar(rentId) {
    $.ajax({
        url: `/rent-requests/${rentId}/check-penalty`,
        type: 'POST',
        data: { _token: $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
            let confirmText = 'Are you sure you want to return this car?';
            let htmlContent = '';
            if (response.is_late) {
                htmlContent = `
                    <div class="text-start mb-3">
                        <table class="table table-sm">
                            <tr>
                                <td>Return Deadline</td>
                                <td>: ${response.return_deadline}</td>
                            </tr>
                            <tr>
                                <td>Days Late</td>
                                <td>: ${response.days_late} days</td>
                            </tr>
                            <tr>
                                <td>Penalty per Day</td>
                                <td>: Rp ${response.price_per_day_formatted}</td>
                            </tr>
                            <tr class="table-warning">
                                <td class="fw-bold">Total Penalty</td>
                                <td class="fw-bold">: Rp ${response.penalty_amount_formatted}</td>
                            </tr>
                        </table>
                    </div>`;
            }

            Swal.fire({
                title: 'Return car?',
                html: htmlContent,
                text: response.is_late ? '' : confirmText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, return it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/rent-requests/${rentId}/return`,
                        type: 'POST',
                        data: { _token: $('meta[name="csrf-token"]').attr('content') },
                        success: function (returnResponse) {
                            Swal.fire({
                                icon: returnResponse.status,
                                title: 'Success',
                                text: 'Car has been returned successfully.'
                            }).then(() => location.reload());
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Unable to process car return'
                            });
                        }
                    });
                }
            });
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Unable to check penalty information'
            });
        }
    });
}