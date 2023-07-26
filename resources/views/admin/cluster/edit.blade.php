<!-- Modal Untuk Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <form class="col-lg-12" action="{{ route('cluster.update' ) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" id="editid" name="id">
                <div class="mb-3">
                    <label for="editnamacluster" class="form-label fw-bold">Nama Kecamatan</label>
                    <input type="text" class="form-control" id="editnamacluster" name="nama_cluster" placeholder="Masukkan Nama Cluster..." autofocus>
                </div>
                <div class="mb-3">
                    <label for="editjarak_terdekat" class="form-label fw-bold">Jarak Terdekat</label>
                    <input type="number" class="form-control" id="editjarak_terdekat" name="jarak_terdekat" required="required" placeholder="Masukkan Jarak...">
                </div>
                <div class="mb-3">
                    <label for="editjarak_terjauh" class="form-label fw-bold">Jarak Terjauh</label>
                    <input type="number" class="form-control" id="editjarak_terjauh" name="jarak_terjauh" required="required" placeholder="Masukkan Jarak...">
                </div>
                jarak_terjauh
                <div class="mb-3">
                    <label for="editwarna" class="form-label fw-bold">Warna</label>
                    <input type="text" class="form-control" id="editwarna" name="warna" required="required" placeholder="Masukkan Kode Warna CLuster...">
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