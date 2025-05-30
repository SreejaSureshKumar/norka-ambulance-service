@extends('admin.app')

@section('content')
<div class="row mb-4">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <h2 class="mb-0"></h2>
        <a class="btn btn-primary btn-sm" href="{{ route('userpermission.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="ti ti-user-plus"></i> Assign permission</h5>
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

                <form method="POST" action="{{ route('userpermission.store') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label"><strong>Usertype</strong><span class="text-danger">*</span></label>
                        <select name="user_type" class="form-control" required>
                            <option value="" disabled selected>Select Usertype</option>
                            @foreach ($usertypes as $value => $label)
                                <option value="{{ $value }}">
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Components</strong>
                            <select name="permissions[]" class="form-control" multiple="multiple">
                                @foreach ($usercomponents as $value => $label)
                                    <option value="{{ $value }}">
                                        {{ $label }}
                                    </option>
                                 @endforeach
                            </select>
                        </div>
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