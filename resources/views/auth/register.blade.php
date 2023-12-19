@extends('Layout.auth')

@section('content')
    <div class="card-body">
        <p class="login-box-msg">Daftar Akun Baru</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Your existing code -->
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Nama Lengkap" name="name" value="{{ old('name') }}"
                    required autocomplete="name" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"
                    required autocomplete="email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- Add the following code for password matching check -->
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Sandi" name="password" id="password" required
                    autocomplete="new-password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Ketikkan Ulang Sandi" name="password_confirmation"
                    id="password_confirmation" required autocomplete="new-password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                <div id="password-mismatch-error" class="invalid-feedback" style="display:none;">
                    <strong>Konfirmasi Sandi Tidak Cocok.</strong>
                </div>
            </div>
            <!-- End of password matching check code -->

            <div class="row">
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block" id="register-btn">Daftar</button>
                </div>
            </div>
        </form>

        <a href="{{ route('login') }}" class="text-center">Saya Sudah Punya Akun</a>
    </div>

    {{-- <!-- Add the following jQuery code for password matching check -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    </script> --}}
    <!-- End of jQuery code -->
@endsection
