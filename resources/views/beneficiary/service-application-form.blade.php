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

<div class="container pb-1">
    @error('application_no')
    <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    @if (session('error_status'))

    <div class="alert alert-dismissible fade show my-3" role="alert">
        {{ session('error_status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    @endif
    <div class="card">


        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Ambulance Service / Application Form</h3>

            </div>
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('beneficiary.application-submit') }}" class="needs-validation" enctype="multipart/form-data"
                novalidate id="submit-application-form">
                @csrf

                <input type="hidden" name="application_id" value="{{ $application->id ?? '' }}">

                <div class="row g-4">
                    <div class="section-header">Details of the Deceased</div>
                    <div class="col-md-6">
                        <label for="deceased_person_name" class="form-label">Name of the deceased<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-validate" id="deceased_person_name"
                            name="deceased_person_name" value="{{ old('deceased_person_name',$application->deceased_person_name ?? '' ) }}"
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
                            value="{{ old('passport_no',$application->passport_no ?? '') }}" placeholder="Enter passport number" maxlength="8" required>
                        @error('passport_no')
                        <span class="text-danger invalid-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="country" class="form-label">Country <span
                                class="text-danger">*</span></label>
                        <select class="form-control" id="country" name="country" required>
                            <option value="" disabled selected>Select country </option>
                            @foreach ($countries as $country)
                            <option value="{{ $country->country_id }}"
                                {{ old('country', $application->country ?? '') == $country->country_id ? 'selected' : '' }}>
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



                    <div class="card p-3 mt-4">
                        <div class="section-header">Emergency Contact (Abroad)</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="contact_abroad_name" class="form-label">Contact Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-validate" id="contact_abroad_name" name="contact_abroad_name" placeholder="Enter contact name" value="{{ old('contact_abroad_name',$application->contact_abroad_name ?? '') }}" required>
                                @error('contact_abroad_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="contact_abroad_phone" class="form-label"> Contact Number <span
                                        class="text-danger">*</span></label>
                                <input type="tel"
                                    class="form-control  @error('contact_abroad_phone') is-invalid @enderror"
                                    id="contact_abroad_phone" name="contact_abroad_phone" placeholder="Phone Number"
                                    maxlength="25" value="{{ old('contact_abroad_phone',$application->contact_abroad_phone ?? '') }}" required>

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
                                <input type="text" class="form-control form-control-validate" id="alt_contact_abroad_name" name="alt_contact_abroad_name" placeholder="Enter  contact number" value="{{ old('alt_contact_abroad_name',$application->alt_contact_abroad_name ??'') }}">
                                @error('alt_contact_abroad_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="alt_contact_abroad_phone" class="form-label"> Contact Number (Alternative)</label>
                                <input type="tel"
                                    class="form-control  @error('alt_contact_abroad_phone') is-invalid @enderror"
                                    id="alt_contact_abroad_phone" name="alt_contact_abroad_phone" placeholder="Phone Number"
                                    maxlength="25" value="{{ old('alt_contact_abroad_phone',$application->alt_contact_abroad_phone ?? '') }}" required>

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
                                    name="contact_local_name" placeholder="Enter local contact name" value="{{ old('contact_local_name',$application->contact_local_name ?? '')  }}" required>
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
                                    name="contact_local_phone" placeholder="Enter local contact number" value="{{ old('contact_local_phone',$application->contact_local_phone ?? '') }}" required>
                                @error('contact_local_phone')
                                <span class="text-danger  " role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="alt_contact_local_name" class="form-label">Contact Name (Alternative)</label>
                                <input type="text" class="form-control form-control-validate" id="alt_contact_local_name" name="alt_contact_local_name" placeholder="Enter local contact name" value="{{ old('alt_contact_local_name',$application->alt_contact_local_name ?? '') }}">
                                @error('alt_contact_local_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="alt_contact_local_phone" class="form-label">Contact Number (Alternative)</label>
                                <input type="text" class="form-control form-control-validate" id="alt_contact_local_phone" name="alt_contact_local_phone" placeholder="Enter local contact number" value="{{ old('alt_contact_local_phone',$application->alt_contact_local_phone ?? '') }}">
                                @error('alt_contact_local_phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="section-header">Flight Details</div>
                    <div class="col-md-6">
                        <label for="flight_no" class="form-label">Flight Number<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-validate" id="flight_no" name="flight_no"
                            placeholder="Enter flight number" value="{{ old('flight_no') }}" maxlength="10" required>
                        @error('flight_no')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="departure_date" class="form-label">Departing Date & Time <span class="text-danger">*</span></label>
                        <div class="row g-2">
                            <!-- Date Input -->
                            <div class="col-md-7">


                                <input type="date"
                                    class="form-control form-control-validate"
                                    id="departure_date"
                                    name="departure_date"
                                    value="{{ old('departure_date') }}"
                                    min="{{ now()->format('Y-m-d') }}"
                                    required>
                                @error('departure_date')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <!-- Time Input -->
                            <div class="col-md-5">


                                <div class="input-group timepicker">
                                    <input class="form-control flatpickr-input" id="departure_time"
                                        name="departure_time" placeholder="Select time" type="text" readonly="readonly" value="{{ old('departure_time') }}">
                                         <span class="input-group-text"><i class="feather icon-clock"></i></span></div>



                                @error('departure_time')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="arrival_airport" class="form-label">Arrival Airport<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-validate" id="arrival_airport" name="arrival_airport"
                            placeholder="Enter airport" value="{{ old('arrival_airport') }}">
                        @error('arrival_airport')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="arriving_date">Arriving Date & Time <span class="text-danger">*</span></label>
                        <div class="row g-2">
                            <!-- Date Input -->
                            <div class="col-md-7">

                                <div id="arriving_date_wrapper">
                                    <input type="date"
                                        class="form-control date-control-validate"
                                        id="arriving_date"
                                        name="arriving_date"
                                        value="{{ old('arriving_date') }}"
                                        min="{{ now()->format('Y-m-d') }}"
                                        required>
                                    @error('arriving_date')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Time Input -->
                            <div class="col-md-5">
                                <div id="arriving_time_wrapper">
                                    <div class="input-group timepicker">
                                        <input class="form-control flatpickr-input date-control-validate" id="arriving_time"
                                            name="arriving_time" placeholder="Select time" type="text" readonly="readonly" value="{{ old('arriving_time') }}">
                                        <span class="input-group-text"><i class="feather icon-clock"></i></span>
                                    </div>
                                    <!-- <input type="time"
                                    class="form-control date-control-validate"
                                    id="arriving_time"
                                    name="arriving_time"
                                    value="{{ old('arriving_time') }}"
                                    required> -->
                                    @error('arriving_time')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section-header">Destination Details</div>
                    <div class="col-md-6">
                        <label for="state" class="form-label">State<span
                                class="text-danger">*</span></label>
                        <select class="form-control" id="state" name="state" required>
                            <option value="" disabled selected>Select state </option>
                            @foreach ($states as $state)
                            <option value="{{ $state->state_id }}"
                                {{ old('state') == $state->state_id ? 'selected' : '' }}>
                                {{ $state->state_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('state')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="district" class="form-label">District <span
                                class="text-danger">*</span></label>
                        <select class="form-control" id="district" name="district" required>
                            <option value="" disabled selected>Select district </option>

                        </select>
                        @error('district')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="native_address" class="form-label">Communication Address <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control form-control-validate" id="native_address" name="native_address" rows="2"
                            placeholder="Enter communication address" required>{{ old('native_address', $application->native_address ?? '') }}</textarea>
                        @error('native_address')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>

                <div class="row g-4">
                    <div class="col-md-6 mt-5 pt-2">
                        <label for="application_attachment" class="form-label">Upload Attachment <span
                                class="text-danger">*</span></label>
                        <div class="form-file mb-3">
                            <input type="file" class="form-control" aria-label="file example" name="application_attachment" required>
                            @error('application_attachment')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6  mt-5 pt-2">
                        <div class="form-check  mt-4 pt-2">
                            <input type="checkbox" class="form-check-input" id="intimation_flag" name="intimation_flag" value="1"
                                {{ old('intimation_flag', $application->intimation_flag ?? '') == 1 ? 'checked' : '' }}>
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
<x-validate-application action="beneficiary.validate-application" />
@push('custom-scripts')
<script>
    flatpickr('#departure_time', {
        enableTime: true,
        noCalendar: true,

    });
    flatpickr('#arriving_time', {
        enableTime: true,
        noCalendar: true,

    });

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
    $('#state').on('change', function() {
        var stateId = $(this).val();
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        if (stateId) {
            $.ajax({
                url: '{{ route('load-districts') }}',
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                data: {
                    state_id: stateId
                },
                success: function(response) {
                    var $districtSelect = $('#district');
                    $districtSelect.empty(); // Clear existing options

                    // Add default option
                    $districtSelect.append('<option value="">Select District</option>');

                    // Add districts from response
                    if (response.districts && response.districts.length > 0) {
                        $.each(response.districts, function(key, district) {
                            $districtSelect.append('<option value="' + district.district_id + '">' + district.district_name + '</option>');
                        });
                    }

                    // Enable the district select
                    $districtSelect.prop('disabled', false);
                },
                error: function(xhr) {
                    console.error('Error loading districts:', xhr.responseText);
                    $('#district').empty().append('<option value="">Failed to load districts</option>');
                }
            });
        } else {
            // If no state selected, disable and reset district dropdown
            $('#district').empty().append('<option value="">Select State first</option>').prop('disabled', true);
        }
    });
</script>
@endpush