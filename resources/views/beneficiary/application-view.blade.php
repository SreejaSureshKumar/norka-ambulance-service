@extends('admin.app')

@section('content')
<style>
    .readonly-label {
        font-weight: 600;
        font-size: 1rem;
        color: #495057;
        margin-bottom: 0.25rem;
    }

    .readonly-value {
        font-size: 1rem;
        color: #212529;
        border: 1px solid #e9ecef;
        padding: 0.5rem 0.75rem;
        border-radius: 4px;
        background-color: #f8f9fa;
    }

    .section-card {
        border: 1px solid #e9ecef;
        border-radius: 6px;
        padding: 1.25rem 1.25rem 1rem 1.25rem;
        margin-bottom: 1.25rem;
        background-color: #fff;
    }

    .section-header {
        font-size: 1.05rem;
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.4rem;
        border-bottom: 1px solid #e9ecef;
        color: #2c3e50;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .outer-card-wrapper {
        margin-top: 1.5rem;
        padding-bottom: 2.5rem;
    }

    .remarks-meta {
        margin-top: 0.75rem;
        font-size: 0.85rem;
        color: #6c757d;
    }

    .card-header {
        background: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        border-radius: 6px 6px 0 0;
        padding: 1rem 1.5rem;
    }

    .card-title,
    .card-header h5 {
        font-size: 1.15rem;
        font-weight: 600;
        color: #2c3e50;
        letter-spacing: 0.03em;
    }

    .breadcrumb {
        background: transparent;
        font-size: 1rem;
    }

    .breadcrumb-item a {
        color: #007bff;
        text-decoration: none;
    }

    .breadcrumb-item.active {
        color: #495057;
        font-weight: 600;
    }

    @media (max-width: 767px) {
        .section-card {
            padding: 1rem 0.5rem 0.75rem 0.5rem;
        }

        .card-header {
            padding: 0.75rem 1rem;
        }
    }
</style>

<!-- Breadcrumbs -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-header-title"></div>
            </div>
            <div class="col-auto">
                <ul class="breadcrumb">
                    @if (!empty($previousMenuLabel) && !empty($previousMenuUrl))
                    <li class="breadcrumb-item">
                        <a href="{{ $previousMenuUrl }}">{{ $previousMenuLabel }}</a>
                    </li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">
                        Application Details
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            @if (session('error_status'))
            <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
                {{ session('error_status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
    </div>
    <div class="outer-card-wrapper">
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    Application No: <span><strong>{{ $application->application_no ?? 'N/A' }}</strong></span>
                </h5>
            </div>
            <div class="card-body">
                <div class="row gx-3 gy-3">
                    <div class="col-md-6">
                        <div class="section-card">
                            <div class="section-header">Details of the Deceased</div>
                            <div class="mb-3">
                                <label class="readonly-label">Name of the Deceased</label>
                                <div class="readonly-value">{{ $application->deceased_person_name }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="readonly-label">Passport Number</label>
                                <div class="readonly-value">{{ $application->passport_no }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="readonly-label">Country</label>
                                <div class="readonly-value">{{ $application->countryRelation->country_name ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="section-card">
                            <div class="section-header">Contact Information</div>
                            <div class="mb-3">
                                <label class="readonly-label">Emergency Contact Name (Abroad )</label>
                                <div class="readonly-value">{{ $application->contact_abroad_name }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="readonly-label">Contact Number (Abroad)</label>
                                <div class="readonly-value">+{{ $application->mobile_country_code}} {{ $application->contact_abroad_phone }}</div>
                            </div>
                            @if(!empty($application->alt_contact_abroad_name))
                            <div class="mb-3">
                                <label class="readonly-label">Alternative Contact Name (Abroad)</label>
                                <div class="readonly-value">{{ $application->alt_contact_abroad_name }}</div>
                            </div>
                            @endif
                            @if(!empty($application->alt_contact_abroad_phone))
                            <div class="mb-3">
                                <label class="readonly-label">Alternative Contact Number (Abroad)</label>
                                <div class="readonly-value">+{{$application->alt_mobile_country_code}} {{ $application->alt_contact_abroad_phone }}</div>
                            </div>
                            @endif
                            <div class="mb-3">
                                <label class="readonly-label">Contact Name (Local)</label>
                                <div class="readonly-value">{{ $application->contact_local_name }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="readonly-label">Contact Number (Local)</label>
                                <div class="readonly-value">{{ $application->contact_local_phone }}</div>
                            </div>
                            @if(!empty($application->alt_contact_local_name))
                            <div class="mb-3">
                                <label class="readonly-label">Alternative Contact Name (Local)</label>
                                <div class="readonly-value">{{ $application->alt_contact_local_name }}</div>
                            </div>
                            @endif
                            @if(!empty($application->alt_contact_local_phone))
                            <div class="mb-3">
                                <label class="readonly-label">Alternative Contact Number (Local)</label>
                                <div class="readonly-value">{{ $application->alt_contact_local_phone }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="section-card">
                            <div class="section-header">Flight Details</div>
                            <div class="mb-3">
                                <label class="readonly-label">Flight Number</label>
                                <div class="readonly-value">{{ $application->flight_no }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="readonly-label">Departing Date & Time</label>
                                <div class="readonly-value">
                                    @if($application->departure_date_time)
                                    {{ \Carbon\Carbon::parse($application->departure_date_time)->format('d-m-Y ,h:i A') }}
                                    @else
                                    N/A
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="readonly-label">Arriving Date & Time</label>
                                <div class="readonly-value">
                                    @if($application->arriving_date_time)
                                    {{ \Carbon\Carbon::parse($application->arriving_date_time)->format('d-m-Y ,h:i A') }}
                                    @else
                                    N/A
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="section-card">
                            <div class="section-header">Destination Information</div>
                            <div class="mb-3">
                                <label class="readonly-label">State</label>
                                <div class="readonly-value">{{ $application->stateRelation->state_name ?? '-' }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="readonly-label">District</label>
                                <div class="readonly-value">{{ $application->districtRelation->district_name ?? '-' }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="readonly-label">Communication Address</label>
                                <div class="readonly-value">{{ $application->native_address }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="readonly-label">Attachment</label>
                                <div>
                                    @if($application->application_attachment)
                                    <a href="{{ Storage::url($application->application_attachment) }}" target="_blank" class="document-modal-control popup" data-download="">View Attachment <i class="ti ti-paperclip"></i></a>
                                    @else
                                    Not Uploaded
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                @if ($edit_enable)
                <div class="section-card">

                    <form method="POST" action="{{ route('application.application-process',encrypt($application->id) )}}">
                        @csrf
                        <input type="hidden" name="hid_action" value="{{ $edit_enable }}">
                        @if ($edit_enable==1)
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="application_type" class="readonly-label">Assign Agency</label>
                                <select name="agency_id" id="agency_id" class="form-control">
                                    <option value="" disabled selected>Select</option>
                                    @foreach($agencies as $agency)
                                    <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                    @endforeach
                                </select>
                                @error('agency_id')
                                <span class="text-danger invalid-message" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        @endif
                        <div class="col-md-6">
                            <div class="mb-3">

                                <label class="readonly-label">Remarks <span class="text-danger">*</span></label>

                                <textarea id="remarks" name="remarks" class="form-control" rows="4" placeholder="Enter remarks here..." required>{{ old('remarks', $remarks ?? '') }}</textarea>
                                @error('remarks')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="d-flex justify-content-end">
                                <button type="submit" name="action" id="verify_btn" value="approve" class="btn btn-success me-2 confirm-action" data-action="{{$edit_enable}}" data-message="Are you sure you want to {{ $edit_enable == 1 ? 'verify' : 'approve' }} this application ?">
                                    {{ $edit_enable == 1 ? 'Verify' : 'Approve' }}
                                </button>
                                <button type="submit" name="action" id="reject_btn" value="reject" class="btn btn-danger confirm-action" data-message="Are you sure you want to reject this application?">
                                    Reject
                                </button>
                            </div>

                        </div>



                    </form>

                </div>
                @endif


            </div>
        </div>
@php
    $user = Auth::user();
    $isAgencyItself = $application->agency_id == $user->id;
    $isApplicant=$application->created_by== $user->id;
    $isOfficialOrNodal = in_array($user->user_type, [$official, $nodal_officer]);
@endphp
       @if(!empty($application->agencyUser) && ($isAgencyItself || $isOfficialOrNodal ||$isApplicant))
        <div class="row">
            <div class="col-md-12">
                <div class="section-card bg-white border-start border-4 shadow-sm">
                    <div class="section-header">
                        @if(!empty($application->driverDetails) )
                        @if( $official == Auth::user()->user_type || $nodal_officer == Auth::user()->user_type)
                        Agency & Driver Details
                        @else
                        Driver Details
                        @endif
                        @else
                        Agency Details
                        @endif
                    </div>
                    <div class="row">
                        @if( $official == Auth::user()->user_type || $nodal_officer == Auth::user()->user_type)
                        <div class="@if(!empty($application->driverDetails)) col-md-6 @else col-md-12 @endif">
                            <dl class="row mb-0">
                                <dt class="col-sm-5 readonly-label">Agency Name</dt>
                                <dd class="col-sm-7 readonly-value">{{ $application->agencyUser->name ?? '-' }}</dd>
                                <dt class="col-sm-5 readonly-label">Agency Contact</dt>
                                <dd class="col-sm-7 readonly-value">{{ $application->agencyUser->user_mobile ?? '-' }}</dd>
                                <dt class="col-sm-5 readonly-label">Agency Email</dt>
                                <dd class="col-sm-7 readonly-value">{{ $application->agencyUser->email ?? '-' }}</dd>
                            </dl>
                        </div>
                        @endif
                        @if(!empty($application->driverDetails))
                        <div class="@if(($isApplicant || $isAgencyItself)) col-md-12 @else col-md-6 @endif">
                            <dl class="row mb-0">
                                <dt class="col-sm-5 readonly-label">Driver Name</dt>
                                <dd class="col-sm-7 readonly-value">{{ $application->driverDetails->driver_name }}</dd>
                                <dt class="col-sm-5 readonly-label">Mobile</dt>
                                <dd class="col-sm-7 readonly-value">{{ $application->driverDetails->mobile }}</dd>
                                <dt class="col-sm-5 readonly-label">Address</dt>
                                <dd class="col-sm-7 readonly-value">{{ $application->driverDetails->address }}</dd>
                            </dl>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(!empty($application->serviceDetails) && ( $application->agency_id == Auth::user()->id|| $nodal_officer == Auth::user()->user_type))
        <div class="row">
            <div class="col-md-12">
                <div class="section-card bg-white border-start border-4 shadow-sm">
                    <div class="section-header">
                        Service Details
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dl class="row mb-0">
                                <dt class="col-sm-5 readonly-label">Starting Point</dt>
                                <dd class="col-sm-7 readonly-value">{{ $application->serviceDetails->source_location ?? '-' }}</dd>
                                <dt class="col-sm-5 readonly-label">Destination Point</dt>
                                <dd class="col-sm-7 readonly-value">{{ $application->serviceDetails->destination_location ?? '-' }}</dd>
                                <dt class="col-sm-5 readonly-label">Distance Travelled (in kms)</dt>
                                <dd class="col-sm-7 readonly-value">{{ $application->serviceDetails->total_distance ?? '-' }}</dd>
                                <dt class="col-sm-5 readonly-label">Total Amount</dt>
                                <dd class="col-sm-7 readonly-value">{{ $application->serviceDetails->amount ?? '-' }}</dd>
                                <dt class="col-sm-5 readonly-label">
                                
                                    @if($application->serviceDetails->attachment_path)
                                    <a href="{{ Storage::url($application->serviceDetails->attachment_path) }}" target="_blank" class="document-modal-control popup" data-download="">View Attachment <i class="ti ti-paperclip"></i></a>
                                    @else
                                    Not Uploaded
                                    @endif
                               </dt>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(  $isOfficialOrNodal && !empty($application->remarks))
        <div class="row">
            <div class="col-md-12">
              
                <div class="section-card bg-white border-start border-4  shadow-sm">
                    <div class="section-header ">Remarks</div>
                    <div class="p-3 rounded bg-light text-dark">
                        <p class="mb-2" style="white-space: pre-line;">{{ $application->remarks }}</p>
                        <div class="remarks-meta text-muted small mt-2 border-top pt-2">
                            <i class="ti ti-clock"></i>
                            verified  on {{ \Carbon\Carbon::parse($application->processed_date)->format('d-m-Y') }}
                            at {{ \Carbon\Carbon::parse($application->processed_date)->format('H:i:s') }}
                            @if (isset($application->processedUser))
                            by <strong>{{ $application->processedUser->name ?? 'N/A' }}</strong>
                            @endif
                        </div>
                    </div>
                    @if(!empty($application->approval_remarks))
                     <div class="p-3 rounded bg-light text-dark">
                        <p class="mb-2" style="white-space: pre-line;">{{ $application->approval_remarks }}</p>
                        <div class="remarks-meta text-muted small mt-2 border-top pt-2">
                            <i class="ti ti-clock"></i>
                            approved on {{ \Carbon\Carbon::parse($application->approved_date)->format('d-m-Y') }}
                            at {{ \Carbon\Carbon::parse($application->processed_date)->format('H:i:s') }}
                            @if (isset($application->approvedUser))
                            by <strong>{{ $application->approvedUser->name ?? 'N/A' }}</strong>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection

@push('custom-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.confirm-action').forEach(function(button) {
            button.addEventListener('click', function(e) {
                const agencySelect = document.getElementById('agency_id');
                const remarks = document.getElementById('remarks');
                const action = this.dataset.action;
                // Only validate for Verify button
                if (this.id === 'verify_btn' && action == 1) {
                    if (!agencySelect.value) {
                        e.preventDefault();
                        alert('Please select an agency before verifying the application.');
                        agencySelect.focus();
                        return;
                    }
                }

                // Confirm dialog if data-message exists
                const message = this.dataset.message;
                if (message && !confirm(message)) {
                    e.preventDefault();
                }
            });
        });

        const form = document.getElementById('application-action-form');
        form.addEventListener('submit', function(event) {
            const remarksField = document.getElementById('remarks');
            if (remarksField.value.trim() === '') {
                event.preventDefault();
                alert('Remarks field is required.');
                remarksField.focus();

            }
        });
    });
</script>
@endpush