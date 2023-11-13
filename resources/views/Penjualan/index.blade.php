@extends('Layout.main')

@section('title')

penjualan

@endsection

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @foreach ($dataPenjualan as $item)
                        <form
                            method="POST"
                            action="{{ route('penjualan.store', [$item->id_penjualan]) }}" method="POST">
                        @endforeach
                            @csrf
                            @method('POST')
                            <!-- Field-form di sini -->
                            <button type="submit" class="btn btn-primary">Tambah penjualan</button>
                        </form>
                    </div>
                    @hasrole('admin')
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabel-data" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    {{-- <th>Id Penjualan</th> --}}
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
                                    {{-- <td>{{ tambah_nol_didepan($item->id_penjualan, 10) }}</td> --}}
                                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                    <td>{{ $item->total_item }}</td>
                                    <td>{{ $item->total_penjualan }}</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#modal-info{{ $item->id_penjualan }}" class="btn btn-primary">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    @endhasrole
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection


@includeIf('Penjualan.info')
@push('script')
    <script>
        $(document).ready(function() {
        var table = $('#tabel-penjualan').DataTable();
        })
    </script>
@endpush