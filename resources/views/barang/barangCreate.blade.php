<div class="modal fade" id="modal-tambah-barang">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Large Modal</h4>
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
                                <form id="quickForm" action="{{ route('barang.store') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputNamaBarang">Nama</label>
                                            <input type="text" name="nama_barang" class="form-control"
                                                id="inputNamaBarang" placeholder="Masukan Nama barang">
                                            @error('nama_barang')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <select name="id_kategori" id="id_kategori" class="form-control" required>
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($dataKategori as $value)
                                                    <option value="{{ $value->id_kategori }}">
                                                        {{ $value->nama_kategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputHargaJual">harga</label>
                                            <input type="number" name="harga_jual" class="form-control"
                                                id="inputHargaJual" placeholder="Masukan harga barang">
                                            @error('harga_jual')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputStokBarang">stok</label>
                                            <input type="number" name="stok" class="form-control"
                                                id="inputStokBarang" placeholder="Masukan stok barang">
                                            @error('stok')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
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
