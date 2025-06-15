@extends('admin.app')

@section('content')
<div class="card">
    <div class="card-body">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>UserType</h2>
        </div>
        <div class="pull-right">
         <a class="btn btn-success mb-2" href="{{ route('usertypes.create') }}"><i class="fa fa-plus"></i> Create New Usertype</a>
     </div>
    </div>
</div>
@session('success')
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ $value }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endsession

<table class="table table-striped" id="userstypeTable">
   <thead>
     <tr>
         <th>No</th>
         <th>Name</th>
         <th>Status</th>
         <th width="280px">Action</th>
     </tr>
   </thead>
   <tbody>
   @foreach ($data as $key => $usertype)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $usertype->usertype_name }}</td>
        <td>
            @if($usertype->usertype_status == 1)
                <span class="badge bg-success">Active</span>
            @else
                <span class="badge bg-danger">Inactive</span>
            @endif
        </td>
        <td>
             <a class="btn btn-info btn-sm" href="{{ route('usertypes.show',encrypt($usertype->id)) }}"><i class="ti ti-eye"></i> Show</a>
             <a class="btn btn-primary btn-sm" href="{{ route('usertypes.edit',encrypt($usertype->id)) }}"><i class="ti ti-pencil"></i> Edit</a>
              <form method="POST" action="{{ route('usertypes.destroy', encrypt($usertype->id))}}" style="display:inline">
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
        $('#userstypeTable').DataTable({
            "paging": true, // Enable pagination
            "searching": true, // Enable search
            "ordering": true, // Enable column sorting
            "info": true, // Show table information
            "lengthMenu": [10, 25, 50, 100], // Dropdown for number of rows per page
            "language": {
                "search": "Search Users:", // Customize search input placeholder
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



