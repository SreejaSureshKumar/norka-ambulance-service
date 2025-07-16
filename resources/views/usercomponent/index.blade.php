@extends('admin.app')

@section('content')
<div class="card mb-5">
    <div class="card-body pb-3">
        <div class="row mb-4">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">

                <h2 class="mb-0">Components</h2>


                <a class="btn btn-primary" href="{{ route('usercomponent.create') }}"><i class="fa fa-plus"></i> Create New Component</a>

            </div>
        </div>
        @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
        @endsession
        <table class="table table-striped" id="componentTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Component Name</th>
                    <th>Component Path</th>
                    <th>Component Parent</th>
                    <th>Icon</th>
                    <th>Status</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $component)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $component->component_name }}</td>
                    <td>{{ $component->component_path }}</td>
                    <td>
                        @if($component->component_parent)
                        {{ $component->parentComponent->component_name }}
                        @else
                        <span class="">--</span>
                        @endif
                    </td>
                    <td>
                        @if($component->component_icon)
                        {{ $component->component_icon }}
                        @else
                        <span class="text">--</span>
                        @endif
                    </td>
                    <td>
                        @if($component->component_status == 1)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('usercomponent.show',encrypt($component->component_id)) }}"><i class="ti ti-eye"></i> Show</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('usercomponent.edit',encrypt($component->component_id)) }}"><i class="ti ti-pencil"></i> Edit</a>
                        <form method="POST" action="{{ route('usercomponent.destroy', encrypt($component->component_id)) }}" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i> Delete</button>
                        </form>
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
        $('#componentTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [10, 25, 50, 100],
            "language": {
                "search": "Search Components:",
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