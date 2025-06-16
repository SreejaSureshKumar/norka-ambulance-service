@extends('admin.app')

@section('content')
    <style>
        .section-block {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1.5rem 1.25rem;
            margin-bottom: 2rem;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .section-heading {
            background: linear-gradient(90deg, #0d6efd 0%, #0dcaf0 100%);
            color: #fff !important;
            font-size: 1.3rem;
            font-weight: 700;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            margin-bottom: 1.25rem;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(13, 110, 253, 0.08);
        }

        .form-label {
            font-size: 1rem;
            color: #6c757d;
            font-weight: 500;
        }

        .form-control-plaintext {
            min-height: 44px;
            font-size: 1.08rem;
            color: #212529;
            background: #f8f9fa;
            border-radius: 5px;
        }
    </style>
    <!-- Manual Breadcrumbs -->
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
    <br>
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header ">
                    <h5 class="m-0">APPLICATION DETAILS</h5>
                    <p class="mb-0 mt-3"> <!-- mt-1 adds small top margin -->
                        <span class="badge bg-light-primary fs-5 fw-semibold py-2 px-3">
                            {{ $application->application_no ?? 'N/A' }}
                        </span>
                    </p>
                </div>
                <div class="card-body">
                    <!-- Deceased Information Section -->
                    <div class="section-block mb-4">
                        <div class="section-heading">
                            Deceased Information
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name</label>
                                <div class="form-control-plaintext">
                                    {{ $application->deceased_person_name }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Passport Number</label>
                                <div class="form-control-plaintext">
                                    {{ $application->passport_no }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Country of Death</label>
                                <div class="form-control-plaintext">
                                    {{ $application->countryRelation->country_name ?? '' }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date of Death</label>
                                <div class="form-control-plaintext">
                                    {{ \Carbon\Carbon::parse($application->death_date)->format('d F Y') }}
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cause of Death</label>
                            <div class="form-control-plaintext">
                                {{ $application->cause_of_death }}
                            </div>
                        </div>
                    </div>
                    <!-- Flight Details Section -->
                    <div class="section-block mb-4">
                        <div class="section-heading">
                            Repatriation Details
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Departing Airport</label>
                                <div class="form-control-plaintext">
                                    {{ $application->airport_from }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Arriving Airport</label>
                                <div class="form-control-plaintext">
                                    {{ $application->airport_to }}
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cargo Services Required</label>
                            <div class="form-control-plaintext">
                                @if ($application->cargo_norka_status)
                                    <span class="badge bg-success rounded-pill px-3 py-1">
                                        Yes
                                    </span>
                                @else
                                    <span class="badge bg-danger rounded-pill px-3 py-1">
                                        No
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div class="section-block mb-4">
                        <div class="section-heading">
                            Contact Information
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Overseas Emergency Contact</label>
                                <div class="form-control-plaintext">
                                    <div><strong>Name:</strong> {{ $application->contact_abroad_name }}</div>
                                    <div><strong>Phone:</strong> {{ $application->contact_abroad_phone }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Local Contact (Kerala)</label>
                                <div class="form-control-plaintext">
                                    <div><strong>Name:</strong> {{ $application->contact_kerala_name }}</div>
                                    <div><strong>Phone:</strong> {{ $application->contact_kerala_phone }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Communication Address (Kerala)</label>
                            <div class="form-control-plaintext">
                                {{ $application->native_address }}
                            </div>
                        </div>
                    </div>

                    <!-- Sponsor Information Section -->
                    <div class="section-block">
                        <div class="section-heading">
                            Sponsor Information
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sponsor Details</label>
                            <div class="form-control-plaintext">
                                {{ $application->sponsor_details }}
                            </div>
                        </div>
                    </div>
                    @if(isset($official) && $official == Auth::user()->user_type)

                        @if (!empty($application->remarks))
                            <div class="section-block">
                                <div class="section-heading">
                                    Remarks
                                </div>
                                <div class="bq-note-item"
                                    style="background: #f8f9fa; border-radius: 8px; padding: 1rem 1.25rem; box-shadow: 0 1px 4px rgba(0,0,0,0.04);">

                                    <div class="bq-note-text rich-formatted-text-container"
                                        style="font-size: 1.08rem; color: #212529;">
                                        {{ $application->remarks }}
                                    </div>
                                    <div class="bq-note-meta mb-2" style="font-size: 0.97rem; color: #6c757d;">


                                        <span class="bq-note-added">
                                            Added on
                                            <span class="date">
                                                {{ $application->processed_date ? \Carbon\Carbon::parse($application->processed_date)->format('d-m-Y') : '' }}
                                            </span>
                                            at
                                            <span class="time">
                                                {{ $application->processed_date ? \Carbon\Carbon::parse($application->processed_date)->format('H:i:s') : '' }}
                                            </span>
                                        </span>
                                        @if (isset($application->processedUser))
                                            <span class="bq-note-by">By
                                                <span>{{ $application->processedUser->name ?? 'N/A' }}</span></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    <!-- Application Action Section -->
                    @if ($edit_enable)
                        <x-application-action :application="$application" />
                    @endif
                </div>
                <!-- Close .card -->
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
@endsection
