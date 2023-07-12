<!-- Modal Untuk Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <form class="col-lg-12" action="{{ route('tahun.store' ) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="tahun" class="form-label fw-bold">Tahun</label>
                    <input type="text" class="form-control" id="tahun" name="tahun" placeholder="Masukkan Tahun...">
                </div>
        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>&nbspClose</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-file-earmark-plus"></i>&nbspSubmit</button>
                </div>
            </form>
    </div>
    </div>
</div>