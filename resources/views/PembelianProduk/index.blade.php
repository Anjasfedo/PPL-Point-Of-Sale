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
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> {{ strtoupper(auth()->user()->name) }}
                                    <small class="float-right">{{ date('d-m-Y') }}</small>
                                </h4>
                            </div>
                        </div>
                        <form action="{{ route('pembelianproduk.store', [$id_pembelian]) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="id_supplier">Supplier</label>
                                            <div class="input-group">
                                                <select name="id_supplier" class="form-control supplier-pilihan d-none">
                                                    <option value="">-- Pilih Supplier --</option>
                                                    @foreach ($dataSupplier as $item)
                                                        <option value="{{ $item->id_supplier }}">{{ $item->nama_supplier }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="input-group-btn">
                                                    <a data-toggle="modal" data-target="#modal-supplier-data"
                                                    class="btn btn-info btn-flat">Pilih Supplier   <i class="m-r2 fa fa-arrow-right"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="produk">Produk</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a data-toggle="modal" data-target="#modal-produk-data"
                                                    class="btn btn-info btn-flat">Pilih Produk   <i class="m-r2 fa fa-arrow-right"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <input name="id_pembelian" type="text" value="{{ $id_pembelian }}" readonly hidden>
                                </div>
                            </div>

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-stiped table-bordered table-pembelian" id="example2">
                                        <thead>
                                            <th>Nama</th>
                                            <th>Stok</th>
                                            <th width="15%">Harga Beli</th>
                                            <th>Jumlah</th>
                                            <th>Total Harga</th>
                                            <th>Aksi</th>
                                        </thead>
                                        <tbody id="tabel-produk-pembelian"></tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-7">
                                    <div class="bg-primary"></div>
                                    <div id="tampil-terbilang" class="alert alert-primary text-center display-4">
                                        Total: 
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th><label for="diterima" class="col-form-label col-form-label-lg">DITERIMA</label>
                                                </th>
                                                <td>
                                                    <input type="text" id="diterima" name="diterima" class="form-control form-control-lg"
                                                           value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>
                                                    <input type="text" id="total_pembelian" class="form-control" name="total_pembelian"
                                                           value="{{ $dataPembelian->total_pembelian }}" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Kembalian:</th>
                                                <td>
                                                    <input type="number" name="kembalian" id="kembalian" class="form-control" value="0"
                                                           readonly>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

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
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@includeIf('PembelianProduk.produk')
@includeIf('PembelianProduk.supplier')


@push('script')
<script>

function formatUang(angka) {
    return 'Rp' + angka.toLocaleString('id-ID');
}

  $(document).ready(function() {
      var table = $('#example2').DataTable();
  
      // Function to calculate and update the total_harga for a row
      function updatetotal_harga(row) {
          var hargaBeli = parseFloat($(row).find('input[name="harga_beli[]"]').val());
          var jumlah = parseInt($(row).find('input[name="jumlah[]"]').val());
          var total_harga = hargaBeli * jumlah;
          $(row).find('input[name="total_harga[]"]').val(total_harga);
          hitungTotal(); // Call the function to update the total
      }
  
      // Function to calculate and update the kembalian field
      function updateKembalian() {
          var diterima = parseFloat($('#diterima').val());
          var totalPembelian = parseFloat($('#total_pembelian').val());
          var kembalian = diterima - totalPembelian;
          $('#kembalian').val(kembalian);
      }

      // Event listener for changing the harga_beli
      $(document).on('input', 'input[name="harga_beli[]"]', function() {
          updatetotal_harga($(this).closest('tr')); // Update total_harga on price change
      });

      $(document).on('click', '.tambah-pembelian', function() {
          var id_produk = $(this).data("id_produk");
          var nama_produk = $(this).data("nama_produk");
          var stok = $(this).data("stok");
          var harga_beli = Math.floor($(this).data("harga_jual") * 0.5);
          var jumlah_barang = 0; // Default qty
  
          var data = [
              ['<input type="text" class="form-control" name="nama_produk[]" value="' + nama_produk + '" readonly>',
               stok,
               '<input type="number" class="form-control" name="harga_beli[]" value="' + harga_beli + '" >',
               '<input type="number" class="form-control qty" name="jumlah[]" min="1" value="' + jumlah_barang + '" id="jumlah_barang">',
               '<input type="number" class="form-control total_harga" name="total_harga[]" value="0">',
               '<input type="text" class="form-control" name="id_produk[]" value="' + id_produk + '" readonly hidden> <button class="btn btn-sm btn-danger text-white hapus-baris">Remove</button>'
              ]
          ];
          var tableRow = table.rows.add(data).draw().node();
      });

      $(document).on('click', '.hapus-baris', function() {
          var row = $(this).closest('tr');
          table.row(row).remove().draw();
          hitungTotal();
      });

      // Event listener for quantity change
      $(document).on('input', 'input.qty', function() {
          var minQty = parseInt($(this).attr('min'));
          var inputQty = parseInt($(this).val());
          if (inputQty < minQty) {
              $(this).val(minQty); // Set the value to the minimum if it's less
          }
          updatetotal_harga($(this).closest('tr'));
          updateKembalian();
      });

      // Event listener for diterima change
      $('#diterima').on('input', function() {
          updateKembalian();
      });

      // Function to update the total
      function hitungTotal() {
          var total = 0;
          var totalItem = 0;
          $('input[name="total_harga[]"]').each(function() {
              total += parseFloat($(this).val());
          });
          $('input[name="jumlah[]"]').each(function() {
              totalItem += parseInt($(this).val());
          });
          $('#total_pembelian').val(total);

          $('#tampil-terbilang').text(`Total: ${formatUang(total)}`)

          $('#total_item').val(totalItem);
          updateKembalian();
      }
  });
  </script>
  
@endpush
