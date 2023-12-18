@extends('Layout.main')

@section('title')
    User Profile
@endsection

@section('header')
    <h1 class="m-0">Pengaturan Akun</h1>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('user-profile') }}">User Profile</a></li>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Isi Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('user-profile-update', [$user->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputNama">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="inputNama"
                                        placeholder="Masukkan Nama" value="{{ $user->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="email" name="email" class="form-control" id="inputEmail"
                                        placeholder="Masukkan Email" value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordBaru">Password Baru</label>
                                    <input type="password" name="password_baru" class="form-control" id="inputPasswordBaru"
                                        placeholder="Masukkan Password Baru">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation_user_profile">Konfirmasi Password</label>
                                    <input type="password" name="konfirmasi_password" class="form-control"
                                        id="password_confirmation_user_profile" placeholder="Konfirmasi Password">
                                    <div id="password-mismatch-error-user-profile" class="invalid-feedback" style="display:none;">
                                        <strong>Password confirmation does not match.</strong>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
