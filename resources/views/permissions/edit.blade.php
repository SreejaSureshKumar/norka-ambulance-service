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
                <small class="text-white-50">Toggle permissions and set display order</small>
            </div>
            <div class="card-body">
                @if (empty($tree))
                    <div class="alert alert-info">
                        No permissions currently assigned to this user type.
                    </div>
                @else
                    <form method="POST" action="{{ route('userpermission.update', encrypt($permission->id)) }}" id="permission-form">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <div style="max-height: 400px; overflow-y: auto; border: 1px solid #e9ecef; border-radius: 7px; padding: 15px;">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="fw-bold">Component Permissions</div>
                                    <div class="fw-bold" style="width: 120px;">Display Order</div>
                                </div>
                                
                                @foreach($tree as $item)
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="permissions[{{ $item['id'] }}][selected]" 
                                                   value="1" 
                                                   id="mainmenu_{{ $item['id'] }}"
                                                   {{ $item['assigned'] && $item['status'] ? 'checked' : '' }}>
                                            <input type="hidden" name="permissions[{{ $item['id'] }}][component_id]" value="{{ $item['id'] }}">
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
                                        <div style="width: 120px;">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text">Order</span>
                                                <input type="number" name="permissions[{{ $item['id'] }}][order]" 
                                                       class="form-control" 
                                                       min="1" 
                                                       value="{{ $item['assigned'] ? ($item['permission_order'] ?? 1) : 1 }}"
                                                       title="Lower numbers appear first in menu">
                                            </div>
                                        </div>
                                    </div>

                                    @if(!empty($item['children']))
                                    <div class="ps-4 mt-2">
                                        @foreach($item['children'] as $child)
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="permissions[{{ $child['id'] }}][selected]" 
                                                       value="1" 
                                                       id="child_{{ $child['id'] }}"
                                                       {{ $child['assigned'] && $child['status'] ? 'checked' : '' }}>
                                                <input type="hidden" name="permissions[{{ $child['id'] }}][component_id]" value="{{ $child['id'] }}">
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
                                            <div style="width: 120px;">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Order</span>
                                                    <input type="number" name="permissions[{{ $child['id'] }}][order]" 
                                                           class="form-control" 
                                                           min="1" 
                                                           value="{{ $child['assigned'] ? ($child['permission_order'] ?? 1) : 1 }}"
                                                           title="Lower numbers appear first in menu">
                                                </div>
                                            </div>
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

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    $('#permission-form').on('submit', function(e) {
        // Check if any permissions are selected
        if ($('input[type="checkbox"]:checked').length === 0) {
            if (!confirm(' Are you sure you want to continue?')) {
                e.preventDefault();
                return;
            }
        }

        // Validate order inputs
        var isValid = true;
        $('input[type="checkbox"]:checked').each(function() {
            var componentId = $(this).attr('id').replace('mainmenu_', '').replace('child_', '');
            var orderInput = $(`input[name="permissions[${componentId}][order]"]`);
            
            if (!orderInput.val()) {
                isValid = false;
                orderInput.addClass('is-invalid');
                orderInput.closest('.input-group').after('<div class="invalid-feedback">Display order is required</div>');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Please enter display order numbers for all selected components');
            return;
        }

        // Show confirmation for changes
        if (!confirm('Are you sure you want to update these permissions? Any deselected permissions will be permanently removed.')) {
            e.preventDefault();
        }
    });

    $(document).on('input', 'input[name*="[order]"]', function() {
        if ($(this).val()) {
            $(this).removeClass('is-invalid');
            $(this).closest('.input-group').next('.invalid-feedback').remove();
        }
    });
});
</script>
@endpush
@endsection