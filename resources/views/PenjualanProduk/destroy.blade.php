@foreach ($dataPenjualanProduk as $item)
{{-- modal delete --}}
<div
class="modal fade"
id="modal-penjualan-detail-hapus{{ $item->id_penjualan_produk }}">
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
                <b>{{ $item->nama_produk }}</b>
            </p>
        </div>
        <div class="modal-footer justify-content-center text-center">
            {{-- <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>  --}}
            <form action="{{ route('penjualanproduk.destroy', [$item->id_penjualan_produk]) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-outline-light">HAPUS</button>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endforeach