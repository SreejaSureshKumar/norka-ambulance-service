@extends('admin.app')

@section('content')
<div class="card">
    <div class="card-body">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Component Permissions</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success mb-2" href="{{ route('userpermission.create') }}"><i class="fa fa-plus"></i> Create New Permission</a>
        </div>
    </div>
</div>
@session('success')
    <div class="alert alert-success" role="alert">
        {{ $value }}
    </div>
@endsession

<table class="table table-bordered" id="permissionsTable">
    <thead>
        <tr>
            <th>No</th>
            <th>UserType</th>
            <th>Component Name</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($permissions as $key => $permission)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $permission->usertype ? $permission->usertype->usertype_name : '-' }}</td>
            <td>{{ $permission->component ? $permission->component->component_name : '-' }}</td>
            <td>
                @if($permission->permission_status == 1)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </td>
            <td>
                <a class="btn btn-info btn-sm" href="{{ route('userpermission.show', $permission->id) }}"><i class="ti ti-eye"></i> Show</a>
                <a class="btn btn-primary btn-sm" href="{{ route('userpermission.edit', $permission->id) }}"><i class="ti ti-pencil"></i> Edit</a>
                <form method="POST" action="{{ route('userpermission.destroy', $permission->id) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i> Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div>
</div>
@endsection

@push('custom-scripts')
<script>
    $(document).ready(function() {
        $('#permissionsTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [10, 25, 50, 100],
            "language": {
                "search": "Search Permissions:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "paginate": {
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });
    });
</script>
@endpush



