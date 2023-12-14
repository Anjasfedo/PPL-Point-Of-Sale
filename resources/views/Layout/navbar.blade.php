<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user user-menu d-none d-sm-inline-block mr-4">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li class="user-header">
                    <p>
                        {{ auth()->user()->name }}
                    </p>
                    <p>
                        {{ auth()->user()->email }}
                    </p>
                </li>
                <li class="user-footer">
                    <div class="float-left">
                        <a href="{{ route('user-profile') }}" class="btn btn-default btn-flat">Profil</a>
                    </div>
                    <div class="float-right">
                        <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#modal-logout">Logout</a>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
    
    </li>

    </ul>
</nav>

<div class="modal fade" id="modal-logout">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Logout</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Konfirmasi melakukan Logout</p>
            </div>
            <div class="modal-footer justify-content-center text-center">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
