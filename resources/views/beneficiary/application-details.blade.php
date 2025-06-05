@extends('admin.app')
<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
        border: none;
    }

    .section-title {
        font-size: 1.25rem;
        color: #495057;
        font-weight: 600;
    }

    .form-control-plaintext {
        min-height: 44px;
        font-size: 1.1rem;
    }

    .section-block {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        font-size: 1.08rem;
    }

    .card-body,
    .card-header,
    .card-footer {
        font-size: 1.12rem;
    }

    label.form-label {
        font-size: 1rem;
    }
</style>
@section('content')
    <!-- Manual Breadcrumbs -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-header-title"></div>
                </div>
                <div class="col-auto">
                    <ul class="breadcrumb">

                        <li class="breadcrumb-item">
                            <a href="{{ route('beneficiary.index') }}">Application History</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Application Details
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12 d-flex justify-content-center">
                <div class="card shadow-sm border-0" style="width:95%;">
                    <!-- Simple Header with Title Left, Date Right -->
                    <div class="card-header bg-white border-bottom-0 py-3">
                        <div class="d-flex flex-column">
                            <h4 class="mb-0" style="font-weight: 600; font-size: 1.5rem;">Application Details</h4>
                            <span class="text-muted small text-end" style="font-size: 1rem;">
                                Submitted: {{ \Carbon\Carbon::parse($application->created_at)->format('d M Y, h:i A') }}
                            </span>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-4">
                        <!-- Deceased Information Section -->
                        <div class="section-block mb-4">
                            <h5 class="section-title bg-light p-2 rounded">
                                Deceased Information
                            </h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small mb-1">Full Name</label>
                                    <div class="form-control-plaintext p-2 bg-light rounded">
                                        {{ $application->deceased_person_name }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small mb-1">Passport Number</label>
                                    <div class="form-control-plaintext p-2 bg-light rounded">
                                        {{ $application->passport_no }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small mb-1">Country of Death</label>
                                    <div class="form-control-plaintext p-2 bg-light rounded">
                                        {{ $application->countryRelation->country_name ?? '' }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small mb-1">Date of Death</label>
                                    <div class="form-control-plaintext p-2 bg-light rounded">
                                        {{ \Carbon\Carbon::parse($application->death_date)->format('d F Y') }}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small mb-1">Cause of Death</label>
                                <div class="form-control-plaintext p-2 bg-light rounded">
                                    {{ $application->cause_of_death }}
                                </div>
                            </div>
                        </div>

                        <!-- Flight Details Section -->
                        <div class="section-block mb-4">
                            <h5 class="section-title bg-light p-2 rounded">
                                Repatriation Details
                            </h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small mb-1">Departing Airport</label>
                                    <div class="form-control-plaintext p-2 bg-light rounded">
                                        {{ $application->airport_from }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small mb-1">Arriving Airport</label>
                                    <div class="form-control-plaintext p-2 bg-light rounded">
                                        {{ $application->airport_to }}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small mb-1">Cargo Services Required</label>
                                <div class="form-control-plaintext p-2 bg-light rounded">
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
                            <h5 class="section-title bg-light p-2 rounded">
                                Contact Information
                            </h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small mb-1">Overseas Emergency Contact</label>
                                    <div class="form-control-plaintext p-2 bg-light rounded">
                                        <div><strong>Name:</strong> {{ $application->contact_abroad_name }}</div>
                                        <div><strong>Phone:</strong> {{ $application->contact_abroad_phone }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small mb-1">Local Contact (Kerala)</label>
                                    <div class="form-control-plaintext p-2 bg-light rounded">
                                        <div><strong>Name:</strong> {{ $application->contact_kerala_name }}</div>
                                        <div><strong>Phone:</strong> {{ $application->contact_kerala_phone }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small mb-1">Communication Address (Kerala)</label>
                                <div class="form-control-plaintext p-2 bg-light rounded">
                                    {{ $application->native_address }}
                                </div>
                            </div>
                        </div>

                        <!-- Sponsor Information Section -->
                        <div class="section-block">
                            <h5 class="section-title bg-light p-2 rounded">
                                Sponsor Information
                            </h5>
                            <div class="mb-3">
                                <label class="form-label text-muted small mb-1">Sponsor Details</label>
                                <div class="form-control-plaintext p-2 bg-light rounded">
                                    {{ $application->sponsor_details }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($edit_enable==1)
                    <button type="button" class="btn btn-primary mt-3">
                        Edit Application</button>
                @endif
                