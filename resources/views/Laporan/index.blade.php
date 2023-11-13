@extends('Layout.main')

@section('title')
    Laporan
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a data-toggle="modal" data-target="#modal-periode-laporan" class="btn btn-primary">Pilih Periode Hari</a>
                            @includeIf('Laporan.LaporanPeriode')
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tabel-laporan" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Total Penjualan Barang</th>
                                        <th>Pemasukan</th>
                                        <th>Total Pembelian Barang</th>
                                        <th>Pengeluaran</th>
                                        <th>Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $nomorUrut = 1;
                                    $totalPenjualanBarang = 0;
                                    $totalPemasukan = 0;
                                    $totalPembelianStokBarang = 0;
                                    $totalPengeluaran = 0;
                                    $totalPendapatan = 0;
                                    @endphp
                                    @foreach($result as $data)
                                    <tr>
                                        <td>{{ $nomorUrut }}</td>
                                        <td>{{ date('d-m-Y', strtotime($data['tanggal'])) }}</td>
                                        <td>{{ $data['total_penjualan_barang'] }} Barang</td>
                                        <td>{{ format_uang($data['pemasukan']) }}</td>
                                        <td>{{ $data['total_pembelian_stok_barang'] }} Barang</td>
                                        <td>{{ format_uang($data['pengeluaran']) }}</td>
                                        <td>{{ format_uang($data['pendapatan']) }}</td>
                                    </tr>
                                    @php
                                    $nomorUrut++;
                                    $totalPenjualanBarang += $data['total_penjualan_barang'];
                                    $totalPemasukan += $data['pemasukan'];
                                    $totalPembelianStokBarang += $data['total_pembelian_stok_barang'];
                                    $totalPengeluaran += $data['pengeluaran'];
                                    $totalPendapatan += $data['pendapatan'];
                                    @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"><strong>Total</strong></td>
                                        <td><strong>{{ $totalPenjualanBarang }} Barang</strong></td>
                                        <td><strong>{{ format_uang($totalPemasukan) }}</strong></td>
                                        <td><strong>{{ $totalPembelianStokBarang }} Barang</strong></td>
                                        <td><strong>{{ format_uang($totalPengeluaran) }}</strong></td>
                                        <td><strong>{{ format_uang($totalPendapatan) }}</strong></td>
                                    </tr>
                                </tfoot>
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

@push('script')
    <script>
        $(function () {
            $("#tabel-laporan").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "bPaginate": false,
                "bInfo": false,
                buttons: [
                    "colvis",
                    {
                        extend: 'print',
                        footer: true,
                        customize: function (win) {
                            $(win.document.body)
                                .css('font-size', '10pt')

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        },
                        messageTop: 'This print was produced using the Print button for DataTables'
                    },
                    {
                        extend: 'excel',
                        footer: true,
                    },
                    {
                        extend: "copy",
                        footer: true,
                    },
                ],
                columnDefs: [{
                    'targets': -1, // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                }],
            }).buttons().container().appendTo('#tabel-laporan_wrapper .col-md-6:eq(0)');

        });
    </script>
@endpush
