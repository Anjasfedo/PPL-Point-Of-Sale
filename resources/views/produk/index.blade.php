@extends('Layout.main')
@section('title')
    produk
@endsection
@section('content')
    <!-- Main content -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <a data-toggle="modal" data-target="#modal-tambah-produk" class="btn btn-primary">Tambah produk</a>
                <a data-toggle="modal" data-target="#modal-import-produk" class="btn btn-primary">Import produk</a>
                @includeIf('produk.importproduk')
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabel-data" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($dataProduk as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_produk }}</td>
                            <td>@if ($item->kategori)
                              {{ $item->kategori->nama_kategori }}
                            @endif</td>
                            <td>{{ $item->harga_jual }}</td>
                            <td>{{ $item->stok }}</td>
                            <td>
                                <a data-toggle="modal" data-target="#modal-edit-produk{{ $item->id_produk }}" class="btn btn-primary"><i class="fas fa pen">Edit</i></a>
                                <a data-toggle="modal" data-target="#modal-hapus-produk{{ $item->id_produk }}" class="btn btn-danger"><i class="fas fa-trash-alt">Edit</i></a>
                            </td>
                        </tr>

                          {{-- modal edit --}}

                          <div class="modal fade" id="modal-edit-produk{{ $item->id_produk }}">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Large Modal</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>

                                <section class="content">
                                  <div class="container-fluid">
                                    <div class="row">
                                      <!-- left column -->
                                      <div class="col-md-12">
                                        <!-- jquery validation -->
                                        <div class="card card-primary">
                                          <div class="card-header">
                                            <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3>
                                          </div>
                                          <!-- /.card-header -->
                                          <!-- form start -->
                                          <form id="quickForm" action="{{ route('produk.update', [$item->id_produk]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="card-body">
                                              <div class="form-group">
                                                  <label for="inputNamaProduk">Nama</label>
                                                  <input type="text" name="nama_produk" class="form-control" id="inputNamaProduk" value="{{ $item->nama_produk }}" placeholder="Masukan Nama produk">
                                                  @error('nama_produk')
                          <small>{{ $message }}</small>
                      @enderror
                                                </div>
                                          </div>

                                          <div class="card-body">
                                            <div class="form-group">
                                              <label>Minimal</label>
                                              <select name="id_kategori"  class="form-control select2bs4" style="width: 100%;">
                                                @foreach ($dataKategori as $value)
                                                <option value="{{ $value->id_kategori }}">{{ $value->nama_kategori }}</option>
                                            @endforeach
                                              </select>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                          <div class="form-group">
                                              <label for="inputHargaJual">harga</label>
                                              <input type="number" name="harga_jual" class="form-control" id="inputHargaJual" value={{ $item->harga_jual }} placeholder="Masukan harga produk">
                                              @error('harga_jual')
                      <small>{{ $message }}</small>
                      @enderror
                                            </div>
                                      </div>
                                      <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputStokProduk">stok</label>
                                            <input type="number" name="stok" class="form-control" id="inputStokProduk" value="{{ $item->stok }}" placeholder="Masukan stok produk">
                                            @error('stok')
                      <small>{{ $message }}</small>
                      @enderror
                                          </div>
                                    </div>

                                            <!-- /.card-body -->
                                            <div class="card-footer text-center">
                                              <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                          </form>
                                        </div>
                                        <!-- /.card -->
                                        </div>
                                      <!--/.col (left) -->
                                      <!-- right column -->
                                      <div class="col-md-6">

                                      </div>
                                      <!--/.col (right) -->
                                    </div>
                                    <!-- /.row -->
                                  </div><!-- /.container-fluid -->
                                </section>
                                <!-- /.content -->
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          <!-- /.modal -->


                          {{-- modal delete --}}
                          <div class="modal fade" id="modal-hapus-produk{{ $item->id_produk }}">
                            <div class="modal-dialog">
                              <div class="modal-content bg-danger">
                                <div class="modal-header">
                                  <h4 class="modal-title">Konfirmasi Hapus</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p>Konfirmasi Hapus data <b>{{ $item->nama_produk }}</b></p>
                                </div>
                                <div class="modal-footer justify-content-center text-center">
                                   {{-- <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>  --}}
                                   <form action="{{ route('produk.destroy', [$item->id_produk]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-light">HAPUS</button>
                                  </form>
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          <!-- /.modal -->

                      @endforeach
                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
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

@includeIf('produk.produkCreate')
