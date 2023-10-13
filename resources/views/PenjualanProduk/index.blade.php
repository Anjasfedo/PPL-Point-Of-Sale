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
                  <div class="col-6">
                    <p>lorem</p>
                  </div>
                  <div class="col-6">
                    <p>lorem</p>
                  </div>
                </div>
                <!-- /.row -->

  <!--  --><form action="{{ route('penjualanproduk.store', [$id_penjualan]) }}" method="POST" enctype="multipart/form-data">
    @csrf
                    
                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-stiped table-bordered table-penjualan" id="products_table">
                      <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach (old('id_produk', ['']) as $index => $oldProduct)
                          <tr>
                              <td>
                                <div class="input-group">
                                  <select name="id_produk[]" class="form-control produk-pilihan select2bs4 product-select">

                                    <option value="">-- choose product --</option>
                                    @foreach ($dataProduk as $item)
                                        <option value="{{ $item->id_produk }}" data-harga="{{ $item->harga_jual }}">
                                            {{ $item->nama_produk }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="input-group-btn">
                                  <a data-toggle="modal" data-target="#modal-produk-data" class="btn btn-info btn-flat"><i class="fa fa-arrow-right"></i></a>
                              </span>
                                </div>
                                  
                              </td>
                              <td>
                                  <input type="text" class="harga-jual form-control" value="" readonly />
                              </td>
                              <td>
                                  <input type="number" name="jumlah[]" class="form-control" value="{{ old('jumlah.' . $index) ?? '1' }}" />
                              </td>
                              <td>
                                  <input type="text" class="total-harga form-control" name="total_harga[]" value="0" readonly />
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
                      </table>

                      <div class="row">
                        <div class="col-md-12">
                            <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                            <button id="add_row" class="btn btn-default pull-right">+ Add Row</button>
                        </div>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                
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
                                <input type="text" id="diterima" name="diterima" class="form-control" value="">

                              </td>
                            </tr>
                              <tr>
                                  <th style="width:50%">
                                    Subtotal:
                                  </th>
                                  <td>
                                    <input type="text" id="total_penjualan" name="total_penjualan" class="form-control" value="" readonly>
                                  </td>
                              </tr>
                              <tr>
                                  <th>Kembalian:</th>
                                  <td>
                                    <input type="text" id="kembalian" name="kembalian" class="form-control" value="" readonly>
                                  </td>
                              </tr>
                          </table>
                      </div>
                  </div>
                  <!-- /.col -->
              </div>

              {{-- input hidden --}}
              <input type="text" id="total_item" name="total_item" class="form-control" value="" readonly>
              <input name="id_penjualan" type="text" value="{{ $id_penjualan }}" readonly>

                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-12">

                    {{-- <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                      <i class="fas fa-download"></i> Lakukan Penjualan
                    </button> --}}

                    <input class="btn btn-danger" type="submit" value="Submit">
                  </div>
                </div>

              </form>
            </div>


              </div>
              <!-- /.invoice -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

      
<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="productModalLabel">Error</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              Please select a product in the last row before adding a new row.
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

@endsection

@includeIf('PenjualanProduk.produk')
{{-- @includeIf('PenjualanProduk.update')
@includeIf('PenjualanProduk.destroy') --}}
@push('script')
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<!-- JavaScript Imports -->



<script>
$(document).ready(function() {
    let row_number = 1;

    function updateTotalPrice() {
        let totalSum = 0;
        let totalItem = 0;
        let totalJumlah = 0;

        $('#products_table tbody tr').each(function() {
            const row = $(this);
            const quantityInput = row.find('input[name="jumlah[]"]');
            let quantity = parseFloat(quantityInput.val()) || 0;

            if (quantity < 1) {
                quantity = 1;
                quantityInput.val(quantity);
            }

            const selectedProduct = row.find('select[name="id_produk[]"] option:selected');
            const price = parseFloat(selectedProduct.data('harga')) || 0;
            const total = quantity * price;
            row.find('.harga-jual').val(price); // Atur harga sesuai dengan harga jual yang dipilih
            row.find('.total-harga').val(total);

            totalSum += total;
            totalItem += quantity;
            totalJumlah += quantity;
        });

        $('#total_penjualan').val(totalSum);
        $('#total_item').val(totalItem);
        $('#total_item').val(totalJumlah);

        updateKembalian();
    }

    $('#add_row').click(function(e) {
        e.preventDefault();

        if (areAllProductsSelected()) {
            const new_row = $('#products_table tbody tr:last').clone();
            new_row.find('input[name="jumlah[]"]').val(1);
            new_row.find('select[name="id_produk[]"]').val('');
            new_row.find('.total-harga').val(0);
            new_row.find('.harga-jual').val('');

            new_row.insertAfter('#products_table tbody tr:last');
            row_number++;
        } else {
            showModal();
        }
    });

    $('#delete_row').click(function(e) {
        e.preventDefault();
        if (row_number > 1) {
            $('#products_table tbody tr:last').remove();
            row_number--;
            updateTotalPrice();
        } else {
            showModal();
        }
    });

    $('#products_table').on('input', 'input[name="jumlah[]"]', function() {
        updateTotalPrice();
    });

    $('#products_table').on('change', 'select[name="id_produk[]"]', function() {
        updateTotalPrice();
    });

    $('form').submit(function(e) {
        if (!areAllProductsSelected()) {
            e.preventDefault();
            showModal();
        }
    });

    function areAllProductsSelected() {
        let allSelected = true;
        $('#products_table select.product-select').each(function() {
            if ($(this).val() === '') {
                allSelected = false;
                return false;
            }
        });
        return allSelected;
    }

    function showModal() {
        $('#productModal').modal('show');
    }

    function updateKembalian() {
        const totalPenjualan = parseFloat($('#total_penjualan').val()) || 0;
        const diterima = parseFloat($('#diterima').val()) || 0;
        const kembalian = diterima - totalPenjualan;
        if (kembalian >= 0) {
            $('#kembalian').val(kembalian);
        } else {
            $('#kembalian').val('');
        }
    }

    $('#diterima').on('input', function() {
        updateKembalian();
    });

    
// Update the event handler for the "Pilih" button in the modal
$('.select-product').click(function(e) {
    e.preventDefault();
    const selectedRow = $(this).closest('tr');
    const selectedProduct = selectedRow.find('td:nth-child(2)').text(); // Adjust the column index as needed
    const productSelect = $('#products_table tbody tr:last select.product-select');
    productSelect.val(selectedProduct); // Set the selected product in the form dropdown
    updateTotalPrice();
    $('#modal-produk-data').modal('hide'); // Close the modal
});

});

</script>

@endpush