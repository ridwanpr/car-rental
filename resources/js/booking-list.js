$(document).ready(function () {
    let totalPrice = 0;
    $('table tbody tr').each(function () {
        const price = $(this).find('td:nth-child(4)').text().replace('Rp.', '').replace(',', '')
            .trim();
        const quantity = $(this).find('td:nth-child(3)').text().trim();
        totalPrice += parseFloat(price) * parseInt(quantity);
    });

    function formatRupiah(number) {
        const formattedNumber = number.toFixed(2);
        const parts = formattedNumber.split('.');
        const integerPart = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        const decimalPart = parts[1];

        return 'Rp. ' + integerPart + ',' + decimalPart;
    }

    $('#total-price').text(formatRupiah(totalPrice));
});