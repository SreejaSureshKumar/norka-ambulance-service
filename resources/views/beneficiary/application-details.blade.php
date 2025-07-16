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

    /* Restore previous remarks section style */
    .remarks-meta {
        margin-top: 0.75rem;
        font-size: 0.85rem;
        color: #6c757d;
    }
    .remarks-section-card {
        /* Remove custom style, use previous style via Bootstrap utility classes in markup */
        border: none;
        background: none;
        padding: 0;
        margin-bottom: 0;
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
                            <label class="readonly-label">Country of Death</label>
                            <div class="readonly-value">{{ $application->countryRelation->country_name ?? '-' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="readonly-label">Date of Death</label>
                            <div class="readonly-value">{{ \Carbon\Carbon::parse($application->death_date)->format('d F Y') }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="readonly-label">Cause of Death</label>
                            <div class="readonly-value">{{ $application->cause_of_death }}</div>
                        </div>
                    </div>
                    <div class="section-card">
                        <div class="section-header">Repatriation Details</div>
                        <div class="mb-3">
                            <label class="readonly-label">Departure Airport </label>
                            <div class="readonly-value">{{$application->airport_from}}</div>
                        </div>
                        <div class="mb-3">
                            <label class="readonly-label">Arrival Airport</label>
                            <div class="readonly-value">{{ $application->airport_to }}</div>
                        </div>
                    </div>
                    <div class="section-card">
                        <div class="mb-3">
                            <label class="readonly-label">Is Cargo Services Required?</label>
                            <div class="readonly-value">
                                {{ $application->cargo_norka_status ? 'Yes' : 'No' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="section-card">
                        <div class="section-header">Contact Information</div>
                        <div class="mb-3">
                            <label class="readonly-label">Emergency Contact Name (Abroad )</label>
                            <div class="readonly-value">{{ $application->contact_abroad_name }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="readonly-label">Contact Number (Abroad)</label>
                            <div class="readonly-value">{{ $application->contact_abroad_phone }}</div>
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
                            <div class="readonly-value">{{ $application->alt_contact_abroad_phone }}</div>
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
                        <div class="mb-3">
                            <label class="readonly-label">Communication Address</label>
                            <div class="readonly-value">{{ $application->native_address }}</div>
                        </div>
                    </div>
                    <div class="section-card">
                        <div class="section-header">Sponsor Information</div>
                        <div class="mb-3">
                            <label class="readonly-label">Sponsor/Company/Organisation</label>
                            <div class="readonly-value">{{ $application->sponsor_details }}</div>
                        </div>
                    </div>
                    <div class="section-card">
                        <div class="mb-3">
                            <label class="readonly-label">Is Ambulance Service Required?</label>
                            <div class="readonly-value">
                                {{ $application->ambulance_required ? 'Yes' : 'No' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($edit_enable)
            <x-application-action :application="$application" :action="'application.process'" />
            @endif
        </div>
    </div>

   
        @if(isset($official) && $official == Auth::user()->user_type && !empty($application->remarks))
        <div class="row">
            <div class="col-md-12">
                <!-- Restore previous remarks section markup and style -->
                <div class="section-card bg-white border-start border-4 shadow-sm">
                    <div class="section-header">Remarks</div>
                    <div class="p-3 rounded bg-light text-dark">
                        <p class="mb-2" style="white-space: pre-line;">{{ $application->remarks }}</p>
                        <div class="remarks-meta text-muted small mt-2 border-top pt-2">
                            <i class="ti ti-clock"></i>
                            Added on {{ \Carbon\Carbon::parse($application->processed_date)->format('d-m-Y') }}
                            at {{ \Carbon\Carbon::parse($application->processed_date)->format('H:i:s') }}
                            @if (isset($application->processedUser))
                            by <strong>{{ $application->processedUser->name ?? 'N/A' }}</strong>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    
        @endif
    </div>
</div>
@endsection