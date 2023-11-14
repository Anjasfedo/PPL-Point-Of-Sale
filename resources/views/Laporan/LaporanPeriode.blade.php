<div class="modal fade" id="modal-periode-laporan">
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
                                <form action="{{ route('laporan.index') }}" method="get">
                                    <div class="card-body mb-4" style="max-width: 500px; margin: 0 auto;">
                                        <div class="form-group">
                                            <label for="tanggal_awal">Tanggal Awal</label>
                                            <input type="date" name="tanggal_awal" class="form-control"
                                                value="{{ old('tanggal_awal') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_akhir">Tanggal Akhir</label>
                                            <input type="date" name="tanggal_akhir" class="form-control"
                                                value="{{ old('tanggal_akhir') }}">
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-primary">Tampilkan Data</button>
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
