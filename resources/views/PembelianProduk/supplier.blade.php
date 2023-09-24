<div class="modal fade" id="modal-supplier-data">
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
  
  
  <div class="card-body">
    <table id="tabel-supplier" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>No</th>
        <th>ID</th>
        <th>Nama</th>
        <th>telepon</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($dataSupplier as $item)
            <tr>
               
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->id_supplier }}</td>
                <td>{{ $item->nama_supplier }}</td>
                 <td>{{ $item->telepon }}</td>
                 <td>
                  <!-- Di dalam modal -->
  <a href="#" class="btn btn-primary select-supplier" data-id="{{ $item->id_supplier }}" data-name="{{ $item->nama_supplier }}">
    Pilih
  </a>
     
                </td>
            </tr>
  
          
  
              
            
          @endforeach 
      </tbody>
  
    
      
    </table>
  </div>
  
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