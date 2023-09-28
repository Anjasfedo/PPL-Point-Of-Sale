@extends('Layout.main')
@section('title')
    produk
@endsection
@section('content')


    <!-- Main content -->

    <!--  -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <!-- <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Note:</h5>
                This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
              </div> -->


              <!-- Main content -->
              <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-globe"></i> Usaha
                      <small class="float-right">Tanggal</small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row">
                  <div class="col-12">
                    <form
                        action="{{ route('penjualanproduk.store', [$id_penjualan]) }}"
                        method="POST">
                        @csrf
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Email</label>
                          <div class="input-group">
                            <select name="id_produk" class="form-control select2bs4"">
                              <option value="">-- choose product --</option>
                              @foreach ($dataProduk as $item)
                              <option value="{{ $item->id_produk }}">{{ $item->nama_produk }}</option>
                              @endforeach
                          </select>
                            <span class="input-group-btn">
                                <a data-toggle="modal" data-target="#modal-produk-data" class="btn btn-info btn-flat"><i class="fa fa-arrow-right"></i></a>
                            </span>
                        </div>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputJumlah">Jumlah</label>
                          <input type="number" class="form-control" id="inputJumlah" value="1" name="jumlah">
                        </div>
                      </div>

                      <input name="id_penjualan" type="text" value="{{ $id_penjualan }}" readonly>
                      <input name="id_user" type="text" value="{{ $dataPenjualan->id_user }}" readonly>

                      <button type="submit" class="btn btn-success float-right">
                        <i class="far fa-credit-card"></i>Tambah
                      </button>
                    </form>
                  </div>

                </div>
                <!-- /.row -->

  <!--  -->
                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table id="tabel-data" class="table table-stiped table-bordered table-penjualan">
                      <thead>
                          <th width="5%">No</th>
                          <th>Nama</th>
                          <th>Harga</th>
                          <th width="15%">Jumlah</th>
                          <th>Subtotal</th>
                          <th width="15%">
                              <i class="fa fa-cog"></i>
                          </th>
                      </thead>
                      <tbody id="tabel-produksss">
                          @foreach ($dataPenjualanProduk as $item)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>
                                  {{ $dataProduk->where('id_produk', $item->id_produk)->first()->nama_produk }}
                              </td>
                              <td>
                                  {{ $dataProduk->where('id_produk', $item->id_produk)->first()->harga_jual }}
                              </td>
                              <td >{{ $item->jumlah }}
                              </td>
                              <td>{{ $item->total_harga }}</td>
                              <td>
                                  <a
                                      data-toggle="modal"
                                      data-target="#modal-penjualan-detail-edit{{ $item->id_penjualan_produk }}"
                                      class="btn btn-primary">
                                      <i class="fas fa pen">Edit</i>
                                  </a>
                                  <a
                                      data-toggle="modal"
                                      data-target="#modal-penjualan-detail-hapus{{ $item->id_penjualan_produk }}"
                                      class="btn btn-danger">
                                      <i class="fas fa-trash-alt">Edit</i>
                                  </a>
                              </td>
                          </tr>
                          @endforeach
                          </tbody>
                      </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <form action="{{ route('penjualan.update', [$id_penjualan]) }}" method="post">
                  @csrf
                  @method("PUT")
                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-7">
                      <div class="tampil-bayar bg-primary">

                      </div>
                      <div class="tampil-terbilang">

                      </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-5">

                      <div class="table-responsive">
                          <table class="table">
                            <tr>
                              <th>
                                <label for="diterima" class="col-form-label col-form-label-lg">DITERIMA</label>
                              </th>
                              <td>
                                <input type="text" id="diterima" name="diterima" class="form-control form-control-lg" value="">

                              </td>
                            </tr>
                              <tr>
                                  <th style="width:50%">
                                    Subtotal:
                                  </th>
                                  <td>
                                    <input type="text" id="total_penjualan" class="form-control" name="total_penjualan" value="{{ $dataPenjualan->total_penjualan }}" readonly>
                                  </td>
                              </tr>
                              <tr>
                                  <th>Kembalian:</th>
                                  <td>
                                    <input type="number" name="kembalian" id="kembalian" class="form-control" value="0" readonly>
                                  </td>
                              </tr>
                          </table>
                      </div>
                  </div>
                  <!-- /.col -->
              </div>

                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-12">

                    <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                      <i class="fas fa-download"></i> Simpan
                    </button>
                  </div>
                </div>

              </form>

              </div>
              <!-- /.invoice -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

@endsection


@includeIf('PenjualanProduk.produk')
@includeIf('PenjualanProduk.update')
@includeIf('PenjualanProduk.destroy')

@push('script')
                        <script>
                          // Mengambil elemen-elemen yang diperlukan
                          var diterimaInput = document.getElementById('diterima');
                          var kembalianInput = document.getElementById('kembalian');
                          var totalPenjualanInput = document.getElementById('total_penjualan');

                          // Menambahkan event listener untuk menghitung kembalian saat diterima diubah
                          diterimaInput.addEventListener('input', function () {
                              var diterima = parseFloat(diterimaInput.value); // Mengonversi ke angka, default 0 jika tidak valid
                              var totalPenjualan = parseFloat(totalPenjualanInput.value) || 0; // Mengambil total_penjualan

                              // Menghitung kembalian
                              var kembalian = diterima - totalPenjualan;

                              // Menyimpan hasil kembalian ke input kembalian
                              if (kembalian < 0) {
                                  kembalian = 0; // Setel kembalian menjadi 0 jika negatif
                              }

                              kembalianInput.value = kembalian; // Mengonversi hasil ke dua angka desimal
                          });
                      </script>
                        @endpush
