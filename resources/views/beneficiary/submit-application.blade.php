@extends('admin.app')

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
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Application Form</h3>

            </div>
        </div>
        <div class="card-body">
          
            <form method="POST" action="{{ route('beneficiary.submit-application') }}" class="needs-validation"
            novalidate id="submit-application-form">
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <label for="deceased_person_name" class="form-label">Deceased Name <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="deceased_person_name"
                        name="deceased_person_name" value="{{ old('deceased_person_name') }}"
                        placeholder="Enter deceased person's name">
                    @error('deceased_person_name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="passport_no" class="form-label">Passport Number <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control " id="passport_no" name="passport_no"
                        value="{{ old('passport_no') }}" placeholder="Enter passport number">
                    @error('passport_no')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="death_date" class="form-label">Date of Death <span
                            class="text-danger">*</span></label>
                    <input type="date" class="form-control " id="death_date" name="death_date"
                        value="{{ old('death_date') }}" placeholder="Select date of death">
                    @error('death_date')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="country" class="form-label">Country of Death <span
                            class="text-danger">*</span></label>
                    <select class="form-control" id="country" name="country">
                        <option value="" disabled selected>Select country </option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->country_id }}"
                                {{ old('country') == $country->country_id ? 'selected' : '' }}>
                                {{ $country->country_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('country')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="cause_of_death" class="form-label">Cause of Death<span
                            class="text-danger">*</span></label>
                    <textarea class="form-control " id="cause_of_death" name="cause_of_death" rows="2"
                        placeholder="Enter cause of death"></textarea>
                    @error('cause_of_death')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="sponsor_details" class="form-label">Sponsor Details <span
                            class="text-danger">*</span></label>
                    <textarea class="form-control " id="sponsor_details" name="sponsor_details" rows="2"
                        placeholder="Enter sponsor details"></textarea>
                    @error('sponsor_details')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="contact_abroad_name" class="form-label">Overseas Emergency Contact <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control " id="contact_abroad_name"
                        name="contact_abroad_name" placeholder="Enter overseas contact name" value={{ old('contact_abroad_name') }}>
                    @error('contact_abroad_name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="contact_abroad_phone" class="form-label">Overseas Contact Number <span
                            class="text-danger">*</span></label>
                    <input type="tel"
                        class="form-control @error('contact_abroad_phone') is-invalid @enderror"
                        id="contact_abroad_phone" name="contact_abroad_phone" placeholder="Phone Number"
                        maxlength="25" value="{{ old('contact_abroad_phone') }}" required>

                    @error('contact_abroad_phone')
                        <span class="text-danger" role="alert">
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
                    <label for="contact_kerala_name" class="form-label">Local Contact Name <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control " id="contact_kerala_name"
                        name="contact_kerala_name" placeholder="Enter local contact name" value={{ old('contact_kerala_name')  }}>
                    @error('contact_kerala_name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="contact_kerala_phone" class="form-label">Contact Number (in Kerala )<span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control " id="contact_kerala_phone"
                        name="contact_kerala_phone" placeholder="Enter local contact number" value={{ old('contact_kerala_phone') }}>
                    @error('contact_kerala_phone')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="airport_from" class="form-label">Departing Airport <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control " id="airport_from" name="airport_from"
                        placeholder="Enter departing airport" value="{{ old('airport_from') }}">
                    @error('airport_from')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="airport_to" class="form-label">Arriving Airport <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control " id="airport_to" name="airport_to"
                        placeholder="Enter arriving airport" value="{{ old('airport_to') }}">
                    @error('airport_to')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="native_address" class="form-label">Communication Address(in Kerala)</label>
                    <textarea class="form-control " id="native_address" name="native_address" rows="2"
                        placeholder="Enter communication address" ></textarea>
                    @error('native_address')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="cargo_norka_status"
                            name="cargo_norka_status" value="1"
                            {{ old('cargo_norka_status') == '1' ? 'checked' : '' }}>
                        <label for="cargo_norka_status" class="form-check-label">Require cargo services
                            from NORKA?</label>
                    </div>
                    @error('cargo_norka_status')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-secondary" id="submit-btn">
                    Submit Application
                </button>
            </div>
        </form>
        </div>
    </div>
@endsection
@push('custom-scripts')
<script>
var telInput = document.querySelector("#contact_abroad_phone");
var itiOptions = {
    allowDropdown: true,
    autoPlaceholder: "aggressive",
    utilsScript: "{{ asset('js/libs/intlTelInputWithUtils.js') }}",
    separateDialCode: true,
    formatOnDisplay: false,
    initialCountry: "{{ old('mobile_country_iso_code') ?? 'in' }}",
    preferredCountries: ['in', 'au', 'ca', 'kw', 'om', 'qa', 'sa', 'ae', 'gb', 'us']
};
var regIti = window.intlTelInput(telInput, itiOptions);

// Validate phone number dynamically
telInput.addEventListener('keyup', function() {
    validatePhoneNumber();
});

telInput.addEventListener('blur', function() {
    validatePhoneNumber();
});

function validatePhoneNumber() {
    if (regIti.isValidNumber()) {
        telInput.classList.remove('is-invalid'); // Remove invalid class
        telInput.classList.add('is-valid'); // Add valid class
        $('#mobile-error').text(''); // Clear error message
    } else {
        telInput.classList.remove('is-valid'); // Remove valid class
        telInput.classList.add('is-invalid'); // Add invalid class
        $('#mobile-error').text('Invalid phone number format.'); // Show error message
    }
}

// Update hidden fields on country change
telInput.addEventListener('countrychange', function() {
    var countryCode = regIti.getSelectedCountryData();
    $('#mobile-country-code').val(countryCode.dialCode);
    $('#mobile-country-iso-code').val(countryCode.iso2);
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

