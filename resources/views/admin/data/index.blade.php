@extends('admin.partials.app')
@section('body')


<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-md-8">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="bi bi-plus-circle"></i>&nbsp;Tambah Data</button>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#importmodal"><i class="bi bi-arrow-down-circle"></i>&nbsp;Import Data </button>
                            <a href="{{ route('data.export') }}" class="btn btn-success"><i class="bi bi-cloud-upload-fill" target="_blank"></i>&nbsp;Export Data </a>
                        </div>
                    </div>
                    <hr>                    
                    @include('admin.data.create')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label>Pilih Tahun</label>
                                    <select class="form-select tahun" name="">
                                        @foreach ($tahun as $index)
                                        <option value="{{ $index->tahun }}">{{ $index->tahun }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table id="datatable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tahun Kasus</th>
                                            <th>Kecamatan</th>
                                            <th>Jumlah Anak</th>
                                            <th>Jumlah Kasus Pendek</th>
                                            <th>Jumlah Kasus Sangat Pendek</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $index => $row)
                                        <tr>
                                            <td align="center" scope="row">{{ $data->count() * ($data->currentPage() - 1) + $loop->iteration }}</td>
                                            <td>{{ $row->periode_tahun->tahun }}</td>
                                            <td>{{ $row->kecamatan->nama_kecamatan }}</td>
                                            <td>{{ $row->jumlah_anak }}</td>
                                            <td>{{ $row->jumlah_kasus_pendek }}</td>
                                            <td>{{ $row->jumlah_kasus_sangatpendek }}</td>
                                            <td align="center" class="d-flex justify-content-evenly">
                                                <a href="#!" class="btn btn-warning edit" data-id="{{ $row->id }} data-bs-toggle="modal" data-bs-target="#editModal">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="btn btn-danger" onclick="event.preventDefault();
                                                            document.getElementById('data-delete-form-{{ $row->id }}').submit();">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                                <form id="data-delete-form-{{$row->id}}"
                                                    action="{{ route('data.destroy', $row->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Import Excel-->
                    <div class="modal fade" id="importmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="post" action="{{ route('data.import') }}" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Import Data</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="file" id="file" name="file" required="required">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>&nbspClose</button>
                                        <button type="submit" class="btn btn-success"><i class="bi bi-file-earmark-plus"></i>&nbspImport</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @include('admin.data.edit')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
    //edit data
    $('.edit').on("click",function() {
    var id = $(this).attr('data-id');
    $.ajax({
    url: '/admin/editdatakasus/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
        $('#editid').val(data.id);
        $('#editperiode').val(data.periode_tahun_id);
        $('#editkecamatan').val(data.kecamatan_id);
        $('#editjumlahanak').val(data.jumlah_anak);
        $('#editjumlahpendek').val(data.jumlah_kasus_pendek);
        $('#editjumlahsangatpendek').val(data.jumlah_kasus_sangatpendek);
        $('#editModal').modal('show');
    }
    });
    });
    });
</script>
<script>
    $(document).ready(function() {
	    var table = $('#datatable').DataTable();
        
	    function filterData () {
		    $('#datatable').DataTable().search(
		        $('.tahun').val()
		    	).draw();
		}
		$('.tahun').on('change', function () {
	        filterData();
	    });
	});
</script>
@endsection