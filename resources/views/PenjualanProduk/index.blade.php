<!-- Styles -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>

                    <div class="card-body">
                      <form action="{{ route('penjualanproduk.store', [$id_penjualan]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                        <div class="card">
                            <div class="card-header">
                                Products
                            </div>
                    
                            <div class="card-body">
                                <table class="table" id="products_table">
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
                                                    <select name="id_produk[]" class="form-control produk-pilihan select2bs4">
                                                        <option value="">-- choose product --</option>
                                                        @foreach ($dataProduk as $item)
                                                            <option value="{{ $item->id_produk }}" data-harga="{{ $item->harga_jual }}">
                                                                {{ $item->nama_produk }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                        </div>
                        <div>
                            <input class="btn btn-danger" type="submit" value="Submit">
                        </div>
                    
                        <div class="form-group">
                            <label for="total_penjualan">total_penjualan</label>
                            <input type="text" id="total_penjualan" name="total_penjualan" class="form-control" value="" readonly>
                        </div>
                        <div class="form-group">
                          <label for="total_jumlah">total_jumlah</label>
                          <input type="text" id="total_jumlah" name="total_jumlah" class="form-control" value="" readonly>
                      </div>
                      
                        <div class="form-group">
                            <label for="diterima">diterima</label>
                            <input type="text" id="diterima" name="diterima" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="kembalian">kembalian</label>
                            <input type="text" id="kembalian" name="kembalian" class="form-control" value="" readonly>
                        </div>
                    
                        <div class="form-group">
                            <label for="id_penjualan">id_penjualan</label>
                            <input name="id_penjualan" type="text" value="{{ $id_penjualan }}" readonly>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<!-- JavaScript Imports -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


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
        $('#total_jumlah').val(totalJumlah);

        updateKembalian();
    }

    $('#add_row').click(function(e) {
        e.preventDefault();

        if (areAllProductsSelected()) {
            const new_row = $('#products_table tbody tr:last').clone();
            new_row.find('input[name="jumlah[]"]').val(1);
            new_row.find('select[name="id_produk[]"]').val('');
            new_row.find('.total-harga').val(0);
            new_row.find('.harga-jual').val(''); // Kosongkan harga saat menambahkan baris baru

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
        $('#products_table select[name="id_produk[]"]').each(function() {
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
});

</script>