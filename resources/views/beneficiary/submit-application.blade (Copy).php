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
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-header-title"></div>
            </div>
            <div class="col-auto">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home.beneficiary') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Application Form
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<br>
 @if (session('error_status'))
      
            <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                {{ session('error_status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
   
        @endif
<div class="container pb-1">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Death Repartiation / Application Form</h3>

            </div>
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('beneficiary.submit-application') }}" class="needs-validation"
                novalidate id="submit-application-form">
                @csrf
                <div class="row g-4">
                    <div class="section-header">Details of the Deceased</div>
                    <div class="col-md-6">
                        <label for="deceased_person_name" class="form-label">Deceased's Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-validate" id="deceased_person_name"
                            name="deceased_person_name" value="{{ old('deceased_person_name') }}"
                            placeholder="Enter deceased person's name" required>
                        @error('deceased_person_name')
                        <span class="text-danger  invalid-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="passport_no" class="form-label">Passport Number <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-validate" id="passport_no" name="passport_no"
                            value="{{ old('passport_no') }}" placeholder="Enter passport number" maxlength="8" required>
                        @error('passport_no')
                        <span class="text-danger invalid-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="death_date" class="form-label">Date of Death <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-validate " id="death_date" name="death_date"
                            value="{{ old('death_date') }}" placeholder="Select date of death" required>
                        @error('death_date')
                        <span class="text-danger  " role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="country" class="form-label">Country of Death <span
                                class="text-danger">*</span></label>
                        <select class="form-control" id="country" name="country" required>
                            <option value="" disabled selected>Select country </option>
                            @foreach ($countries as $country)
                            <option value="{{ $country->country_id }}"
                                {{ old('country') == $country->country_id ? 'selected' : '' }}>
                                {{ $country->country_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('country')
                        <span class="text-danger  " role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="cause_of_death" class="form-label">Cause of Death<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control form-control-validate" id="cause_of_death" name="cause_of_death" rows="2"
                            placeholder="Enter cause of death"></textarea>
                        @error('cause_of_death')
                        <span class="text-danger  " role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="sponsor_details" class="form-label">Sponsor/Company/Organisation<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control form-control-validate" id="sponsor_details" name="sponsor_details" rows="2"
                            placeholder="Enter sponsor details"></textarea>
                        @error('sponsor_details')
                        <span class="text-danger  " role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="card p-3 mt-4">
                        <div class="section-header">Emergency Contact (Abroad)</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="contact_abroad_name" class="form-label">Contact Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-validate" id="contact_abroad_name" name="contact_abroad_name" placeholder="Enter contact name" value="{{ old('contact_abroad_name') }}" required>
                                @error('contact_abroad_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="contact_abroad_phone" class="form-label"> Contact Number <span
                                        class="text-danger">*</span></label>
                                <input type="tel"
                                    class="form-control  @error('contact_abroad_phone') is-invalid @enderror"
                                    id="contact_abroad_phone" name="contact_abroad_phone" placeholder="Phone Number"
                                    maxlength="25" value="{{ old('contact_abroad_phone') }}" required>

                                @error('contact_abroad_phone')
                                <span class="text-danger  " role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div id="mobile-error" class="text-danger mt-1" style="font-size: 0.9em;"></div>
                                <input type="hidden" name="mobile_country_code" id="mobile-country-code"
                                    value="{{ old('mobile_country_code') ?? '91' }}" />
                                <input type="hidden" name="mobile_country_iso_code" id="mobile-country-iso-code"
                                    class="@error('contact_abroad_phone') is-invalid @enderror"
                                    value="{{ old('mobile_country_iso_code') ?? 'in' }}" />
                            </div>
                            <div class="col-md-6">
                                <label for="alt_contact_abroad_name" class="form-label">Contact Name (Alternative)</label>
                                <input type="text" class="form-control form-control-validate" id="alt_contact_abroad_name" name="alt_contact_abroad_name" placeholder="Enter  contact number" value="{{ old('alt_contact_abroad_name') }}">
                                @error('alt_contact_abroad_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="alt_contact_abroad_phone" class="form-label"> Contact Number (Alternative)</label>
                                <input type="tel"
                                    class="form-control  @error('alt_contact_abroad_phone') is-invalid @enderror"
                                    id="alt_contact_abroad_phone" name="alt_contact_abroad_phone" placeholder="Phone Number"
                                    maxlength="25" value="{{ old('alt_contact_abroad_phone') }}" required>

                                @error('alt_contact_abroad_phone')
                                <span class="text-danger  " role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div id="mobile-error2" class="text-danger mt-1" style="font-size: 0.9em;"></div>
                                <input type="hidden" name="mobile_country_code2" id="mobile-country-code2"
                                    value="{{ old('mobile_country_code2') ?? '91' }}" />
                                <input type="hidden" name="mobile_country_iso_code2" id="mobile-country-iso-code2"
                                    class="@error('alt_contact_abroad_phone') is-invalid @enderror"
                                    value="{{ old('mobile_country_iso_code2') ?? 'in' }}" />
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="section-header">Local Contact</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="contact_local_name" class="form-label">Contact Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-validate" id="contact_local_name"
                                    name="contact_local_name" placeholder="Enter local contact name" value="{{ old('contact_local_name')  }}" required>
                                @error('contact_local_name')
                                <span class="text-danger  " role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="contact_local_phone" class="form-label">Contact Number <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-validate" id="contact_local_phone"
                                    name="contact_local_phone" placeholder="Enter local contact number" value="{{ old('contact_local_phone') }}" required>
                                @error('contact_local_phone')
                                <span class="text-danger  " role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="alt_contact_local_name" class="form-label">Contact Name</label>
                                <input type="text" class="form-control form-control-validate" id="alt_contact_local_name" name="alt_contact_local_name" placeholder="Enter local contact name" value="{{ old('alt_contact_local_name') }}">
                                @error('alt_contact_local_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="alt_contact_local_phone" class="form-label">Contact Number</label>
                                <input type="text" class="form-control form-control-validate" id="alt_contact_local_phone" name="alt_contact_local_phone" placeholder="Enter local contact number" value="{{ old('alt_contact_local_phone') }}">
                                @error('alt_contact_local_phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="native_address" class="form-label">Communication Address <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control form-control-validate" id="native_address" name="native_address" rows="2"
                            placeholder="Enter communication address"></textarea>
                        @error('native_address')
                        <span class="text-danger  " role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="section-header">Departure Details</div>
                    <div class="col-md-6">
                        <label for="airport_from" class="form-label">Departing Airport <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-validate" id="airport_from" name="airport_from"
                            placeholder="Enter departing airport" value="{{ old('airport_from') }}" required>
                        @error('airport_from')
                        <span class="text-danger  " role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="airport_to" class="form-label">Arriving Airport <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-validate" id="airport_to" name="airport_to"
                            placeholder="Enter arriving airport" value="{{ old('airport_to') }}" required>
                        @error('airport_to')
                        <span class="text-danger  " role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <!-- Cargo Services Checkbox -->
                    <div class="col-md-6">
                        <div class="form-check mt-4 pt-2">
                            <input type="checkbox" class="form-check-input" id="cargo_norka_status"
                                name="cargo_norka_status" value="1">
                            <label for="cargo_norka_status" class="form-check-label">Do you require cargo services from NORKA?</label>
                        </div>
                        @error('cargo_norka_status')
                        <span class="text-danger  " role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                     <div class="col-md-6">
                    <div class="form-check mt-4 pt-2">
                        <input type="checkbox" class="form-check-input" id="ambulance_service_status" name="ambulance_service_status" value="1">
                        <label for="ambulance_service_status" class="form-check-label">Do you require Ambulance Service from NORKA?</label>
                    </div>
                    @error('ambulance_service_status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                  <div class="col-md-6 mt-4 pt-2">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="intimation_flag" name="intimation_flag" value="1">
                        <label for="intimation_flag" class="form-check-label">Do you need Whatsapp Intimation?</label>
                    </div>
                    @error('intimation_flag') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                </div>
        </div>
        <div class="mt-4 mb-3 text-center">
            <button type="submit" class="btn btn-secondary" id="submit-btn">
                Submit Application
            </button>
        </div>
        </form>
    </div>
</div>
@endsection
<x-validate-application action="beneficiary.application-validate" />
@push('custom-scripts')
<script>
    var telInput = document.querySelector("#contact_abroad_phone");

    var telInput1 = document.querySelector("#alt_contact_abroad_phone");

    var itiOptions = {
        allowDropdown: true,
        autoPlaceholder: "aggressive",
        utilsScript: "{{ asset('js/libs/intlTelInputWithUtils.js') }}",
        separateDialCode: true,
        formatOnDisplay: false,
        initialCountry: "{{ old('mobile_country_iso_code') ?? 'in' }}",
        preferredCountries: ['in', 'au', 'ca', 'kw', 'om', 'qa', 'sa', 'ae', 'gb', 'us']
    };
    //initialize  intlTelInput
    var regIti = window.intlTelInput(telInput, itiOptions);

    var regIti1 = window.intlTelInput(telInput1, itiOptions);

    // Validation function
    function validatePhoneNumber(input, itiInstance, errorSelector) {
        const errorDiv = document.querySelector(errorSelector);
        if (itiInstance.isValidNumber()) {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            if (errorDiv) errorDiv.textContent = '';
        } else {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
            if (errorDiv) errorDiv.textContent = 'Invalid phone number format.';
        }
    }

    telInput.addEventListener('keyup', () => validatePhoneNumber(telInput, regIti, '#mobile-error'));
    telInput.addEventListener('blur', () => validatePhoneNumber(telInput, regIti, '#mobile-error'));
    // Attach validation events for both
    telInput1.addEventListener('keyup', () => validatePhoneNumber(telInput1, regIti1, '#mobile-error2'));
    telInput1.addEventListener('blur', () => validatePhoneNumber(telInput1, regIti1, '#mobile-error2'));

    // Update hidden fields on country change
    telInput.addEventListener('countrychange', function() {
        var countryCode = regIti.getSelectedCountryData();
        $('#mobile-country-code').val(countryCode.dialCode);
        $('#mobile-country-iso-code').val(countryCode.iso2);
    });
    // Update hidden country code fields for phone 2
    telInput1.addEventListener('countrychange', () => {
        const country = regIti2.getSelectedCountryData();
        document.getElementById('mobile-country-code2').value = country.dialCode;
        document.getElementById('mobile-country-iso-code2').value = country.iso2;
    });
    // Confirmation before submit
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('submit-application-form');
        var submitBtn = document.getElementById('submit-btn');
        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to submit this application?')) {
                    e.preventDefault();
                }
            });
        }
    });
</script>
@endpush