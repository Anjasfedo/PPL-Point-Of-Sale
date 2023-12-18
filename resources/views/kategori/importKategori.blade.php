<div class="modal fade" id="modal-import-kategori">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Kategori</h4>
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
                                    <h3 class="card-title">Pilih File</h3>
                                </div>
                                <form action="{{ route('kategori-import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body mb-4" style="max-width: 500px; margin: 0 auto;">
                                        <div class="custom-file text-left form-group">
                                            <input type="file" name="kategori" class="custom-file-input" id="customFileKategori" onchange="updateFileName('customFileKategori', 'fileLabelKategori')">
                                            <label class="custom-file-label" for="customFileKategori" id="fileLabelKategori">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button class="btn btn-primary">Import data</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    function updateFileName(inputId, labelId) {
        // Get the input element and the label element
        var input = document.getElementById(inputId);
        var label = document.getElementById(labelId);

        // Update the label text with the selected file name
        label.innerText = input.files[0].name;
    }
</script>
