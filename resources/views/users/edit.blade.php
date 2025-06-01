@extends('admin.app')

@section('content')
<div class="row mb-4">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <h2 class="mb-0"></h2>
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

                <form method="POST" action="{{ route('users.update', encrypt($user->id)) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label"><strong>Name </strong></label>
                        <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Email </strong></label>
                        <input type="email" name="email" placeholder="Email" class="form-control" value="{{ $user->email }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Password </strong></label>
                        <input type="password" name="password" placeholder="Password" class="form-control">
                        <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Confirm Password </strong></label>
                        <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control">
                    </div>
                    <div class="mb-3">
                    
                        <label class="form-label"><strong>Usertype</strong></label>
                        <select name="user_type" class="form-control" required>
                            <option value="" disabled {{ is_null($user->user_type) ? 'selected' : '' }}>Select Usertype</option>
                            @foreach ($usertypes as $value => $label)
                            <option value="{{ $value }}" {{ isset($user->user_type) && $user->user_type == $value ? 'selected' : '' }}>
                                {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
       
    </div>
</div>
@endsection