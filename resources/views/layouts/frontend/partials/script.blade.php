<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js" defer></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js" defer></script>
<script>
    function displayNotyf(message, type = 'success') {
        const notyf = new Notyf({
            position: {
                x: 'right',
                y: 'top',
            },
            types: [{
                    type: 'error',
                    background: 'red',
                    icon: {
                        className: 'fas fa-exclamation-circle',
                        tagName: 'span',
                        color: '#fff'
                    },
                    dismissible: true
                },
                {
                    type: 'success',
                    background: 'green',
                    icon: {
                        className: 'fas fa-check-circle',
                        tagName: 'span',
                        color: '#fff'
                    },
                    dismissible: true
                }
            ]
        });

        notyf.open({
            type: type,
            message: message,
            duration: 5000
        });
    }

    $(document).ready(function() {
        const errors = @json($errors->all());
        if (errors.length > 0) {
            displayNotyf(errors.join('<br>'), 'error');
        }

        const successMessage = @json(session('success'));
        if (successMessage) {
            displayNotyf(successMessage, 'success');
        }

        $('#datatable').DataTable();
    });
</script>
