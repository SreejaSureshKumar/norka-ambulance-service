@extends('admin.app')

@section('content')
<div class="row mb-4">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <h2 class="mb-0">Edit User</h2>
        <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="ti ti-user-edit"></i> Edit User Details</h5>
            </div>
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('usertypes.update', encrypt($usertype->id)) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label"><strong>Name</strong><span class="text-danger">*</span></label>
                        <input type="text" name="usertype_name" placeholder="Name" class="form-control" value="{{ $usertype->usertype_name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Status</strong><span class="text-danger">*</span></label>
                        <select name="usertype_status" class="form-control">
                            <option value="1" {{ $usertype->usertype_status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $usertype->usertype_status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
       
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <p class="text-center text-primary mt-3"><small>Tutorial by ItSolutionStuff.com</small></p>
    </div>
</div>
@endsection