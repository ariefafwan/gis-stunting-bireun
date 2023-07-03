@extends('admin.partials.app')
@section('body')

<div class="row my-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-success shadow h-95 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Skills</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">#</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-tasks" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-warning shadow h-95 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Projects</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">#</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-thermometer-half" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card card-primary shadow h-95">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Pintasan</div>
                        <div class="btn-group">
                            <a href="#" class="btn btn-primary">Home</a>
                            <a href="#" class="btn btn-primary">Profile</a>
                            <a href="#" class="btn btn-primary">Setting</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-primary">
            
        </div>
    </div> --}}
</div>

@endsection