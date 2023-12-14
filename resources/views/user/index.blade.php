@extends('Layout.main')

@section('title')
    Users
@endsection

@section('header')
    <h1 class="m-0">Users</h1>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a data-toggle="modal" data-target="#modal-tambah-user" class="btn btn-primary">Tambah User</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th class="no-export">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataUser as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                <a data-toggle="modal" data-target="#modal-edit-user{{ $item->id }}"
                                                    class="btn btn-primary"><i class="fas fa pen">Edit</i></a>
                                                <a data-toggle="modal" data-target="#modal-hapus-user{{ $item->id }}"
                                                    class="btn btn-danger"><i class="fas fa-trash-alt">Delete</i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-edit-user{{ $item->id }}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit User</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('user.update', [$item->id]) }}" method="POST" id="editUserForm{{ $item->id }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <!-- Your user edit form fields go here -->
                                                            <div class="form-group">
                                                                <label for="editName">Name</label>
                                                                <input type="text" name="name" class="form-control" id="editName" value="{{ $item->name }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editEmail">Email</label>
                                                                <input type="email" name="email" class="form-control" id="editEmail" value="{{ $item->email }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editPasswordUser">New Password</label>
                                                                <input type="password" name="password" class="form-control" id="editPasswordUser" placeholder="Enter New Password">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password_confirmation_user_edit">Konfirmasi Password</label>
                                                                <input type="password" name="konfirmasi_password" class="form-control"
                                                                    id="password_confirmation_user_edit" placeholder="Konfirmasi Password">
                                                                <div id="password-mismatch-error-user-edit" class="invalid-feedback" style="display:none;">
                                                                    <strong>Password confirmation does not match.</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary" id="editUserBtn{{ $item->id }}">Save Changes</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="modal-hapus-user{{ $item->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Konfirmasi Hapus</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Konfirmasi Hapus data <b>{{ $item->name }}</b></p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center text-center">
                                                        <form action="{{ route('user.destroy', [$item->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-light">HAPUS</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Include the user creation form -->
    @include('user.userCreate')
    
@endsection


