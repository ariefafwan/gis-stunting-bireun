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
                    @include('admin.tahun.create')
                    <table id="datatable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Periode Tahun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tahun as $index => $row)
                            <tr>
                                <td scope="row">{{ $index + 1 }}</td>
                                <td>{{ $row->tahun }}</td>
                                <td align="center" class="d-flex justify-content-evenly">
                                    <a href="javascript:void(0)" class="btn btn-danger" onclick="event.preventDefault();
                                                document.getElementById('data-delete-form-{{ $row->id }}').submit();">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <form id="data-delete-form-{{$row->id}}"
                                        action="{{ route('tahun.destroy', $row->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Modal Import Excel-->
                    <div class="modal fade" id="importmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="post" action="{{ route('kecamatan.import') }}" enctype="multipart/form-data">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection