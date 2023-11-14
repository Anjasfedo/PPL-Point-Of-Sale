@foreach ($dataPembelian as $item)
    <div class="modal fade" id="modal-info{{ $item->id_pembelian }}">
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
                                    <div class="card-header">
                                        <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3>
                                    </div>
                                    <div class="card-body">
                                        <p>ID Penjualan: {{ tambah_nol_didepan($item->id_pembelian, 10) }}</p>
                                        <p>Total Item: {{ $item->total_item }}</p>
                                        <p>Total Harga: {{ $item->total_pembelian }}</p>
                                        <p>Waktu Pembelian: {{ $item->created_at->format('d-m-Y H:i') }}</p>
                                        <h5>Related Products:</h5>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nama Barang</th>
                                                    <th>Supplier</th>
                                                    <th>Harga Jual</th>
                                                    <th>Jumlah</th>
                                                    <th>Total Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataPembelianBarang as $barang)
                                                    @if ($barang->id_pembelian === $item->id_pembelian)
                                                        <tr>
                                                            <td>
                                                                @if ($barang->barang)
                                                                    {{ $barang->barang->nama_barang }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $barang->supplier->nama_supplier }}</td>
                                                            <td>
                                                                @if ($barang->barang)
                                                                    {{ $barang->barang->harga_jual }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $barang->jumlah }}</td>
                                                            <td>{{ $barang->total_harga }}</td>
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
