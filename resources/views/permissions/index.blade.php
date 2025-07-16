@extends('admin.app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <h2 class="mb-0">User Permissions</h2>
                <a class="btn btn-primary" href="{{ route('userpermission.create') }}">
                    <i class="fa fa-plus"></i> Assign New Permissions
                </a>
            </div>
        </div>

        @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
        @endsession

        <table class="table table-striped" id="permissionsTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User Type</th>
                    <th>Assigned Components</th>
                    <th width="150px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $usertypeId => $permissionGroup)
                @php
                    $usertype = $permissionGroup->first()->usertype;
                    $componentCount = $permissionGroup->count();
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $usertype->usertype_name }}</td>
                    <td>
                      {{ $componentCount }}
                      {{Str::of('component')->plural($componentCount)}} assigned
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" 
                           href="{{ route('userpermission.edit', encrypt($permissionGroup->first()->id)) }}">
                            <i class="ti ti-pencil"></i> Manage
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
                "search": "Search Users:",
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