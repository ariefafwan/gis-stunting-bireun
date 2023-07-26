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
                        </div>
                    </div>
                    <hr>
                    @include('admin.cluster.create')
                    <table id="datatable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Cluster</th>
                                <th>Jarak Terdekat</th>
                                <th>Jarak Terjauh</th>
                                <th>Warna</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cluster as $index => $row)
                            <tr>
                                <td scope="row">{{ $index + 1 }}</td>
                                <td>{{ $row->nama_cluster }}</td>
                                <td>{{ $row->jarak_terdekat }}</td>
                                <td>{{ $row->jarak_terjauh }}</td>
                                <td>{{ $row->warna }}</td>
                                <td align="center" class="d-flex justify-content-evenly">
                                    <a href="#!" class="btn btn-warning edit" data-id="{{ $row->id }} data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-danger" onclick="event.preventDefault();
                                                document.getElementById('cluster-delete-form-{{ $row->id }}').submit();">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <form id="cluster-delete-form-{{$row->id}}"
                                        action="{{ route('cluster.destroy', $row->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('admin.cluster.edit')
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
    url: '/admin/iddatacluster/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
        $('#editid').val(data.id);
        $('#editnamacluster').val(data.nama_cluster);
        $('#editwarna').val(data.warna);
        $('#editjarak_terdekat').val(data.jarak_terdekat);
        $('#editjarak_terjauh').val(data.jarak_terjauh);
        $('#editModal').modal('show');
    }
    });
    });
    });
</script>
@endsection