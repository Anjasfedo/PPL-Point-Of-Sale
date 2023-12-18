@foreach ($dataPenjualan as $item)
    <div class="modal fade" id="modal-info{{ $item->id_penjualan }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Sale Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <p>ID Penjualan: {{ tambah_nol_didepan($item->id_penjualan, 10) }}</p>
                                        <p>Total Item: {{ $item->total_item }}</p>
                                        <p>Total Harga: {{ format_uang($item->total_penjualan) }}</p>
                                        <p>Waktu Penjualan: {{ $item->created_at->format('d-m-Y H:i') }}</p>
                                        <h5>Related Products:</h5>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nama Barang</th>
                                                    <th>Harga Jual</th>
                                                    <th>Jumlah</th>
                                                    <th>Total Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataPenjualanBarang as $barang)
                                                    @if ($barang->id_penjualan === $item->id_penjualan)
                                                        <tr>
                                                            <td>
                                                                @if ($barang->barang)
                                                                    {{ $barang->barang->nama_barang }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($barang->barang)
                                                                    {{ format_uang($barang->barang->harga_jual) }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $barang->jumlah }}</td>
                                                            <td>{{ format_uang($barang->total_harga) }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endforeach
