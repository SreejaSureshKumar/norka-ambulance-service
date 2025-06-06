<!doctype html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Login </title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="C-DIT" />


    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" id="main-style-link" />
    <style>
        .wrapx {
            background: #f2f9ff;
            padding: 8px;
            border: 1px solid #e0edf9;
            border-radius: 6px;
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
                <div class="card my-5">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-fill alert-primary alert-icon mb-4">
                                <em class="icon ni ni-check-circle"></em> <strong>{{ session('status') }}</strong>
                            </div>
                        @endif
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="auth-header">

                                    <h2 class="text-secondary mt-5"><b>Sign In</b></h2>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="user_login" name="user_login"
                                    placeholder="Email address / Username" />
                                <label for="user_login">Email address / Username</label>
                                @error('user_login')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3 position-relative">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" />
                                <label for="password">Password</label>
                                <span class="position-absolute"
                                    style="top: 50%; right: 16px; transform: translateY(-50%); cursor:pointer; z-index:2;"
                                    id="togglePasswordIcon">
                                    <i class="fa fa-eye text-secondary"></i>
                                </span>
                                @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <div class="captcha-control-wrap wrapx form-control-wrap">
                                    <img src="data:image/png;base64,{{ app(App\Services\CaptchaService::class)->generate() }}"
                                        alt="captcha" id="captcha-img"
                                        style="height:48px; border-radius:4px; border:1px solid #e3e3e3;">
                                    <button type="button" class="refresh-captcha btn btn-sm btn-outline-secondary ms-1"
                                        data-action="{{ route('refresh-captcha') }}">Refresh</button>
                                    <input type="text"
                                        class="form-control mt-1 form-control-lg @error('captcha') is-invalid @enderror"
                                        id="captcha" name="captcha" placeholder="Enter CAPTCHA" minlength="6"
                                        maxlength="6" required>

                                    @error('captcha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-secondary">Sign In</button>
                            </div>
                        </form>
                        <hr />
                        <div class="d-flex mt-1 justify-content-between">


                            <h5 class="d-flex justify-content-center">Don't have an account?</h5>
                            <a href="{{ route('register') }}">Sign up</a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <!-- Required Js -->

    <script src="{{ asset('js/jquery.js') }}"></script>

    <script src="{{ asset('js/script.js') }}"></script>

    <script src="{{ asset('js/plugins/feather.min.js') }}"></script>

    <script src="{{ asset('js/theme.js') }}"></script>
    <script>
        jQuery(function($) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

            function refreshCaptcha() {
                var $elem = $(this);
                $elem.prop('disabled', true);

                var action = $elem.data('action');
                $.ajax({
                    url: action,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    }
                }).done(function(data) {
                    $elem.parent('.captcha-control-wrap').find('img').attr('src', data);
                }).always(function() {
                    $elem.prop('disabled', false);
                });
            }

            $(document).on('click', '.refresh-captcha', refreshCaptcha);
        });
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const togglePasswordIcon = document.getElementById('togglePasswordIcon');

            togglePasswordIcon.addEventListener('click', function() {
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
