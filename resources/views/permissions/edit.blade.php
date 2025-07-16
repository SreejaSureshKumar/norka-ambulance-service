@extends('admin.app')

@section('content')
  <div class="row mb-4">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <h2 class="mb-0"></h2>
            <a href="{{ route('userpermission.index') }}" class="btn btn-primary">
                               <i class="ti ti-arrow-left"></i> Back
                            </a>
        </div>
    </div>
 
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="ti ti-user-edit"></i> 
                    Manage Permissions for {{ $usertype->usertype_name }}
                </h5>
                <small class="text-white-50">Toggle permissions and save changes</small>
            </div>
            <div class="card-body">
                @if (empty($tree))
                    <div class="alert alert-info">
                        No permissions currently assigned to this user type.
                    </div>
                @else
                    <form method="POST" action="{{ route('userpermission.update', encrypt($permission->id)) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <div style="max-height: 400px; overflow-y: auto; border: 1px solid #e9ecef; border-radius: 7px; padding: 15px;">
                                @foreach($tree as $item)
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               name="permissions[]" 
                                               value="{{ $item['id'] }}" 
                                               id="mainmenu_{{ $item['id'] }}"
                                               {{ $item['assigned'] && $item['status'] ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="mainmenu_{{ $item['id'] }}">
                                            {{ $item['name'] }}
                                            @if($item['path'])
                                            <span class="text-muted ms-2">({{ $item['path'] }})</span>
                                            @endif
                                            <span class="badge ms-2 {{ $item['status'] ? 'bg-success' : 'bg-danger' }}">
                                                {{ $item['status'] ? 'Active' : 'Inactive' }}
                                            </span>
                                        </label>
                                    </div>

                                    @if(!empty($item['children']))
                                    <div class="ps-4 mt-2">
                                        @foreach($item['children'] as $child)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="permissions[]" 
                                                   value="{{ $child['id'] }}" 
                                                   id="child_{{ $child['id'] }}"
                                                   {{ $child['assigned'] && $child['status'] ? 'checked' : '' }}>
                                            <label class="form-check-label" for="child_{{ $child['id'] }}">
                                                {{ $child['name'] }}
                                                @if($child['path'])
                                                <span class="text-muted ms-2">({{ $child['path'] }})</span>
                                                @endif
                                                <span class="badge ms-2 {{ $child['status'] ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $child['status'] ? 'Active' : 'Inactive' }}
                                                </span>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-floppy-disk"></i> Save Changes
                            </button>
                          
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection