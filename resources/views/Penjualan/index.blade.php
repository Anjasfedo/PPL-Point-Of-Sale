@extends('Layout.main')
@section('title')
    Penjualan
@endsection
@section('header')
    <h1 class="m-0">Penjualan</h1>
@endsection
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('penjualan.index') }}">Penjualan</a></li>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @foreach ($dataPenjualan as $item)
                                <form method="POST" action="{{ route('penjualan.store', [$item->id_penjualan]) }}"
                                    method="POST">
                            @endforeach
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-primary">Tambah penjualan</button>
                            </form>
                        </div>
                        @hasrole('admin')
                            <div class="card-body">
                                <table id="tabel-data" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Waktu Penjualan</th>
                                            <th>Total Item</th>
                                            <th>Total Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataPenjualanTabel as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                                <td>{{ $item->total_item }}</td>
                                                <td>{{ $item->total_penjualan }}</td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#modal-info{{ $item->id_penjualan }}"
                                                        class="btn btn-success">
                                                        <i class="fas fa-search"></i> Lihat
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endhasrole
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@includeIf('Penjualan.info')
@push('script')
    <script>
        $(document).ready(function() {
            var table = $('#tabel-penjualan').DataTable();
        })
    </script>
@endpush
