<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="modal-detail-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-detail-label">Detail Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2>Detail Laporan Tanggal: {{ $tanggal }}</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Deskripsi</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataDetail as $index => $detail)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>Total Penjualan Barang</td>
                                <td>{{ $detail['total_penjualan_barang'] }} Barang</td>
                            </tr>
                            <tr>
                                <td>{{ $index + 2 }}</td>
                                <td>Pemasukan</td>
                                <td>Rp. {{ $detail['pemasukan'] }}</td>
                            </tr>
                            <tr>
                                <td>{{ $index + 3 }}</td>
                                <td>Total Pembelian Stok Barang</td>
                                <td>{{ $detail['total_pembelian_stok_barang'] }} Barang</td>
                            </tr>
                            <tr>
                                <td>{{ $index + 4 }}</td>
                                <td>Pengeluaran</td>
                                <td>Rp. {{ $detail['pengeluaran'] }}</td>
                            </tr>
                            <tr>
                                <td>{{ $index + 5 }}</td>
                                <td>Pendapatan</td>
                                <td>Rp. {{ $detail['pendapatan'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
