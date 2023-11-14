<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @section('header')
                @show
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @section('breadcrumb')
                    @show
                    <li class="breadcrumb-item active"> <a href="{{ route('home') }}">Dashboard</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
