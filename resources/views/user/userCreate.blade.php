<div class="modal fade" id="modal-tambah-user">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your user creation form goes here -->
                <form action="{{ route('user.store') }}" method="POST" id="createUserForm">
                    @csrf
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" name="name" class="form-control" id="inputName"
                            placeholder="Enter User Name">
                        @error('name')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail"
                            placeholder="Enter User Email">
                        @error('email')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputPasswordUser">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPasswordUser"
                            placeholder="Enter Password">
                        @error('password')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation_user_create">Konfirmasi Password</label>
                        <input type="password" name="konfirmasi_password" class="form-control"
                            id="password_confirmation_user_create" placeholder="Konfirmasi Password">
                        @error('password')
                            <small>{{ $message }}</small>
                        @enderror
                        <div id="password-mismatch-error-user-create" class="invalid-feedback" style="display:none;">
                            <strong>Password confirmation does not match.</strong>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="createUserBtn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
