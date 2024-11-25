$(document).ready(function () {
    const loadingOverlay = $('<div>', {
        id: 'loadingOverlay',
        css: {
            display: 'none',
            position: 'fixed',
            top: 0,
            left: 0,
            width: '100%',
            height: '100%',
            zIndex: '9999',
            backgroundColor: 'rgba(0, 0, 0, 0.5)',
        }
    });

    const loadingSpinner = $('<div>', {
        id: 'loadingSpinner',
        css: {
            position: 'absolute',
            top: '50%',
            left: '50%',
            transform: 'translate(-50%, -50%)',
            color: '#fff',
            textAlign: 'center',
            fontSize: '18px',
        },
        html: '<div class="spinner-border text-light" role="status"></div><br>Loading...'
    });

    loadingOverlay.append(loadingSpinner);
    $('body').append(loadingOverlay);

    $(document).ajaxStart(function () {
        $('#loadingOverlay').fadeIn();
    });

    $(document).ajaxStop(function () {
        setTimeout(function () {
            $('#loadingOverlay').fadeOut();
        }, 500);
    });
});
