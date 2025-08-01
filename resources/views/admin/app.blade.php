<!doctype html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>@yield('title', 'Dashboard') | {{ config('app.name', 'Norka  Service') }}</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="codedthemes" />

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />

  
    <link rel="stylesheet" href="{{ asset('fonts/phosphor/duotone/style.css') }}" />
   
    <link rel="stylesheet" href="{{ asset('fonts/tabler-icons.min.css') }}" />
   
    <link rel="stylesheet" href="{{ asset('fonts/feather.css') }}" />
   
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/plugins/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('fonts/material.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins/bootstrap.min.css') }}" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('css/style-preset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/intlTelInput.min.css') }}" />
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

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr"
    data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    <x-admin.side-bar />
    <!-- [ Sidebar Menu ] end -->
    <!-- [ Header Topbar ] start -->
    <x-admin.main-header />
    <!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <x-admin.main-bread-crumbs />
            <!-- [ breadcrumb ] end -->


            <!-- [ Main Content ] start -->
            @yield('content')
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <x-admin.main-footer />
    <!-- Required Js -->
     <script src="{{asset('js/plugins/apexcharts.min.js')}}"></script>
    <script src="{{ asset('js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/theme.js') }}"></script>
    <script src="{{ asset('js/plugins/feather.min.js') }}"></script>
 <script src="{{ asset('js/plugins/flatpickr.min.js') }}" ></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/libs/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('js/libs/intlTelInputWithUtils.js') }}"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('js/datatables.min.js') }}"></script>

    <script>
        layout_change('light');
    </script>

   

    <script>
        change_box_container('false');
    </script>

    <script>
        layout_caption_change('true');
    </script>

    <script>
        layout_rtl_change('false');
    </script>

    <script>
        preset_change('preset-1');
    </script>
    <x-document-modal />


    @stack('custom-scripts')
</body>
<!-- [Body] end -->

</html>
