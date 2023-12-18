@extends('Layout.main')
@section('title')
    Supplier
@endsection
@section('header')
    <h1 class="m-0">Supplier</h1>
@endsection
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Supplier</a></li>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a data-toggle="modal" data-target="#modal-tambah-supplier" class="btn btn-primary">Tambah
                                supplier</a>
                            <a data-toggle="modal" data-target="#modal-import-supplier" class="btn btn-primary">Import
                                supplier</a>
                            @includeIf('supplier.importsupplier')
                        </div>
                        <div class="card-body">
                            <table id="tabel-data" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama supplier</th>
                                        <th>Telepon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataSupplier as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_supplier }}</td>
                                            <th>{{ $item->telepon }}</th>
                                            <td>
                                                <a data-toggle="modal"
                                                    data-target="#modal-edit-supplier{{ $item->id_supplier }}"
                                                    class="btn btn-primary"><i class="fas fa-pen">Edit</i></a>
                                                <a data-toggle="modal"
                                                    data-target="#modal-hapus-supplier{{ $item->id_supplier }}"
                                                    class="btn btn-danger"><i class="fas fa-trash-alt">Hapus</i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-edit-supplier{{ $item->id_supplier }}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Supplier</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <section class="content">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Isi Data</h3>
                                                                        </div>
                                                                        <form id="quickForm"
                                                                            action="{{ route('supplier.update', [$item->id_supplier]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="card-body">
                                                                                <div class="form-group">
                                                                                    <label for="inputNamasupplier">Nama
                                                                                        supplier</label>
                                                                                    <input type="text"
                                                                                        name="nama_supplier"
                                                                                        class="form-control"
                                                                                        id="inputNamasupplier"
                                                                                        value="{{ $item->nama_supplier }}"
                                                                                        placeholder="Masukan Nama supplier">
                                                                                    @error('nama_supplier')
                                                                                        <small>{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="inputTeleponSupplier">Telepon</label>
                                                                                    <input type="text" name="telepon"
                                                                                        class="form-control"
                                                                                        id="inputTeleponSupplier"
                                                                                        value="{{ $item->telepon }}"
                                                                                        placeholder="Masukan Nomor Telepon Supplier">
                                                                                    @error('telepon')
                                                                                        <small>{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-footer text-center">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="modal-hapus-supplier{{ $item->id_supplier }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Konfirmasi Hapus</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Konfirmasi Hapus data <b>{{ $item->nama_supplier }}</b></p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center text-center">
                                                        <form
                                                            action="{{ route('supplier.destroy', [$item->id_supplier]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-outline-light">HAPUS</button>
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
@endsection
@includeIf('supplier.supplierCreate')
