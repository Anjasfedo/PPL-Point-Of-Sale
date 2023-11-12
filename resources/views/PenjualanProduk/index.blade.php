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
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-toggle="modal" data-target="#modal-produk-data"
                                                   class="btn btn-info btn-flat"><i class="fa fa-arrow-right"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('penjualanproduk.store', [$id_penjualan]) }}" method="post">
                            @csrf
                            @method("POST")
                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-stiped table-bordered table-penjualan" id="example1">
                                        <thead>
                                            <th>Nama</th>
                                            <th>stok</th>
                                            <th width="15%">harga</th>
                                            <th>jumlah</th>
                                            <th>total_harga</th>
                                            <th>aksi</th>
                                        </thead>
                                        <tbody id="tabel-produksss">
                                            <!-- Isi tabel akan ditambahkan menggunakan jQuery -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-7">
                                    <div class="tampil-bayar bg-primary"></div>
                                    <div class="tampil-terbilang"></div>
                                </div>
                                <div class="col-5">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>
                                                    <label for="diterima" class="col-form-label col-form-label-lg">DITERIMA
                                                    </label>
                                                </th>
                                                <td>
                                                    <input type="text" id="diterima" name="diterima"
                                                           class="form-control form-control-lg" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="width:50%">
                                                    Total Penjualan:
                                                </th>
                                                <td>
                                                    <input type="text" id="total_penjualan" class="form-control"
                                                           name="total_penjualan" value="" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Total Item:
                                                </th>
                                                <td>
                                                    <input type="text" id="total_item" class="form-control"
                                                           name="total_item" value="" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Kembalian:
                                                </th>
                                                <td>
                                                    <input type="text" id="kembalian" class="form-control"
                                                           name="kembalian" value="" readonly>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <input name="id_penjualan" type="text" value="{{ $id_penjualan }}" readonly>
                            <input name="id_user" type="text" value="{{ auth()->id() }}" readonly>
                            <div class="row no-print">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Generate PDF
                                    </button>
                                    <button type="button" class="btn btn-warning btn-flat" onclick="notaPenjualan('{{ route('penjualan.notaPenjualan') }}', 'Nota Kecil')">Cetak Nota</button>
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
</div>
@endsection

@includeIf('PenjualanProduk.produk')
@includeIf('PenjualanProduk.update')
@includeIf('PenjualanProduk.destroy')

@push('script')
<script>
$(document).ready(function() {
    var table = $('#example1').DataTable();

    // Function to calculate and update the total_harga for a row
    function updatetotal_harga(row) {
        var hargaJual = parseFloat($(row).find('input[name="harga_jual[]"]').val());
        var jumlah = parseInt($(row).find('input[name="jumlah[]"]').val());
        var total_harga = hargaJual * jumlah;
        $(row).find('input[name="total_harga[]"]').val(total_harga);
        hitungTotal(); // Call the function to update the total
    }

    // Function to calculate and update the kembalian field
    function updateKembalian() {
        var diterima = parseFloat($('#diterima').val());
        var totalPenjualan = parseFloat($('#total_penjualan').val());
        var kembalian = diterima - totalPenjualan;
        $('#kembalian').val(kembalian);
    }

    $(document).on('click', '.tambah-penjualan', function() {
        var id_produk = $(this).data("id_produk");
        var nama_produk = $(this).data("nama_produk");
        var stok = $(this).data("stok");
        var harga_jual = $(this).data("harga_jual");
        var jumlah_barang = 0; // Default qty

        var data = [
            ['<input type="text" class="form-control" name="nama_produk[]" value="' +
                nama_produk + '" readonly>', stok,
                '<input type="text" class="form-control" name="harga_jual[]" value="' +
                harga_jual + '" readonly>',
                '<input type="number" class="form-control qty" name="jumlah[]" min="1" max="' +
                stok + '" value="' +
                jumlah_barang + '" id="jumlah_barang">',
                '<input type="text" class="form-control total_harga" name="total_harga[]" value="0" readonly>',
                '<input type="text" class="form-control" name="id_produk[]" value="' +
                id_produk + '" readonly hidden> <button class="btn btn-sm btn-danger text-white hapus-baris">Remove</button>'
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
        var maxQty = parseInt($(this).attr('max'));
        var inputQty = parseInt($(this).val());
        if (inputQty > maxQty) {
            $(this).val(maxQty); // Set the value to the maximum if it's greater
        }
        updatetotal_harga($(this).closest('tr'));
        updateKembalian(); // Call the function to update kembalian
    });

    // Event listener for diterima change
    $('#diterima').on('input', function() {
        updateKembalian(); // Call the function to update kembalian
    });

    // Function to update the total
    function hitungTotal() {
        var total = 0;
        var totalItem = 0; // Initialize total_item
        $('input[name="total_harga[]"]').each(function() {
            total += parseFloat($(this).val());
        });
        $('input[name="jumlah[]"]').each(function() {
            totalItem += parseInt($(this).val());
        });
        $('#total_penjualan').val(total);
        $('#total_item').val(totalItem); // Update the total_item field
        updateKembalian(); // Call the function to update kembalian
    }
});
</script>

{{--  --}}

<script>
    // tambahkan untuk delete cookie innerHeight terlebih dahulu
    document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    
    function notaPenjualan(url, title) {
        popupCenter(url, title, 625, 500);
    }

    // function notaBesar(url, title) {
    //     popupCenter(url, title, 900, 675);
    // }

    function popupCenter(url, title, w, h) {
        const dualScreenLeft = window.screenLeft !==  undefined ? window.screenLeft : window.screenX;
        const dualScreenTop  = window.screenTop  !==  undefined ? window.screenTop  : window.screenY;

        const width  = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        const systemZoom = width / window.screen.availWidth;
        const left       = (width - w) / 2 / systemZoom + dualScreenLeft
        const top        = (height - h) / 2 / systemZoom + dualScreenTop
        const newWindow  = window.open(url, title, 
        `
            scrollbars=yes,
            width  = ${w / systemZoom}, 
            height = ${h / systemZoom}, 
            top    = ${top}, 
            left   = ${left}
        `
        );

        if (window.focus) newWindow.focus();
    }
</script>
@endpush
