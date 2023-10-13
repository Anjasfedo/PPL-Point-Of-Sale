<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">@yield('title')</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right"">
            @section('breadcrumb')
            <li class="breadcrumb-item active">
                <a href="{{ url('/home') }}">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Dashboard</a>
            </li>
            @show
        </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
