@extends('admin.app')

@section('content')
<div class="row mb-4">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <h2 class="mb-0"></h2>
        <a class="btn btn-primary btn-sm" href="{{ route('usercomponent.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="ti ti-plus"></i> Create New Component</h5>
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

                <form method="POST" action="{{ route('usercomponent.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label"><strong>Component Name</strong><span class="text-danger">*</span></label>
                        <input type="text" name="component_name" placeholder="Name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Route</strong><span class="text-danger">*</span></label>
                        <input type="text" name="component_path" placeholder="Enter route" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Main component</strong><span class="text-danger">*</span></label>
                        <select name="component_parent" class="form-control" required>
                            <option value="" disabled selected>Select</option>
                            @foreach ($usercomponents as $value => $label)
                                <option value="{{ $value }}">
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Component Icon</strong><span class="text-danger">*</span></label>
                        <input type="text" name="component_icon" placeholder="Icon" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Component Order</strong><span class="text-danger">*</span></label>
                        <input type="text" name="component_order" placeholder="component order" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Status</strong><span class="text-danger">*</span></label>
                        <input type="text" name="component_status" placeholder="status" class="form-control">
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