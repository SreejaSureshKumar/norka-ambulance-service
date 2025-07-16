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
                <h5 class="mb-0"><i class="ti ti-user-edit"></i>  User Details</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label"><strong>First Name:</strong></label>
                    <input type="text" class="form-control" value="{{ $user->first_name }}" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Middle Name:</strong></label>
                    <input type="text" class="form-control" value="{{ $user->middle_name }}" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Last Name:</strong></label>
                    <input type="text" class="form-control" value="{{ $user->last_name }}" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Mobile Number:</strong></label>
                    <input type="text" class="form-control" value="{{ $user->user_mobile }}" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Email:</strong></label>
                    <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Usertype:</strong></label>
                    <select class="form-control" disabled>
                        <option value="" disabled>Select Usertype</option>
                        @foreach ($usertypes as $value => $label)
                            <option value="{{ $value }}" {{ isset($user->user_type) && $user->user_type == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection