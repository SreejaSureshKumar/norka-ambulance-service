@extends('admin.app')


@section('content')
<div class="card">
    <div class="card-body">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users </h2>
        </div>
        <div class="pull-right">
         <a class="btn btn-success mb-2" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> Create New User</a>
     </div>
    </div>
</div>
@session('success')
    <div class="alert alert-success" role="alert"> 
        {{ $value }}
    </div>
@endsession

<table class="table table-striped" id="usersTable">
   <thead>
     <tr>
         <th>No</th>
         <th>Name</th>
         <th>Email</th>
         <th>Usertype</th>
         <th width="280px">Action</th>
     </tr>
   </thead>
   <tbody>
   @foreach ($data as $key => $user)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
         @if(!empty($user->userType))
            <label class="badge bg-success">{{$user->userType->usertype_name}}</label>
         @endif
        </td>
        <td>
             <a class="btn btn-info btn-sm" href="{{ route('users.show',encrypt($user->id)) }}"><i class="ti ti-eye"></i> Show</a>
             <a class="btn btn-primary btn-sm" href="{{ route('users.edit',encrypt($user->id)) }}"><i class="ti ti-pencil"></i> Edit</a>
              <form method="POST" action="{{ route('users.destroy', encrypt($user->id)) }}" style="display:inline">
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
        $('#usersTable').DataTable({
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



