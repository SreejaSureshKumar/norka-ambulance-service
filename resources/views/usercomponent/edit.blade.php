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
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
    
                        <form method="POST" action="{{ route('usercomponent.update', encrypt($usercomponent->component_id)) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label"><strong>Name:</strong></label>
                                <input type="text" name="component_name" placeholder="Name" class="form-control" value="{{ $usercomponent->component_name }}" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><strong>Route</strong></label>
                                <input type="text" name="component_path" placeholder="Route Name" class="form-control" value="{{$usercomponent->component_path}}" >
                            </div>
                            
                            @php
                                $hasChildren = \App\Models\UserComponent::where('component_parent', $usercomponent->component_id)->exists();
                            @endphp
                            
                            @if($hasChildren)
                                {{-- This menu has submenus - show them and disable parent selection --}}
                                <div class="mb-3">
                                    <label class="form-label"><strong>Submenus</strong></label>
                                    @php
                                        $children = \App\Models\UserComponent::where('component_parent', $usercomponent->component_id)->get();
                                    @endphp
                                    
                                    <div style="max-height: 200px; overflow-y: auto;" class="border p-2">
                                        <ul class="list-group">
                                            @foreach($children as $child)
                                                <li class="list-group-item">{{ $child->component_name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                   
                                    <input type="hidden" name="component_parent" value="0">
                                </div>
                            @else
                               
                                <div class="mb-3">
                                    <label class="form-label"><strong>Parent Component</strong></label>
                                    <select name="component_parent" class="form-control">
                                        <option value="0" {{ $usercomponent->component_parent == 0 ? 'selected' : '' }}>Main Menu </option>
                                        @foreach ($usercomponents as $value => $label)
                                            @if($value != $usercomponent->component_id) {{-- Prevent selecting self as parent --}}
                                                <option value="{{ $value }}" {{ $usercomponent->component_parent == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Select "Main Menu" to make this a Main menu</small>
                                </div>
                            @endif
                            
                            <div class="mb-3">
                                <label class="form-label"><strong>Component Icon</strong></label>
                                <input type="text" name="component_icon" placeholder="Component Icon" class="form-control" value="{{$usercomponent->component_icon}}" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><strong>Component Order</strong></label>
                                <input type="text" name="component_order" placeholder="Component order" class="form-control" value="{{$usercomponent->component_order}}" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><strong>Status</strong><span class="text-danger">*</span></label>
                                <select name="component_status" class="form-control">
                                    <option value="1" {{ $usercomponent->component_status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $usercomponent->component_status == 0 ? 'selected' : '' }}>Inactive</option>
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
    </div>
@endsection