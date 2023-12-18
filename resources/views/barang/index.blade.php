@extends('Layout.main')
@section('title')
    Barang
@endsection
@section('header')
    <h1 class="m-0">Barang</h1>
@endsection
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('barang.index') }}">Barang</a></li>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a data-toggle="modal" data-target="#modal-tambah-barang" class="btn btn-primary">Tambah barang</a>
                            <a data-toggle="modal" data-target="#modal-import-barang" class="btn btn-primary">Import
                                barang</a>
                            @includeIf('barang.importbarang')
                        </div>
                        <div class="card-body">
                            <table id="tabel-data" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Harga Jual</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataBarang as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_barang }}</td>
                                            <td>
                                                @if ($item->kategori)
                                                    {{ $item->kategori->nama_kategori }}
                                                @endif
                                            </td>
                                            <td>{{ $item->harga_jual }}</td>
                                            <td>{{ $item->stok }}</td>
                                            <td>
                                                <a data-toggle="modal"
                                                    data-target="#modal-edit-barang{{ $item->id_barang }}"
                                                    class="btn btn-primary"><i class="fas fa-pen">Edit</i></a>
                                                <a data-toggle="modal"
                                                    data-target="#modal-hapus-barang{{ $item->id_barang }}"
                                                    class="btn btn-danger"><i class="fas fa-trash-alt">Hapus</i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-edit-barang{{ $item->id_barang }}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Barang</h4>
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
                                                                            action="{{ route('barang.update', [$item->id_barang]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="card-body">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="inputNamaBarang">Nama</label>
                                                                                    <input type="text" name="nama_barang"
                                                                                        class="form-control"
                                                                                        id="inputNamaBarang"
                                                                                        value="{{ $item->nama_barang }}"
                                                                                        placeholder="Masukan Nama barang">
                                                                                    @error('nama_barang')
                                                                                        <small>{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div class="form-group">
                                                                                    <label>Minimal</label>
                                                                                    <select name="id_kategori"
                                                                                        class="form-control select2bs4"
                                                                                        style="width: 100%;">
                                                                                        @foreach ($dataKategori as $value)
                                                                                            <option
                                                                                                value="{{ $value->id_kategori }}">
                                                                                                {{ $value->nama_kategori }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="inputHargaJual">harga</label>
                                                                                    <input type="number" name="harga_jual"
                                                                                        class="form-control"
                                                                                        id="inputHargaJual"
                                                                                        value={{ $item->harga_jual }}
                                                                                        placeholder="Masukan harga barang">
                                                                                    @error('harga_jual')
                                                                                        <small>{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="inputStokBarang">stok</label>
                                                                                    <input type="number" name="stok"
                                                                                        class="form-control"
                                                                                        id="inputStokBarang"
                                                                                        value="{{ $item->stok }}"
                                                                                        placeholder="Masukan stok barang">
                                                                                    @error('stok')
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
                                        <div class="modal fade" id="modal-hapus-barang{{ $item->id_barang }}">
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
                                                        <p>Konfirmasi Hapus data <b>{{ $item->nama_barang }}</b></p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center text-center">
                                                        <form action="{{ route('barang.destroy', [$item->id_barang]) }}"
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
@includeIf('barang.barangCreate')
