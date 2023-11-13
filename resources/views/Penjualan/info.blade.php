@foreach ($dataPenjualan as $item)
    <!-- Modal for Sale Details -->
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
                                    <div class="card-header">
                                        <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3>
                                    </div>
                                    <div class="card-body">
                                        <p>ID Penjualan:  {{ tambah_nol_didepan($item->id_penjualan, 10) }}</p>
                                        <p>Total Item: {{ $item->total_item }}</p>
                                        <p>Total Harga: {{ format_uang($item->total_penjualan) }}</p>
                                        <p>Waktu Penjualan: {{ $item->created_at->format('d-m-Y H:i') }}</p>

                                        <h5>Related Products:</h5>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    {{-- <th>ID Produk</th> --}}
                                                    <th>Nama Produk</th>
                                                    <th>Harga Jual</th>
                                                    <th>Jumlah</th>
                                                    <th>Total Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataPenjualanProduk as $produk)
                                                    @if ($produk->id_penjualan === $item->id_penjualan)
                                                        <tr>
                                                            {{-- <td>{{ $produk->id_penjualan_produk }}</td> --}}
                                                            <td>
                                                                @if ($produk->produk)
                                                                    {{ $produk->produk->nama_produk }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($produk->produk)
                                                                    {{ format_uang($produk->produk->harga_jual) }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $produk->jumlah }}</td>
                                                            <td>{{ format_uang($produk->total_harga) }}</td>
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