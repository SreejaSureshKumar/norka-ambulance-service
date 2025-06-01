@extends('admin.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-user-edit"></i> Edit Component Permission</h5>
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
                            <form method="POST" action="{{ route('userpermission.update', encrypt($permission->id)) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label"><strong>User Type</strong></label>
                                    <input type="text" class="form-control" value="{{ $usertype->usertype_name ?? '-' }}"
                                        readonly>
                                </div>

                                @if ($parentComponent)
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Parent Component</strong></label>
                                        <input type="text" class="form-control"
                                            value="{{ $parentComponent->component_name ?? '-' }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="component_id" class="form-label"><strong>Component</strong></label>
                                        <select name="component_id" id="component_id" class="form-control" required>
                                            <option value="">Select Component</option>
                                            @foreach ($childComponents as $id => $name)
                                                <option value="{{ $id }}"
                                                    {{ $mappedComponent && $mappedComponent->component_id == $id ? 'selected' : '' }}>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Component</strong></label>
                                        <input type="text" class="form-control"
                                            value="{{ $mappedComponent->component_name ?? '-' }}" readonly>
                                        <input type="hidden" name="component_id"
                                            value="{{ $mappedComponent->component_id }}">
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label for="permission_status" class="form-label"><strong>Status</strong></label>
                                    <select name="permission_status" id="permission_status" class="form-control" required>
                                        <option value="1" {{ $permission->permission_status == 1 ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="0" {{ $permission->permission_status == 0 ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Permission</button>
                                <a href="{{ route('userpermission.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
