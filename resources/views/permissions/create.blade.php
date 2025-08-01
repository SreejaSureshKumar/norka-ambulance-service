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

                <form method="POST" action="{{ route('userpermission.store') }}" id="permission-form">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label"><strong>Usertype</strong><span class="text-danger">*</span></label>
                        <select name="user_type" id="user_type_select" class="form-control" required>
                            <option value="" disabled selected>Select Usertype</option>
                            @foreach ($usertypes as $value => $label)
                                <option value="{{ $value }}">
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="component-tree-container" class="mb-3" style="display:none;">
                        <label class="form-label"><strong>Components</strong><span class="text-danger">*</span></label>
                        <div style="max-height: 350px; overflow-y: auto; border: 1px solid #e9ecef; border-radius: 7px; background: #fff; min-width: 350px; padding: 0;">
                            <div id="component-tree" style="padding: 0.5em 1em;"></div>
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

@push('custom-scripts')
<script>
$(document).ready(function() {
    $('#user_type_select').on('change', function() {
        var usertypeId = $(this).val();
        var treeContainer = $('#component-tree-container');
        var treeDiv = $('#component-tree');
        if (!usertypeId) {
            treeContainer.hide();
            treeDiv.html('');
            return;
        }
        $.ajax({
            url: "{{ route('userpermission.components-for-usertype') }}",
            type: "GET",
            dataType: "json",
            data: { usertype_id: usertypeId },
            success: function(data) {
                treeDiv.html('');
                $.each(data, function(_, mainMenu) {
                    var mainMenuId = 'mainmenu_' + mainMenu.id;
                    
                    var isAssigned = mainMenu.permission_status !== null;
                    var isEnabled = mainMenu.permission_status == 1;
                    var isActiveComponent = mainMenu.component_status == 1;
                    
                    var permissionBadge = isAssigned 
                        ? (isEnabled 
                            ? '<span class="badge bg-success ms-2">Enabled</span>' 
                            : '<span class="badge bg-danger ms-2">Disabled</span>')
                        : '';
                    
                    var mainMenuBox = `
                    <div class="mb-2 component-row" style="background:#e9f3ff;border-radius:7px;padding:0.75em 1em;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="form-check d-flex align-items-center" style="min-height: 2.5rem;">
                                <input class="form-check-input me-3 component-checkbox" type="checkbox" 
                                       name="permissions[${mainMenu.id}][selected]" value="1" id="${mainMenuId}" 
                                       ${isAssigned ? 'checked disabled' : ''} 
                                       ${!isActiveComponent ? 'disabled' : ''}>
                                <div>
                                    <label class="form-check-label fw-bold" for="${mainMenuId}" style="font-weight:600;">
                                        ${mainMenu.name}
                                        ${mainMenu.path ? `
                                        <span class="text-muted ms-2" style="font-size:0.95em;font-style:italic;">
                                            ${mainMenu.path}
                                        </span>` : ''}
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                ${permissionBadge}
                                <div class="ms-3" style="width: 80px;">
                                    <input type="number" name="permissions[${mainMenu.id}][order]" 
                                           class="form-control form-control-sm component-order" min="1" 
                                           placeholder="Order" ${isAssigned ? 'disabled' : ''}
                                           value="${isAssigned ? (mainMenu.permission_order || 1) : 1}">
                                </div>
                            </div>
                        </div>
                    </div>`;
                    treeDiv.append(mainMenuBox);

                    if (mainMenu.children.length > 0) {
                        $.each(mainMenu.children, function(_, child) {
                            var childId = 'submenu_' + child.id;
                            
                            var isChildAssigned = child.permission_status !== null;
                            var isChildEnabled = child.permission_status == 1;
                            var isChildActive = child.component_status == 1;
                            
                            var childPermissionBadge = isChildAssigned 
                                ? (isChildEnabled 
                                    ? '<span class="badge bg-success ms-2">Enabled</span>' 
                                    : '<span class="badge bg-danger ms-2">Disabled</span>')
                                : '';
                            
                            var childBox = `
                            <div class="mb-1 component-row" style="background:#f8f9fa;border-radius:6px;padding:0.6em 1em; margin-left:1.5rem;">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="form-check d-flex align-items-center" style="min-height: 2rem;">
                                        <input class="form-check-input me-3 component-checkbox" type="checkbox" 
                                               name="permissions[${child.id}][selected]" value="1" id="${childId}" 
                                               ${isChildAssigned ? 'checked disabled' : ''} 
                                               ${!isChildActive ? 'disabled' : ''}>
                                        <div>
                                            <label class="form-check-label" for="${childId}" style="font-weight:500;">
                                                ${child.name}
                                                ${child.path ? `
                                                <span class="text-muted ms-2" style="font-size:0.93em;font-style:italic;">
                                                    ${child.path}
                                                </span>` : ''}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        ${childPermissionBadge}
                                        <div class="ms-3" style="width: 80px;">
                                            <input type="number" name="permissions[${child.id}][order]" 
                                                   class="form-control form-control-sm component-order" min="1" 
                                                   placeholder="Order" ${isChildAssigned ? 'disabled' : ''}
                                                   value="${isChildAssigned ? (child.permission_order || 1) : 1}">
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            treeDiv.append(childBox);
                        });
                    }
                });
                treeContainer.show();
            }
        });
    });

    // Form submission handler
    $('#permission-form').on('submit', function(e) {
        var isValid = true;
        $('.component-checkbox:checked:not(:disabled)').each(function() {
            var componentId = $(this).attr('id').replace('mainmenu_', '').replace('submenu_', '');
            var orderInput = $(`input[name="permissions[${componentId}][order]"]`);
            
            if (!orderInput.val()) {
                isValid = false;
                orderInput.addClass('is-invalid');
                orderInput.after('<div class="invalid-feedback">Order is required</div>');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Please enter order numbers for all selected components');
        }
    });

    $(document).on('input', '.component-order', function() {
        if ($(this).val()) {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').remove();
        }
    });
});
</script>
@endpush