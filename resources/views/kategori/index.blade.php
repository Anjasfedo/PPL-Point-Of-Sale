@extends('Layout.main')
@section('title')
    Kategori
@endsection
@section('header')
    <h1 class="m-0">Kategori</h1>
@endsection
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a data-toggle="modal" data-target="#modal-tambah-kategori" class="btn btn-primary">Tambah
                                Kategori</a>
                            <a data-toggle="modal" data-target="#modal-import-kategori" class="btn btn-primary">Import
                                Kategori</a>
                            @includeIf('Kategori.importKategori')
                        </div>
                        <div class="card-body">
                            <table id="tabel-data" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama kategori</th>
                                        <th class="no-export">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataKategori as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_kategori }}</td>
                                            <td>
                                                <a data-toggle="modal"
                                                    data-target="#modal-edit-kategori{{ $item->id_kategori }}"
                                                    class="btn btn-primary"><i class="fas fa-pen">Edit</i></a>
                                                <a data-toggle="modal"
                                                    data-target="#modal-hapus-kategori{{ $item->id_kategori }}"
                                                    class="btn btn-danger"><i class="fas fa-trash-alt">Hapus</i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-edit-kategori{{ $item->id_kategori }}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Kategori</h4>
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
                                                                            action="{{ route('kategori.update', [$item->id_kategori]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="card-body">
                                                                                <div class="form-group">
                                                                                    <label for="inputNamaKategori">Nama
                                                                                        kategori</label>
                                                                                    <input type="text"
                                                                                        name="nama_kategori"
                                                                                        class="form-control"
                                                                                        id="inputNamaKategori"
                                                                                        value="{{ $item->nama_kategori }}"
                                                                                        placeholder="Masukan Nama Kategori">
                                                                                    @error('nama_kategori')
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
                                        <div class="modal fade" id="modal-hapus-kategori{{ $item->id_kategori }}">
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
                                                        <p>Konfirmasi Hapus data <b>{{ $item->nama_kategori }}</b></p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center text-center">
                                                        <form
                                                            action="{{ route('kategori.destroy', [$item->id_kategori]) }}"
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
@includeIf('Kategori.kategoriCreate')
