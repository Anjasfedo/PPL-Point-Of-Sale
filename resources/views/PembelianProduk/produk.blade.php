<div class="modal fade" id="modal-produk-data">
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
    <table id="tabel-produk" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>No</th>
        <th>ID</th>
        <th>Nama</th>
        <th>kategori</th>
        <th>harga</th>
        <th>stok</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($dataProduk as $item)
            <tr>
               
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->id_produk }}</td>
                <td>{{ $item->nama_produk }}</td>
               
                 <td>
                  @if ($item->kategori)
  {{ $item->kategori->nama_kategori }}
  @endif
                </td>
                 <td>{{ $item->harga_jual }}</td>
                 <td>{{ $item->stok }}</td>
                 <td>
                  <!-- Di dalam modal -->
                  <a href="#" class="btn btn-primary tambah-pembelian" data-id_produk="{{ $item->id_produk }}" data-nama_produk="{{ $item->nama_produk }}" data-harga_jual="{{ $item->harga_jual }}" data-stok="{{ $item->stok }}">
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