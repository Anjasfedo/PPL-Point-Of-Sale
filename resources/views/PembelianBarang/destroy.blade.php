@foreach ($dataPembelianBarang as $item)
    <div class="modal fade" id="modal-pembelian-detail-hapus{{ $item->id_pembelian_barang }}">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Hapus</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Konfirmasi Hapus data
                        <b>{{ $item->nama_barang }}</b>
                    </p>
                </div>
                <div class="modal-footer justify-content-center text-center">
                    <form action="{{ route('pembelianbarang.destroy', [$item->id_pembelian_barang]) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-light">HAPUS</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
