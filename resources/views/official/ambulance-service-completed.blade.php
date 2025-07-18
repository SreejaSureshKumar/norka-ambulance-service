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
        <form method="POST" action="{{ route('agency.add-service-details') }}" id="add-details-form" enctype="multipart/form-data">
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
                        <label for="source_location" class="col-form-label">Starting Point<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="source_location" name="source_location" required>
                        @error('source_location')
                        <span class="text-danger  " role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="destination_location" class="col-form-label">Destination Point<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="destination_location" name="destination_location" required>
                       
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="col-form-label">Total Amount<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="amount" name="amount" required>
                       
                    </div>
                    <div class="mb-3">
                        <label for="total_distance" class="col-form-label">Distance travelled (in kms)<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="total_distance" name="total_distance" required>
                       
                    </div>

                    <div class="mb-3">
                        <label for="attachment_path" class="col-form-label">Upload Attachment <span
                                class="text-danger">*</span></label>
                        <div class="form-file mb-3">
                            <input type="file" class="form-control" aria-label="file example" name="attachment_path" required>
                          
                        </div>
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
                url: "{{ route('service-application.service-completed') }}",
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

    $(document).on('click', '.service-details-modal', function(e) {
        e.preventDefault();
        const appId = $(this).data('id');
        const appNo = $(this).data('number');
        $('#app_number').text(appNo);

        $('#hid_application_id').val(appId);

        $('#updateDetailsModal').modal('show');

    });


   $('#add-details-form').on('submit', function (e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);

    // Clear previous errors
    $(form).find('span.text-danger').text('');

    $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#updateDetailsModal').modal('hide');
            alert('Details submitted successfully');
            location.reload();
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                if (errors) {
                    Object.keys(errors).forEach(function (key) {
                        // Find the input by name and append error below it
                        let field = $(form).find('[name="' + key + '"]');
                        let errorElement = field.next('span.text-danger');

                        // If error span not found, create it
                        if (!errorElement.length) {
                            field.after('<span class="text-danger" role="alert"><strong>' + errors[key][0] + '</strong></span>');
                        } else {
                            errorElement.html('<strong>' + errors[key][0] + '</strong>');
                        }
                    });
                }
            } else {
                alert('An unexpected error occurred.');
            }
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