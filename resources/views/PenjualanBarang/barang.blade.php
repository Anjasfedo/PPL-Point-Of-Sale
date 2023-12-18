<div class="modal fade" id="modal-barang-data">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Penjualan</h4>
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
                                    <h3 class="card-title">Pilih Barang</h3>
                                </div>
                                <div class="card-body">
                                    <table id="tabel-barang" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>kategori</th>
                                                <th>harga</th>
                                                <th>stok</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataBarang as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama_barang }}</td>

                                                    <td>
                                                        @if ($item->kategori)
                                                            {{ $item->kategori->nama_kategori }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->harga_jual }}</td>
                                                    <td>{{ $item->stok }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary tambah-penjualan"
                                                            data-id_barang="{{ $item->id_barang }}"
                                                            data-nama_barang="{{ $item->nama_barang }}"
                                                            data-harga_jual="{{ $item->harga_jual }}"
                                                            data-stok="{{ $item->stok }}">
                                                            Pilih
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
