@extends('Layout.main')
@section('title')
    Pembelian
@endsection
@section('header')
    <h1 class="m-0">Pembelian</h1>
@endsection
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('pembelian.index') }}">Pembelian</a></li>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @foreach ($dataPembelian as $item)
                                <form method="POST" action="{{ route('pembelian.store', [$item->id_pembelian]) }}"
                                    method="POST">
                            @endforeach
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-primary">Tambah pembelian</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <table id="tabel-data" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Waktu Pembelian</th>
                                        <th>Total Item</th>
                                        <th>Total Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataPembelianTabel as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                            <td>{{ $item->total_item }}</td>
                                            <td>{{ $item->total_pembelian }}</td>
                                            <td>
                                                <a data-toggle="modal" data-target="#modal-info{{ $item->id_pembelian }}"
                                                    class="btn btn-primary">
                                                    <i class="fas fa-pen"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@includeIf('Pembelian.info')
