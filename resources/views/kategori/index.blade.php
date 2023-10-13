@extends('Layout.main')
@section('title')
    Kategori
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Kategori</li>
@endsection
@section('content')
    <!-- Main content -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a data-toggle="modal" data-target="#modal-tambah-kategori" class="btn btn-primary">Tambah Kategori</a>
                <a data-toggle="modal" data-target="#modal-import-kategori" class="btn btn-primary">Import Kategori</a>
                @includeIf('Kategori.importKategori')
              </div>
              <!-- /.card-header -->
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
                                <a data-toggle="modal" data-target="#modal-edit-kategori{{ $item->id_kategori }}" class="btn btn-primary"><i class="fas fa pen">Edit</i></a>
                                <a data-toggle="modal" data-target="#modal-hapus-kategori{{ $item->id_kategori }}" class="btn btn-danger"><i class="fas fa-trash-alt">Edit</i></a>
                            </td>
                        </tr>

                        {{-- modal edit --}}
                        <div class="modal fade" id="modal-edit-kategori{{ $item->id_kategori }}">
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
                                        <form id="quickForm" action="{{ route('kategori.update', [$item->id_kategori]) }}" method="POST">
                                          @csrf
                                          @method('PUT')
                                          <div class="card-body">
                                              <div class="form-group">
                                                  <label for="inputNamaKategori">Nama kategori</label>
                                                  <input type="text" name="nama_kategori" class="form-control" id="inputNamaKategori" value="{{ $item->nama_kategori }}" placeholder="Masukan Nama Kategori">
                                                  @error('nama_kategori')
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
                        <div class="modal fade" id="modal-hapus-kategori{{ $item->id_kategori }}">
                          <div class="modal-dialog">
                            <div class="modal-content bg-danger">
                              <div class="modal-header">
                                <h4 class="modal-title">Konfirmasi Hapus</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <p>Konfirmasi Hapus data <b>{{ $item->nama_kategori }}</b></p>
                              </div>
                              <div class="modal-footer justify-content-center text-center">
                                 {{-- <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>  --}}
                                 <form action="{{ route('kategori.destroy', [ $item->id_kategori]) }}" method="POST">
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

@includeIf('Kategori.kategoriCreate')
