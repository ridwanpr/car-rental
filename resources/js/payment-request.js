function viewPaymentDetails(paymentId) {
    $.get(`/payments/${paymentId}`)
        .done(function (response) {
            const payment = response.data;

            const formattedAmount = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(payment.total_amount);

            $('#paymentCode').text(payment.payment_code);
            $('#totalAmount').text(formattedAmount);
            $('#paymentMethod').text(payment.payment_method.name);
            $('#accountName').text(payment.payment_method.account_name);
            $('#accountNumber').text(payment.payment_method.account_number);
            $('#bankName').text(payment.payment_method.bank_name);

            const proofUrl = response.payment_proof_url;
            $('#paymentProof').attr('src', proofUrl);

            $('#declineButton').data('payment-id', payment.id);
            $('#approveButton').data('payment-id', payment.id);

            if (payment.status.toLowerCase() === 'pending') {
                $('.modal-footer .btn').show();
            } else {
                $('.modal-footer .btn').hide();
            }

            $('#paymentModal').modal('show');
        })
        .fail(function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Unable to fetch payment details'
            });
        });
}

function approvePayment(paymentId) {
    Swal.fire({
        title: 'Approve Payment',
        text: 'Are you sure you want to approve this payment?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, approve it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/payments/${paymentId}/approve`,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Approved!',
                        text: 'Payment has been approved successfully.'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Unable to approve payment'
                    });
                }
            });
        }
    });
}

function declinePayment(paymentId) {
    Swal.fire({
        title: 'Decline Payment',
        text: 'Are you sure you want to decline this payment?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, decline it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/payments/${paymentId}/decline`,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Declined!',
                        text: 'Payment has been declined successfully.'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Unable to decline payment'
                    });
                }
            });
        }
    });
}

$(document).ready(function () {
    $('#viewPaymentButton').on('click', function () {
        const paymentId = $(this).data('payment-id');
        viewPaymentDetails(paymentId);
    });

    $('#approveButton').on('click', function () {
        const paymentId = $(this).data('paymentId');
        approvePayment(paymentId);
    });

    $('#declineButton').on('click', function () {
        const paymentId = $(this).data('paymentId');
        declinePayment(paymentId);
    });
});