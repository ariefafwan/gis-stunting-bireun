<!-- Modal Untuk Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <form class="col-lg-12" action="{{ route('kecamatan.store' ) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_kecamatan" class="form-label fw-bold">Nama Kecamatan</label>
                    <input type="text" class="form-control" id="nama_kecamatan" name="nama_kecamatan" placeholder="Masukkan Nama Kecamatan...">
                </div>
                <div class="mb-3">
                    <label for="geojson" class="form-label fw-bold">GeoJSON</label>
                    <input type="file" class="form-control" id="geojson" name="geojson" required="required">
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