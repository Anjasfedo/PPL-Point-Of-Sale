<div class="modal fade" id="modal-supplier-data">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"">
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
                                <div class="card-body">
                                    <table id="tabel-supplier" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Telepon</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataSupplier as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama_supplier }}</td>
                                                    <td>{{ $item->telepon }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary select-supplier"
                                                            data-id_supplier="{{ $item->id_supplier }}"
                                                            data-name="{{ $item->nama_supplier }}" data-toggle="modal"
                                                            data-target="#modal-pembelian-form">
                                                            Pilih
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
