<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Point Of Sales | @yield('title')
    </title>

    <link rel="icon" type="image/png" href="{{ asset('AdminLte/dist/img/Bintang.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('AdminLte/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLte/dist/css/adminlte.min.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('AdminLte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('AdminLte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    {{-- Toastr --}}
    <link rel="stylesheet" href="{{ asset('AdminLte/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLte/plugins/toastr/toastr.css') }}">

    {{-- Select2 --}}
    <link rel="stylesheet" href="{{ asset('AdminLte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('Layout.navbar')
        @include('Layout.sidebar')
        <div class="content-wrapper">
            @include('Layout.header')
            @yield('content')
        </div>
        <footer class="main-footer">
            Software Development Project
            <strong>Anjas & Dzakwan</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 0.1
            </div>
        </footer>
    </div>
    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('AdminLte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('AdminLte/dist/js/adminlte.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('AdminLte/plugins/chart.js/Chart.min.js') }}"></script>

    <script src="{{ asset('AdminLte/dist/js/pages/dashboard3.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('AdminLte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('AdminLte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('AdminLte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('AdminLte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('AdminLte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('AdminLte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('AdminLte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('AdminLte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(function() {
            $("#tabel-data").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                buttons: [
                    'pageLength', "colvis",
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(.no-export)'
                        },
                        customize: function(win) {
                            $(win.document.body)
                                .css('font-size', '10pt')

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        },
                        // messageTop: ''
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(.no-export)'
                        }
                    },
                    {
                        extend: "copy",
                        exportOptions: {
                            columns: ':not(.no-export)'
                        }
                    },
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],
                columnDefs: [{
                    'targets': -1,
                    'orderable': false,
                }],
            }).buttons().container().appendTo('#tabel-data_wrapper .col-md-6:eq(0)');

        });
    </script>

    <script src="{{ asset('AdminLte/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        $(function() {
            $('.toastrDefaultSuccess').click(function() {
                toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
            });
            $('.toastrDefaultInfo').click(function() {
                toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
            });
            $('.toastrDefaultError').click(function() {
                toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
            });
            $('.toastrDefaultWarning').click(function() {
                toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
            });
        });
    </script>

    @if (Session::has('failed'))
        <script>
            toastr.error("{{ Session::get('failed') }}", "Gagal!")
        </script>
    @endif

    @if (Session::has('message'))
        <script>
            toastr.success("{{ Session::get('message') }}", "Sukses!")
        </script>
    @endif

    @if (Session::has('success'))
        <script>
            toastr.success("{{ Session::get('success') }}", "Sukses!")
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif
        </script>
    @endif

    <script src="{{ asset('AdminLte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#tabel-data thead th:last').addClass('no-export');
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            });
            $(".select-supplier").click(function() {
                var id = $(this).data("id_supplier");
                $('.supplier-pilihan').val(id).trigger('change');
                $('#modal-supplier-data').modal('hide');
            });
        });
    </script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            var passwordInput = $('#inputPasswordUser');
            var confirmPasswordInput = $('#password_confirmation_user_create');
            var passwordMismatchError = $('#password-mismatch-error-user-create');
            var registerBtn = $('#register-btn');

            $('form').submit(function(event) {
                var password = passwordInput.val();
                var confirmPassword = confirmPasswordInput.val();

                if (password !== confirmPassword) {
                    event.preventDefault();
                    confirmPasswordInput.addClass('is-invalid');
                    passwordMismatchError.show();
                }
            });

            confirmPasswordInput.on('input', function() {
                var password = passwordInput.val();
                var confirmPassword = confirmPasswordInput.val();

                if (password === confirmPassword) {
                    confirmPasswordInput.removeClass('is-invalid');
                    passwordMismatchError.hide();
                } else {
                    confirmPasswordInput.addClass('is-invalid');
                    passwordMismatchError.show();
                }
            });
        });
    </script>

<script>
    $(document).ready(function() {
        var passwordInput = $('#editPasswordUser');
        var confirmPasswordInput = $('#password_confirmation_user_edit');
        var passwordMismatchError = $('#password-mismatch-error-user-edit');
        var registerBtn = $('#register-btn');

        $('form').submit(function(event) {
            var password = passwordInput.val();
            var confirmPassword = confirmPasswordInput.val();

            if (password !== confirmPassword) {
                event.preventDefault();
                confirmPasswordInput.addClass('is-invalid');
                passwordMismatchError.show();
            }
        });

        confirmPasswordInput.on('input', function() {
            var password = passwordInput.val();
            var confirmPassword = confirmPasswordInput.val();

            if (password === confirmPassword) {
                confirmPasswordInput.removeClass('is-invalid');
                passwordMismatchError.hide();
            } else {
                confirmPasswordInput.addClass('is-invalid');
                passwordMismatchError.show();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        var passwordInput = $('#inputPasswordBaru');
        var confirmPasswordInput = $('#password_confirmation_user_profile');
        var passwordMismatchError = $('#password-mismatch-error-user-profile');
        var registerBtn = $('#register-btn');

        $('form').submit(function(event) {
            var password = passwordInput.val();
            var confirmPassword = confirmPasswordInput.val();

            if (password !== confirmPassword) {
                event.preventDefault();
                confirmPasswordInput.addClass('is-invalid');
                passwordMismatchError.show();
            }
        });

        confirmPasswordInput.on('input', function() {
            var password = passwordInput.val();
            var confirmPassword = confirmPasswordInput.val();

            if (password === confirmPassword) {
                confirmPasswordInput.removeClass('is-invalid');
                passwordMismatchError.hide();
            } else {
                confirmPasswordInput.addClass('is-invalid');
                passwordMismatchError.show();
            }
        });
    });
</script>

    @stack('script')
</body>

</html>
