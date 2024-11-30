$(document).ready(function () {
    $('#viewRentButton').on('click', function () {
        const rentId = $(this).data('rent-id');
        viewRentDetails(rentId);
    });
});

function viewRentDetails(rentId) {
   console.log(rentId);
}