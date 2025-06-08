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
                        <label class="form-label"><strong>Components</strong></label>
                        <div style="max-height: 350px; overflow-y: auto; border: 1px solid #e9ecef; border-radius: 7px; background: #fff; min-width: 350px; padding: 0;">
                            <div id="component-tree" style="padding: 0.5em 0 0.5em 0;"></div>
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
                    // Always allow selecting parent menu
                    var mainMenuChecked = mainMenu.assigned ? 'checked' : '';
                    // No left margin or padding for parent menu
                    var mainMenuBox = `<div class="form-check mb-2" style="background:#e9f3ff;border-radius:7px;padding:0.65em 1em 0.65em 0;">
                        <input class="form-check-input me-2" style="margin-left:0;" type="checkbox" name="permissions[]" value="${mainMenu.id}" id="${mainMenuId}" ${mainMenuChecked}>
                        <label class="form-check-label fw-bold" for="${mainMenuId}" style="font-weight:600;">
                            ${mainMenu.name}
                            ${mainMenu.path ? `<span class="text-muted ms-3" style="font-size:0.97em;font-style:italic;">
                                <i class="bi bi-link-45deg"></i> ${mainMenu.path}
                            </span>` : ''}
                        </label>
                    </div>`;
                    treeDiv.append(mainMenuBox);

                    if (mainMenu.children.length > 0) {
                        $.each(mainMenu.children, function(_, child) {
                            var childId = 'submenu_' + child.id;
                            var childChecked = child.assigned ? 'checked disabled' : '';
                            // Only submenus get left margin
                            var childBox = `<div class="form-check mb-1" style="background:#f8f9fa;border-radius:6px;padding:0.5em 0.75em; margin-left:2rem;">
                                <input class="form-check-input me-2" type="checkbox" name="permissions[]" value="${child.id}" id="${childId}" ${childChecked}>
                                <label class="form-check-label" for="${childId}" style="font-weight:500;">
                                    ${child.name}
                                    ${child.path ? `<span class="text-muted ms-3" style="font-size:0.93em;font-style:italic;">
                                        <i class="bi bi-link-45deg"></i> ${child.path}
                                    </span>` : ''}
                                </label>
                            </div>`;
                            treeDiv.append(childBox);
                        });
                    }
                });
                treeContainer.show();
            }
        });
    });
});
</script>
@endpush