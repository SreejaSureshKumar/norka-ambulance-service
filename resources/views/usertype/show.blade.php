@extends('admin.app')

@section('content')
<div class="row mb-4">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <h2 class="mb-0"></h2>
        <a class="btn btn-primary" href="{{ route('users.index') }}"><i class="ti ti-arrow-left"></i> Back</a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="ti ti-user-edit"></i>  Usertype Details</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label"><strong>Name:</strong></label>
                    <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $usertype->usertype_name }}" disabled>
                </div>
               
                <div class="mb-3">
                    <label class="form-label"><strong>Active:</strong></label>
                    @if ($usertype->usertype_status == 1)
                        <span class="badge bg-success">Active</span>
                        
                    @else
                    <span class="badge bg-success">Inactive</span>
                    @endif
                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection