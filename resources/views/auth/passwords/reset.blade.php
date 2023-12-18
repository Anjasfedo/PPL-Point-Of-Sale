@extends('Layout.auth')

@section('content')
    <div class="card-body">
        <p class="login-box-msg">Hanya tinggal satu langkah lagi dari sandi baru anda, Ubah Sandi Anda Sekarang!.</p>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
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
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Sandi" name="password" id="password" required autocomplete="new-password">
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
                <input type="password" class="form-control" placeholder="Konfirmasi Sandi" name="password_confirmation" id="password_confirmation" required autocomplete="new-password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>

                <div id="password-mismatch-error" class="invalid-feedback" style="display:none;">
                    <strong>Konfirmasi Sandi Tidak Cocok.</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Ubah Sandi</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <p class="mt-3 mb-1">
            <a href="{{ route('login') }}">Masuk</a>
        </p>
    </div>


@endsection
