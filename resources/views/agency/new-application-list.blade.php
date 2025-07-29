@extends('admin.app')
<style>
    .section-header {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #dee2e6;
        color: #2c3e50;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>
@section('content')
<div class="card">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('error_status'))
    <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
        {{ session('error_status') }}
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
                        
                        <th>Submitted On</th>
                        <th>Service Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- Modal -->
<div class="modal fade" id="updateDetailsModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('agency.add-details') }}" id="details-form">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Add Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="hid_application_id" id="hid_application_id">

                    <label class="form-label fw-bold">Application No : <span id="app_number" class="text-primary"></span></label>
                    <div class="mb-3">
                        <label for="driver_name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="driver_name" name="driver_name" required>
                        @error('driver_name')
                        <span class="text-danger  " role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="col-form-label">Mobile Number:</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" required>
                        @error('mobile')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="col-form-label">Address:</label>
                        <textarea class="form-control" id="address"  name="address" required></textarea>
                        @error('address')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="submit-btn" type="submit">Submit</button>
                </div>
            </div>
        </form>
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
                url: "{{ route('agency.index') }}",
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
                    data: 'created_at',
                    name: 'created_at'
                },
                 {
                    data: 'service_date',
                    name: 'service_date'
                },
                   {
                    data: 'status',
                    name: 'status'
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

    $(document).on('click', '.add-details-modal', function(e) {
        e.preventDefault();
        const appId = $(this).data('id');
        const appNo = $(this).data('number');
        $('#app_number').text(appNo);

        $('#hid_application_id').val(appId);

        $('#updateDetailsModal').modal('show');

    });

 
    $(document).on('click', '.confirm-complete', function(e) {
        e.preventDefault();
        const appId = $(this).data('id');
      
     alert('Are you sure you want to mark this application as completed?');
        $.ajax({
            url: "{{ route('agency.mark-completed') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                application_id: appId
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                   
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while processing your request.');
            }
        });

    });
      // Confirmation before submit
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('details-form');
        var submitBtn = document.getElementById('submit-btn');
        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                if (!confirm('Do you want to proceed?')) {
                    e.preventDefault();
                }
            });
        }
    });
</script>
@endpush