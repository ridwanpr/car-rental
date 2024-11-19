    <!-- Core -->
    <script src="{{ asset('vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Vendor JS -->
    <script src="{{ asset('vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>

    <!-- Slider -->
    <script src="{{ asset('vendor/nouislider/dist/nouislider.min.js') }}"></script>

    <!-- Smooth scroll -->
    <script src="{{ asset('vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>

    <!-- Datepicker -->
    <script src="{{ asset('vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

    <!-- Sweet Alerts 2 -->
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

    <!-- Vanilla JS Datepicker -->
    <script src="{{ asset('vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

    <!-- Notyf -->
    <script src="{{ asset('vendor/notyf/notyf.min.js') }}"></script>

    <!-- Volt JS -->
    <script src="{{ asset('assets/js/volt.js') }}"></script>

    <!-- JQUERY CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- DATATABLE CDN -->
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

            $('.delete-btn').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('.delete-form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            $('#datatable').DataTable();
        });
    </script>
