@extends('Layout.main')
@section('title')
    Pembelian Barang
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Pembelian Barang</li>
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
                        action="{{ route('pembelianproduk.store', [$id_pembelian]) }}"
                        method="POST">
                        @csrf
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="">Produk</label>
                          <div class="input-group">
                            <select name="id_produk" class="form-control produk-pilihan select2bs4">
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

                      <div class="form-row">
                        {{-- <div class="form-group col-md-6">
                          <label for="">Supplier</label>
                          <div class="input-group">
                            <select name="id_supplier" class="form-control supplier-pilihan select2bs4">
                              <option value="">-- choose supplier --</option>
                              @foreach ($dataSupplier as $item)
                              <option value="{{ $item->id_supplier }}">{{ $item->nama_supplier }}</option>
                              @endforeach
                          </select>
                            <span class="input-group-btn">
                                <a data-toggle="modal" data-target="#modal-supplier-data" class="btn btn-info btn-flat"><i class="fa fa-arrow-right"></i></a>
                            </span>
                        </div>
                        </div> --}}

                        <div class="form-group col-md-3">
                          <label for="inputHargaSatuan">Harga Satuan</label>
                          <input type="number" class="form-control" id="inputHargaSatuan" value="1" name="harga_beli" step="any">
                      </div>
                      <div class="form-group col-md-3">
                          <label for="inputHargaTotal">Harga Total</label>
                          <input type="number" class="form-control" id="inputHargaTotal" value="1" name="total_harga" step="any">
                      </div>

                      </div>

                      <input name="id_pembelian" type="text" value="{{ $id_pembelian }}" readonly hidden>

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
                    <table class="table table-stiped table-bordered table-pembelian">
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
                          @foreach ($dataPembelianProduk as $item)
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
                                      data-target="#modal-pembelian-detail-edit{{ $item->id_pembelian_produk }}"
                                      class="btn btn-primary">
                                      <i class="fas fa pen">Edit</i>
                                  </a>
                                  <a
                                      data-toggle="modal"
                                      data-target="#modal-pembelian-detail-hapus{{ $item->id_pembelian_produk }}"
                                      class="btn btn-danger">
                                      <i class="fas fa-trash-alt">Hapus</i>
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

                <form action="{{ route('pembelian.update', [$id_pembelian]) }}" method="post">
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
                                    <input type="text" id="total_pembelian" class="form-control" name="total_pembelian" value="{{ $dataPembelian->total_pembelian }}" readonly>
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
                      <i class="fas fa-download"></i> Lakukan Pembelian
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

@includeIf('PembelianProduk.produk')
@includeIf('PembelianProduk.supplier')
@includeIf('PembelianProduk.update')
@includeIf('PembelianProduk.destroy')

@push('script')
                        <script>
                          // Mengambil elemen-elemen yang diperlukan
                          var diterimaInput = document.getElementById('diterima');
                          var kembalianInput = document.getElementById('kembalian');
                          var totalpembelianInput = document.getElementById('total_pembelian');

                          // Menambahkan event listener untuk menghitung kembalian saat diterima diubah
                          diterimaInput.addEventListener('input', function () {
                              var diterima = parseFloat(diterimaInput.value); // Mengonversi ke angka, default 0 jika tidak valid
                              var totalpembelian = parseFloat(totalpembelianInput.value) || 0; // Mengambil total_pembelian

                              // Menghitung kembalian
                              var kembalian = diterima - totalpembelian;

                              // Menyimpan hasil kembalian ke input kembalian
                              if (kembalian < 0) {
                                  kembalian = 0; // Setel kembalian menjadi 0 jika negatif
                              }

                              kembalianInput.value = kembalian; // Mengonversi hasil ke dua angka desimal
                          });
                      </script>

<script>
// Mengambil elemen-elemen yang diperlukan
var jumlahInput = document.getElementById('inputJumlah');
var hargaInput = document.getElementById('inputHargaSatuan');
var totalHargaInput = document.getElementById('inputHargaTotal');

// Menambahkan event listener untuk menghitung total_harga saat jumlah atau harga diubah
jumlahInput.addEventListener('input', updateTotalHarga);
hargaInput.addEventListener('input', updateTotalHarga);

// Fungsi untuk menghitung total_harga
function updateTotalHarga() {
    var jumlah = parseFloat(jumlahInput.value);
    var harga = parseFloat(hargaInput.value);

    // Validasi agar nilai tidak kurang dari 1
    if (isNaN(jumlah) || jumlah < 1) {
        jumlahInput.value = 1;
        jumlah = 1;
    }
    if (isNaN(harga) || harga < 1) {
        hargaInput.value = 1;
        harga = 1;
    }

    totalHargaInput.value = (jumlah * harga); // Menghitung total_harga
}

// Menambahkan event listener untuk menghitung harga saat total_harga diubah
totalHargaInput.addEventListener('input', updateHarga);

// Fungsi untuk menghitung harga
function updateHarga() {
    var totalHarga = parseFloat(totalHargaInput.value);
    var jumlah = parseFloat(jumlahInput.value);

    // Validasi agar nilai tidak kurang dari 1
    if (isNaN(totalHarga) || totalHarga < 1) {
        totalHargaInput.value = 1;
        totalHarga = 1;
    }
    if (isNaN(jumlah) || jumlah < 1) {
        jumlahInput.value = 1;
        jumlah = 1;
    }

    hargaInput.value = (totalHarga / jumlah); // Menghitung harga
}

</script>
                        @endpush
