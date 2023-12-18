<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Informasi Point Of Sales</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('AdminLte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{ route('login') }}" class="h1"><b>Toko Bintang</b></a>
    </div>
        @yield("content")
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('AdminLte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLte/dist/js/adminlte.min.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            var passwordInput = $('#password');
            var confirmPasswordInput = $('#password_confirmation');
            var passwordMismatchError = $('#password-mismatch-error');
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

</body>
</html>
