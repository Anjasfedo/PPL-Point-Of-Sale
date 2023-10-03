<div class="modal fade" id="modal-import-kategori">
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
                    <form action="{{ route('kategori-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                            <div class="custom-file text-left">
                                <input type="file" name="kategori" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <button class="btn btn-primary">Import data</button>
                        {{-- <a class="btn btn-success" href="{{ route('kategori-export') }}">Export data</a> --}}
                    </form>


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
