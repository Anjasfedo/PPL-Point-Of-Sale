@extends('Layout.main')
@section('title')
    Penjualan Barang
@endsection
@section('header')
    <h1 class="m-0">Penjualan Barang</h1>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> {{ strtoupper(auth()->user()->name) }}
                                    <small class="float-right">{{ date('d-m-Y') }}</small>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Barang</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-toggle="modal" data-target="#modal-barang-data"
                                                    class="btn btn-info btn-flat">Pilih Barang <i
                                                        class="m-r2 fa fa-arrow-right"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('penjualanbarang.store', [$id_penjualan]) }}" method="post">
                            @csrf
                            @method('POST')
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
                                        <tbody id="tabel-barangsss">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
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
                                                <th>
                                                    <label for="diterima" class="col-form-label col-form-label-lg">DITERIMA
                                                    </label>
                                                </th>
                                                <td>
                                                    <input type="number" id="diterima" name="diterima"
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
                            <input name="id_penjualan" type="text" value="{{ $id_penjualan }}" readonly hidden>
                            <input name="id_user" type="text" value="{{ auth()->id() }}" readonly hidden>
                            <div class="row no-print">
                                <div class="col-12">
                                    <button type="submit" id="generatePdfBtn" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Proses Transaksi
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection
@includeIf('PenjualanBarang.barang')
@push('script')
    <script>
        function formatUang(angka) {
            return 'Rp' + angka.toLocaleString('id-ID');
        }
        $(document).ready(function() {
            var table = $('#example1').DataTable();

            function updatetotal_harga(row) {
                var hargaJual = parseFloat($(row).find('input[name="harga_jual[]"]').val());
                var jumlah = parseInt($(row).find('input[name="jumlah[]"]').val());
                var total_harga = hargaJual * jumlah;
                $(row).find('input[name="total_harga[]"]').val(total_harga);
                hitungTotal();
            }

            function updateKembalian() {
                var diterima = parseFloat($('#diterima').val());
                var totalPenjualan = parseFloat($('#total_penjualan').val());
                var kembalian = diterima - totalPenjualan;
                if (kembalian < 0 ) {
                    $('#kembalian').val('');
                    $('#generatePdfBtn').prop('disabled', true);
                } else {
                    $('#kembalian').val(kembalian);
                    $('#generatePdfBtn').prop('disabled', false);
                }
            }
            $(document).on('click', '.tambah-penjualan', function() {
                var id_barang = $(this).data("id_barang");
                var nama_barang = $(this).data("nama_barang");
                var stok = $(this).data("stok");
                var harga_jual = $(this).data("harga_jual");
                var jumlah_barang = 0;
                var data = [
                    ['<input type="text" class="form-control" name="nama_barang[]" value="' +
                        nama_barang + '" readonly>', stok,
                        '<input type="text" class="form-control" name="harga_jual[]" value="' +
                        harga_jual + '" readonly>',
                        '<input type="number" class="form-control qty" name="jumlah[]" min="1" max="' +
                        stok + '" value="' +
                        jumlah_barang + '" id="jumlah_barang">',
                        '<input type="text" class="form-control total_harga" name="total_harga[]" value="0" readonly>',
                        '<input type="text" class="form-control" name="id_barang[]" value="' +
                        id_barang +
                        '" readonly hidden> <button class="btn btn-sm btn-danger text-white hapus-baris">Remove</button>'
                    ]
                ];
                var tableRow = table.rows.add(data).draw().node();
            });
            $(document).on('click', '.hapus-baris', function() {
                var row = $(this).closest('tr');
                table.row(row).remove().draw();
                hitungTotal();
            });
            $(document).on('input', 'input.qty', function() {
            var maxQty = parseInt($(this).attr('max'));
            var inputQty = parseInt($(this).val());
            if (inputQty > maxQty) {
                $(this).val(maxQty);
            }
            updatetotal_harga($(this).closest('tr'));
            updateKembalian();
            updateSubmitButton();
        });

        $('#diterima').on('input', function() {
            updateKembalian();
            updateSubmitButton();
        });

        function updateSubmitButton() {
            // Check if any input is empty
            var isEmpty = $('input[name="nama_barang[]"]').filter(function() {
                return $(this).val() === '';
            }).length > 0;

            // Disable or enable the button based on the condition
            $('#generatePdfBtn').prop('disabled', isEmpty);
        }


            function hitungTotal() {
                var total = 0;
                var totalItem = 0;
                $('input[name="total_harga[]"]').each(function() {
                    total += parseFloat($(this).val());
                });
                $('input[name="jumlah[]"]').each(function() {
                    totalItem += parseInt($(this).val());
                });
                $('#total_penjualan').val(total);
                $('#tampil-terbilang').text(`Total: ${formatUang(total)}`)
                $('#total_item').val(totalItem);
                updateKembalian();
            }
        });
    </script>

    <script>
        document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

        function notaPenjualan(url, title) {
            popupCenter(url, title, 625, 500);
        }

        function popupCenter(url, title, w, h) {
            const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
            const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;
            const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document
                .documentElement.clientWidth : screen.width;
            const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document
                .documentElement.clientHeight : screen.height;
            const systemZoom = width / window.screen.availWidth;
            const left = (width - w) / 2 / systemZoom + dualScreenLeft
            const top = (height - h) / 2 / systemZoom + dualScreenTop
            const newWindow = window.open(url, title,
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
