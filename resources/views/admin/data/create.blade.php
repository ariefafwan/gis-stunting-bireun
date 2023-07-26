<!-- Modal Untuk Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <form class="col-lg-12" action="{{ route('data.store' ) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="periode" class="form-label fw-bold">Periode Tahun Kasus</label>
                    <select class="form-select" id="periode" name="periode_tahun_id" aria-label="Default select example">
                        <option selected>Pilih Periode Tahun</option>
                        @foreach ($periode as $item)
                            <option value="{{ $item->id }}">{{ $item->tahun }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kecamatan" class="form-label fw-bold">Kecamatan</label>
                    <select class="form-select" id="kecamatan" name="kecamatan_id" aria-label="Default select example">
                        <option selected>Pilih Kecamatan</option>
                        @foreach ($kecamatan as $kec)
                            <option value="{{ $kec->id }}">{{ $kec->nama_kecamatan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="cluster_id" class="form-label fw-bold">Kecamatan</label>
                    <select class="form-select" id="cluster_id" name="cluster_id" aria-label="Default select example">
                        <option selected>Pilih Cluster</option>
                        @foreach ($cluster as $clus)
                            <option value="{{ $clus->id }}">{{ $clus->nama_cluster }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah_anak" class="form-label fw-bold">Jumlah Anak</label>
                    <input type="number" class="form-control" id="jumlah_anak" name="jumlah_anak" placeholder="Masukkan Jumlah Anak...">
                </div>
                <div class="mb-3">
                    <label for="jumlah_kasus_pendek" class="form-label fw-bold">Jumlah Kasus Pendek</label>
                    <input type="number" class="form-control" id="jumlah_kasus_pendek" name="jumlah_kasus_pendek" placeholder="Masukkan Jumlah Kasus Pendek...">
                </div>
                <div class="mb-3">
                    <label for="jumlah_kasus_sangatpendek" class="form-label fw-bold">Jumlah Kasus Sangat Pendek</label>
                    <input type="number" class="form-control" id="jumlah_kasus_sangatpendek" name="jumlah_kasus_sangatpendek" placeholder="Masukkan Jumlah Kasus Sangat Pendek...">
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