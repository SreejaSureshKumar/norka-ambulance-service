@extends('admin.app')

@section('content')
<div class="card">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('error_status'))

    <div class="alert alert-dismissible fade show my-3" role="alert">
        {{ session('error_status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    @endif
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Ambulance Service / Approved Applications </h3>

        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="applications-table" class="table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Application No</th>
                        <th>Deceased Name</th>
                        <th>Passport No</th>
                        <th>Country</th>
                        <th>Submitted On</th>
                        <th>Processed On</th>
                        <th>Status</th>
                        <th class="no-export">Actions</th>
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
                url: "{{ route('service.processed-list') }}",
                type: "GET",
                dataType: "json",
            },
            order: [[5, 'desc']],
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
                    data: 'processed_date',
                    name: 'processed_date'
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
                targets: 7, // index of the actions column
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