<div class="modal fade" id="modal-tambah-supplier">
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
              <!-- left column -->
              <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3>
                  </div>
                  
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form id="quickForm" action="{{ route('supplier.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputNamaSupplier">Nama</label>
                            <input type="text" name="nama_supplier" class="form-control" id="inputNamaSupplier" placeholder="Masukan Nama supplier">
                            @error('nama_supplier')
    <small>{{ $message }}</small>
@enderror
                          </div>
                          <div class="form-group">
                            <label for="inputTeleponSupplier">Telepon</label>
                            <input type="text" name="telepon" class="form-control" id="inputTeleponSupplier" placeholder="Masukan Nama supplier">
                            @error('telepon')
    <small>{{ $message }}</small>
@enderror
                          </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
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