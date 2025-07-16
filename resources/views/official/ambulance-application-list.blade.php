@extends('admin.app')
@section('content')
<div class="card">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Ambulance Service / New Applications </h3>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="applications-table" class="table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Application No</th>
                        <th>Deceased's Name</th>
                        <th>Passport No</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>Submitted On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    
</div>

@endsection

@push('custom-scripts')
<script data-cfasync="false">
    $(document).ready(function() {
       
        var table = $('#applications-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('service.application-list') }}",
                type: "GET",
                dataType: "json",
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'application_no',
                    name: 'application_no'
                },
                {
                    data: 'deceased_person_name',
                    name: 'deceased_person_name'
                },
                {
                    data: 'passport_no',
                    name: 'passport_no'
                },
                {
                    data: 'country',
                    name: 'country'
                },
                {
                    data: 'state',
                    name: 'state'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            columnDefs: [{
                targets: 6,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return type === 'display' ? data : '';
                }
            }],
            fnRowCallback: function(nRow, aData, iDisplayIndex) {
                var row = $(nRow);
                row.attr("id", 'row' + aData['id']);
                $("td:first", nRow).html(iDisplayIndex + 1);
                return nRow;
            }
        });

       
    });

</script>
@endpush