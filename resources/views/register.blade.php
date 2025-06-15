<!doctype html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>SignUp</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="C-DIT" />

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />
    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="{{ asset('fonts/phosphor/duotone/style.css') }}" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('fonts/tabler-icons.min.css') }}" />
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('fonts/feather.css') }}" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome.css') }}" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('fonts/material.css') }}" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('css/plugins/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/intlTelInput.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('css/style-preset.css') }}" />

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

        /* Custom style for password toggle icon */
        .password-toggle-icon {
            position: absolute;
            top: 70%;
            right: 12px;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 2;
            padding: 0 8px;
            background: transparent;
            display: flex;
            align-items: center;
            height: 100%;
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
                                    <h2 class="text-secondary mt-5"><b>Registration</b></h2>

                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="first_name" class="form-label"><strong>First Name</strong><span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-validate" id="first_name" name="first_name"
                                    placeholder="First name" value="{{ old('first_name') }}" required maxlength="50"/>
                                @error('first_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="middle_name" class="form-label"><strong>Middle Name</strong></label>
                                <input type="text" class="form-control form-control-validate" id="middle_name" name="middle_name"
                                    placeholder="Middle name" value="{{ old('middle_name') }}" maxlength="25"/>
                                @error('middle_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label"><strong>Last Name</strong><span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-validate" id="last_name" name="last_name"
                                    placeholder="Last name" value="{{ old('last_name') }}" required maxlength="50"/>
                                @error('last_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label"><strong>Email Address / Username</strong><span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-validate" id="email" name="email"
                                    placeholder="Email Address" value="{{ old('email') }}" required />
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div>
                                    <label for="user_mobile" class="form-label" style="display:block;"><strong>Mobile
                                            Number</strong><span class="text-danger">*</span></label>
                                </div>
                                <input type="tel" class="form-control @error('user_mobile') is-invalid @enderror"
                                    id="user_mobile" name="user_mobile" placeholder="Phone Number" maxlength="25"
                                    value="{{ old('user_mobile') }}" required>
                                @error('user_mobile')
                                    <div class="text-danger mt-1" style="font-size: 0.9em;">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                                <div id="mobile-error" class="text-danger mt-1" style="font-size: 0.9em;"></div>
                                <input type="hidden" name="mobile_country_code" id="mobile-country-code"
                                    value="{{ old('mobile_country_code') ?? '91' }}" />
                                <input type="hidden" name="mobile_country_iso_code" id="mobile-country-iso-code"
                                    class="@error('user_mobile') is-invalid @enderror"
                                    value="{{ old('mobile_country_iso_code') ?? 'in' }}" />
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="password" class="form-label"><strong>Password</strong><span class="text-danger">*</span></label>
                                <input type="password" class="form-control form-control-validate" id="password" name="password" placeholder="Password" maxlength="8" required />
                                <span class="password-toggle-icon" id="togglePasswordIcon">
                                    <i class="fa fa-eye text-secondary"></i>
                                </span>
                                @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="password_confirmation" class="form-label"><strong>Confirm Password</strong><span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" maxlength="8"required />
                                <span class="password-toggle-icon" id="toggleConfirmPasswordIcon">
                                    <i class="fa fa-eye text-secondary"></i>
                                </span>
                                <div id="password_confirmation_error" class="error-message"></div>
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

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/theme.js') }}"></script>
    <script src="{{ asset('js/plugins/feather.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/libs/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('js/libs/intlTelInputWithUtils.js') }}"></script>

    <script>
        jQuery(function($) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            var telInput = document.querySelector("#user_mobile");
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

          
            function validateField($elem) {
               
                var type = $elem.attr('id');
                var data = {
                    field_name: type
                };
                data[type] = $('#' + type).val();
                var validation_selector = type;
                
                $('#' + validation_selector).removeClass('is-valid is-invalid');
                $('#' + validation_selector).next('.text-danger, .invalid-message').remove();  
                $.ajax({
                    url: '{{ route('user-validation') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    },
                    data: data
                }).fail(function(xhr, textStatus) {
                    console.log(xhr);
                    
                    if (xhr.responseJSON.errors && typeof xhr.responseJSON.errors[type][0] !==
                        'undefined') {
                        $('#' + validation_selector).removeClass('is-valid is-invalid');
                        $('#' + validation_selector).addClass('is-invalid').after(
                            '<span class="text-danger " role="alert">' + xhr.responseJSON.errors[
                                type][0] + '</span>');
                        
                    }
                });
            }

            $('.form-control-validate').on('change', function() {
            
                validateField($(this));
            });
        });

        // Password visibility toggle (run after DOM is ready)
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const togglePasswordIcon = document.getElementById('togglePasswordIcon');
            const toggleConfirmPasswordIcon = document.getElementById('toggleConfirmPasswordIcon');

            if (togglePasswordIcon && passwordInput) {
                togglePasswordIcon.addEventListener('click', function () {
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        togglePasswordIcon.querySelector('i').classList.remove('fa-eye');
                        togglePasswordIcon.querySelector('i').classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        togglePasswordIcon.querySelector('i').classList.remove('fa-eye-slash');
                        togglePasswordIcon.querySelector('i').classList.add('fa-eye');
                    }
                });
            }

            if (toggleConfirmPasswordIcon && confirmPasswordInput) {
                toggleConfirmPasswordIcon.addEventListener('click', function () {
                    if (confirmPasswordInput.type === 'password') {
                        confirmPasswordInput.type = 'text';
                        toggleConfirmPasswordIcon.querySelector('i').classList.remove('fa-eye');
                        toggleConfirmPasswordIcon.querySelector('i').classList.add('fa-eye-slash');
                    } else {
                        confirmPasswordInput.type = 'password';
                        toggleConfirmPasswordIcon.querySelector('i').classList.remove('fa-eye-slash');
                        toggleConfirmPasswordIcon.querySelector('i').classList.add('fa-eye');
                    }
                });
            }
        });
        $('#password_confirmation').on('change', function() {
                const password = $('#password').val();
                const passwordConfirmation = $(this).val();
                const togglePasswordIcon = document.getElementById('toggleConfirmPasswordIcon');
                if (password !== passwordConfirmation) {
                    $('#password_confirmation_error').text('Passwords do not match.');
                    $(this).addClass('is-invalid').removeClass('is-valid');
                    togglePasswordIcon.querySelector('i').classList.remove('fa-eye');
                } else {
                    $('#password_confirmation_error').text('');
                    $(this).removeClass('is-invalid');
                    togglePasswordIcon.querySelector('i').classList.add('fa-eye');
                   
                }
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
