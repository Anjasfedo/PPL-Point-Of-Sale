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
                    <form action="" method="POST" id="penjualan-form">
                      @csrf
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Email</label>
                          <div class="input-group">
                            <select name="produkTabel" class="form-control select2bs4">
                              <option value="">-- choose product --</option>
                              @foreach ($dataProduk as $item)
                              <option value="{{ $item->id_produk }}, {{ $item->nama_produk }}, {{ $item->harga_jual }}">{{ $item->nama_produk }}</option>
                              @endforeach
                            </select>
                            <span class="input-group-btn">
                              <a data-toggle="modal" data-target="#modal-produk-data" class="btn btn-info btn-flat"><i class="fa fa-arrow-right"></i></a>
                            </span>
                          </div>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputJumlah">Jumlah</label>
                          <input type="number" class="form-control" id="inputJumlah" value="1" name="jumlahTabel">
                        </div>
                      </div>
                    
                      
                    
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
                    <table class="table table-stiped table-bordered table-penjualan">
                      <thead>
                          {{-- <th width="5%">No</th> --}}
                          <th>Nama</th>
                          <th>Harga</th>
                          <th width="15%">Jumlah</th>
                          <th>Subtotal</th>
                          <th width="15%">
                              <i class="fa fa-cog"></i>
                          </th>
                      </thead>
                      <tbody id="tabel-produksss">
                        <!-- Isi tabel akan ditambahkan menggunakan jQuery -->
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
                                    Total Pejualan:
                                  </th>
                                  <td>
                                    <input type="text" id="total_penjualan" class="form-control" name="total_penjualan" value="" readonly>
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

              <input name="id_penjualan" type="text" value="{{ $id_penjualan }}" readonly>

              <input name="id_produk" type="text" value="" readonly>
              <input name="jumlah" type="text" value="" readonly>
              <input name="total_harga" type="text" value="" readonly>

                  
              
                <!-- /.row -->
  
                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-12">
                    
                    <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                      <i class="fas fa-download"></i> Generate PDF
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
  $(document).ready(function() {
  // Inisialisasi total penjualan dan kembalian
  var totalPenjualan = 0;
  var kembalian = 0;

  // Set nilai inisiasi jumlah menjadi 1 saat menambahkan baris baru
  var jumlah = 1;

  $("#penjualan-form").submit(function(event) {
    event.preventDefault(); // Mencegah pengiriman standar formulir

    // Dapatkan nilai dari formulir
    var idProduk = $("select[name='produkTabel']").val();

    // Lakukan validasi atau operasi lain sesuai kebutuhan

    // Memisahkan nilai opsi menjadi bagian yang sesuai
    var optionValues = idProduk.split(', ');

    if (optionValues.length === 3) {
      var namaProduk = optionValues[1];
      var hargaJual = parseFloat(optionValues[2]); // Mengonversi ke angka

      // Hitung subtotal
      var subtotal = hargaJual * jumlah;

      // Tambahkan baris ke tabel
      var newRow = "<tr><td>" + namaProduk + "</td><td>" + hargaJual + "</td><td><input type='number' class='input-jumlah' value='" + jumlah + "'></td><td class='subtotal'>" + subtotal + "</td><td><a class='btn btn-danger delete-row'><i class='fas fa-trash-alt'>Delete</i></a></td></tr>";
      $("#tabel-produksss").append(newRow);

      // Tambahkan subtotal ke total penjualan
      totalPenjualan += subtotal;

      // Update input total penjualan
      $("#total_penjualan").val(totalPenjualan);

      // Kosongkan nilai formulir
      $("select[name='produkTabel']").val("");

      // Simpan data dari baris yang baru ditambahkan ke dalam input yang bersangkutan
      var id_produk_values = $("input[name='id_produk']").val(); // Ambil nilai yang sudah ada
      var jumlah_values = $("input[name='jumlah']").val(); // Ambil nilai yang sudah ada

      // Tambahkan data dari baris baru
      if (id_produk_values !== '') {
        id_produk_values += ',';
      }
      if (jumlah_values !== '') {
        jumlah_values += ',';
      }
      
      id_produk_values += optionValues[0]; // Menambahkan id_produk baru
      jumlah_values += jumlah; // Menambahkan jumlah baru

      // Update input yang bersangkutan
      $("input[name='id_produk']").val(id_produk_values);
      $("input[name='jumlah']").val(jumlah_values);
    }
  });

  // Tambahkan event handler untuk tombol "Delete"
  $("#tabel-produksss").on("click", ".delete-row", function() {
    // Implementasikan logika delete di sini
    // Anda dapat menggunakan $(this).closest("tr") untuk mendapatkan baris yang akan dihapus
    var row = $(this).closest("tr");
    var subtotal = parseFloat(row.find(".subtotal").text());

    // Kurangi subtotal dari total penjualan
    totalPenjualan -= subtotal;

    // Update input total penjualan
    $("#total_penjualan").val(totalPenjualan);

    // Ambil data yang akan dihapus
    var id_produk_values = $("input[name='id_produk']").val();
    var jumlah_values = $("input[name='jumlah']").val();

    // Mendapatkan id_produk dan jumlah pada baris yang akan dihapus
    var id_produk_to_remove = optionValues[0];
    var jumlah_to_remove = jumlah;

    // Hapus data yang sesuai dari nilai yang ada
    id_produk_values = id_produk_values.replace(id_produk_to_remove + ',', '');
    jumlah_values = jumlah_values.replace(jumlah_to_remove + ',', '');

    // Update input yang bersangkutan
    $("input[name='id_produk']").val(id_produk_values);
    $("input[name='jumlah']").val(jumlah_values);

    row.remove();

    // Perbarui kembalian saat menghapus baris
    updateKembalian();
  });

  // Tambahkan event handler untuk menghitung subtotal saat nilai "Jumlah" berubah
  $("#tabel-produksss").on("input", ".input-jumlah", function() {
    var row = $(this).closest("tr");
    var hargaJual = parseFloat(row.find("td:eq(1)").text()); // Ambil harga jual dari kolom kedua
    jumlah = parseFloat($(this).val()); // Ambil nilai jumlah yang baru diinput

    if (!isNaN(hargaJual) && !isNaN(jumlah)) {
      var subtotal = hargaJual * jumlah;
      row.find(".subtotal").text(subtotal);

      // Perbarui total penjualan
      totalPenjualan = 0;
      $("#tabel-produksss .subtotal").each(function() {
        totalPenjualan += parseFloat($(this).text());
      });
      $("#total_penjualan").val(totalPenjualan);

      // Perbarui kembalian saat jumlah diubah
      updateKembalian();
    }
  });

  // Event handler saat nilai "diterima" berubah
  $("#diterima").on("input", function() {
    updateKembalian();
  });

  // Fungsi untuk menghitung dan memperbarui kembalian
  function updateKembalian() {
    var diterima = parseFloat($("#diterima").val());

    if (!isNaN(diterima)) {
      kembalian = diterima - totalPenjualan;
      $("#kembalian").val(kembalian);
    }
  }
});


</script>



@endpush