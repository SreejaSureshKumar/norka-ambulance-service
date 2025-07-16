@extends('admin.app')
@section('content')
    <div class="row mb-4">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <h2 class="mb-0"></h2>
            <a class="btn btn-primary" href="{{ route('usercomponent.index') }}"><i class="ti ti-arrow-left"></i> Back</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-user-edit"></i> Component Details</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label"><strong>Name:</strong></label>
                            <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $usercomponent->component_name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Route</strong></label>
                            <input type="text" name="route" placeholder="Route Name" class="form-control" value="{{$usercomponent->component_path}}" disabled>
                        </div>
                        <div class="mb-3">
                    
                            <label class="form-label"><strong>Parent Component</strong></label>
                            <select name="user_type" class="form-control" disabled>
                                <option value="" disabled {{ is_null($usercomponent->component_parent) ? 'selected' : '' }}>Select Usertype</option>
                                @foreach ($usercomponents as $value => $label)
                                <option value="{{ $value }}" {{ isset($usercomponent->component_parent) && $usercomponent->component_parent == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Component Icon</strong></label>
                            <input type="text" name="icon" placeholder="Component Icon" class="form-control" value="{{$usercomponent->component_icon}}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Component Order</strong></label>
                            <input type="text" name="order" placeholder="Component order" class="form-control" value="{{$usercomponent->component_order}}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Status</strong><span class="text-danger">*</span></label>
                            <select name="usertype_status" class="form-control" disabled>
                                <option value="1" {{ $usercomponent->component_status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $usercomponent->component_status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
