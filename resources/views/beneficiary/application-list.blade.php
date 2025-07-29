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
            <h3 class="card-title mb-0">Applications List</h3>

        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="applications-table" class="table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Service</th>
                        <th>Application No</th>
                        <th>Deceased Name</th>
                        <th>Passport No</th>

                        <th>Country</th>
                        <th>Status</th>
                        <th>Submiited On</th>
                        <th class="no-export">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data loaded via AJAX -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
<script>
    $(document).ready(function() {
        var table = $('#applications-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('beneficiary.index') }}",
                type: "GET",
                dataType: "json",
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'service_type',
                    name: 'service_type'
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
                    data: 'status',
                    name: 'status'
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
                targets: 8, // index of the actions column
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return type === 'display' ? data : '';
                }
            }],
            "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                var row = $(nRow);
                row.attr("id", 'row' + aData['id']);
                $("td:first", nRow).html(iDisplayIndex + 1);
                return nRow;
            }
        });

        $(document).on('click', '.confirm-cancel', function(e) {
            e.preventDefault();
            const appId = $(this).data('id');

            alert('Are you sure you want to cancel this application ?');
            $.ajax({
                url: "{{ route('beneficiary.cancel-service') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    application_id: appId
                },
                success: function(response) {
                    if (response.status === 'true') {
                        alert(response.message);
                        location.reload();
                      
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred while processing your request.');
                }
            });

        });
    });
</script>
@endpush