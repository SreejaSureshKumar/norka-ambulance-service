<!doctype html>
<html lang="en">
  <!-- [Head] start -->
  <head>
    <title>SignUp</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="description"
      content=""
    />
    <meta
      name="keywords"
      content=""
    />
    <meta name="author" content="C-DIT" />

    <!-- [Favicon] icon -->
<link rel="icon" href="{{asset('images/favicon.svg')}}" type="image/x-icon" />
<!-- [phosphor Icons] https://phosphoricons.com/ -->
<link rel="stylesheet" href="{{asset('fonts/phosphor/duotone/style.css')}}" />
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="{{asset('fonts/tabler-icons.min.css')}}" /><!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="{{asset('fonts/feather.css')}}" />
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="{{asset('fonts/fontawesome.css')}}" />
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="{{asset('fonts/material.css')}}" />
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="{{asset('css/plugins/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/intlTelInput.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/style.css')}}" id="main-style-link" />
<link rel="stylesheet" href="{{asset('css/style-preset.css')}}" />

<style>
.iti {
  --iti-path-flags-1x: url('{{ asset('images/flags.webp') }}');
  --iti-path-flags-2x: url('{{ asset('images/flags@2x.webp') }}');
  --iti-path-globe-1x: url('{{ asset('images/globe.webp') }}');
  --iti-path-globe-2x: url('{{ asset('images/globe@2x.webp') }}');
  width: 100%;
}
.iti input[type="tel"] {
  width: 100%;
}
</style>

  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->
  <body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <div class="auth-main">
      <div class="auth-wrapper v3">
        <div class="auth-form">
          <div class="card mt-5">
            <div class="card-body">
             
              <div class="row">
                <div class="d-flex justify-content-center">
                  <div class="auth-header">
                    <h2 class="text-secondary mt-5"><b>Create an account</b></h2>
                  
                  </div>
                </div>
              </div>
            
              <form method="POST" action="{{ route('register') }}">
                @csrf
               
                <div class="mb-3">
                  <label for="first_name" class="form-label"><strong>Firstname</strong></label>
                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" required />
                  @error('first_name')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="middle_name" class="form-label"><strong>Middlename</strong></label>
                  <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle name" />
                  @error('middle_name')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="last_name" class="form-label"><strong>Lastname</strong></label>
                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" required />
                  @error('last_name')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label"><strong>Email Address / Username</strong></label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" required />
                  @error('email')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <div>
                    <label for="mobile" class="form-label" style="display:block;"><strong>Mobile Number</strong></label>
                  </div>
                  <input type="tel"
                    class="form-control @error('mobile') is-invalid @enderror"
                    id="mobile" name="mobile" placeholder="Phone Number" maxlength="25"
                    value="{{ old('mobile') }}" required>
                  @error('mobile')
                  <div class="text-danger mt-1" style="font-size: 0.9em;">
                      <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                  <div id="mobile-error" class="text-danger mt-1" style="font-size: 0.9em;"></div>
                  <input type="hidden" name="mobile_country_code" id="mobile-country-code"
                      value="{{ old('mobile_country_code') ?? '91' }}" />
                  <input type="hidden" name="mobile_country_iso_code" id="mobile-country-iso-code"
                      class="@error('mobile') is-invalid @enderror"
                      value="{{ old('mobile_country_iso_code') ?? 'in' }}" />
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label"><strong>Password</strong></label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
                  @error('password')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="password_confirmation" class="form-label"><strong>Confirm Password</strong></label>
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required />
                </div>
                <div class="d-grid mt-4">
                  <button type="submit" class="btn btn-secondary p-2">Sign Up</button>
                </div>
              </form>
              <hr />
            
              <div class="d-flex mt-1 justify-content-between">
                
                <h5 class="d-flex justify-content-center">Already have an account?</h5> 
                <a href="{{ route('login') }}">Sign In</a>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Main Content ] end -->
    <!-- Required Js -->
 
 <script src="{{ asset('js/script.js')}}"></script>
 <script src="{{asset('js/theme.js')}}"></script>
<script src="{{ asset('js/plugins/feather.min.js') }}"></script>
<script src="{{ asset('js/jquery.js')}}"></script>
<script src="{{ asset('js/libs/intlTelInput.min.js') }}"></script>
<script src="{{ asset('js/libs/intlTelInputWithUtils.js') }}"></script>
       
    <script>
      
      jQuery(function($) {
    var telInput = document.querySelector("#mobile");
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
});
layout_change('light');
      font_change('Roboto');
      change_box_container('false');
      layout_caption_change('true');
      layout_rtl_change('false');
      preset_change('preset-1');
    </script>
    
    <div class="nk-footer nk-auth-footer-full">
        <div class="container wide-lg">
            <div class="row g-3">
                <div class="col-lg-12">
                    <div class="nk-block-content text-center text-lg-left">
                        <p class="text-soft">
                            &copy; {{ now()->year }} NORKA Roots, Kerala'.
                           All Rights Reserved.
                            Developed by
                            <a href="https://cdit.org/" target="_blank"> {{ __('C-DIT') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </body>
  <!-- [Body] end -->
</html>
