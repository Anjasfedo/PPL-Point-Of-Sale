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
                        <table id="tabel-data" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Total Penjualan Barang</th>
                                    <th>Pemasukan</th>
                                    <th>Total Pembelian Stok Barang</th>
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
                                    <td>{{ $data['tanggal'] }}</td>
                                    <td>{{ $data['total_penjualan_barang'] }} Barang</td>
                                    <td>Rp. {{ $data['pemasukan'] }}</td>
                                    <td>{{ $data['total_pembelian_stok_barang'] }} Barang</td>
                                    <td>Rp. {{ $data['pengeluaran'] }}</td>
                                    <td>Rp. {{ $data['pendapatan'] }}</td>
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
                                    <td><strong>Rp. {{ $totalPemasukan }}</strong></td>
                                    <td><strong>{{ $totalPembelianStokBarang }} Barang</strong></td>
                                    <td><strong>Rp. {{ $totalPengeluaran }}</strong></td>
                                    <td><strong>Rp. {{ $totalPendapatan }}</strong></td>
                                    <td></td>
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


