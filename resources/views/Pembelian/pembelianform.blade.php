<div class="modal fade" id="modal-pembelian-form">
    <div class="modal-dialog modal-sm modal-dialog-centered">
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
              <!-- left column -->
              <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3>
                  </div>
  
  
  <div class="card-body">
    @foreach ($dataPembelian as $item)
    <!-- Tambahkan elemen input tersembunyi -->
    <form
        method="POST"
        action="{{ route('pembelian.store', [$item->id_pembelian]) }}" method="POST">
        @endforeach
        @csrf
        @method('POST')
        <input type="number" name="id_supplier" id="selected_supplier" value="" readonly>
        <button type="submit" class="btn btn-primary">Tambah pembelian</button>
    </form>
  </div>
  <!-- /.card -->
  </div>
  <!--/.col (left) -->
  <!-- right column -->
  <div class="col-md-6">
  
  </div>
  <!--/.col (right) -->
  </div>
  <!-- /.row -->
  </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  </div>
  <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  
  </div>
  <!-- /.modal -->

