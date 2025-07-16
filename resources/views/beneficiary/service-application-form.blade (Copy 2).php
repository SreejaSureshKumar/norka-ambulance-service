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
            <h3 class="card-title mb-0">Ambulance Service / Application Form</h3>

        </div>
    </div>
    <div class="card-body">

        <form method="POST" action="{{ route('beneficiary.application-submit') }}" class="needs-validation" enctype="multipart/form-data"
            novalidate id="submit-application-form">
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <label for="deceased_person_name" class="form-label">Deceased's Name <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-validate" id="deceased_person_name"
                        name="deceased_person_name" value="{{ old('deceased_person_name',$application->deceased_person_name ?? '' )}}"
                        placeholder="Enter deceased person's name" maxlength="50" required>
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
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>



                <div class="col-md-6">
                    <label for="contact_abroad_name" class="form-label">Abroad Emergency Contact <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-validate" id="contact_abroad_name"
                        name="contact_abroad_name" placeholder="Enter Abroad contact name" value="{{ old('contact_abroad_name',$application->contact_abroad_name) }}" maxlength="30">
                    @error('contact_abroad_name')
                    <span class="text-danger  " role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="contact_abroad_phone" class="form-label">Abroad Contact Number <span
                            class="text-danger">*</span></label>
                    <input type="tel"
                        class="form-control  @error('contact_abroad_phone') is-invalid @enderror"
                        id="contact_abroad_phone" name="contact_abroad_phone" placeholder="Phone Number"
                        maxlength="25" value="{{ old('contact_abroad_phone',$application->contact_abroad_phone) }}" required>

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
                    <label for="contact_local_name" class="form-label">Local Contact Name <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-validate" id="contact_local_name"
                        name="contact_local_name" placeholder="Enter local contact name" value="{{ old('contact_local_name',$application->contact_local_name)  }}" maxlength="30" required>
                    @error('contact_local_name')
                    <span class="text-danger  " role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="contact_local_phone" class="form-label">Local Contact Number <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-validate" id="contact_local_phone"
                        name="contact_local_phone" placeholder="Enter local contact number" value="{{ old('contact_local_phone',$application->contact_local_phone) }}" required>
                    @error('contact_local_phone')
                    <span class="text-danger  " role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
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

                            <input type="time"
                                class="form-control form-control-validate"
                                id="departure_time"
                                name="departure_time"
                                value="{{ old('departure_time') }}"
                                required>
                            @error('departure_time')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <label class="form-label" for="arriving_date">Arriving Date & Time <span class="text-danger">*</span></label>
                    <div class="row g-2">
                        <!-- Date Input -->
                        <div class="col-md-7">


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

                        <!-- Time Input -->
                        <div class="col-md-5">

                            <input type="time"
                                class="form-control date-control-validate"
                                id="arriving_time"
                                name="arriving_time"
                                value="{{ old('arriving_time') }}"
                                required>
                            @error('arriving_time')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                </div>
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
                <div class="col-md-6">
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
<x-validate-application action="beneficiary.validate-application" />
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