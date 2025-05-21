<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>@yield('title', 'Dashboard') | {{ config('app.name', 'Norka Ambulance Service') }}</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="description"
      content="Berry is trending dashboard template made using Bootstrap 5 design framework. Berry is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies."
    />
    <meta
      name="keywords"
      content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard"
    />
    <meta name="author" content="codedthemes" />

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{asset('images/favicon.svg')}}" type="image/x-icon" />

<!-- [phosphor Icons] https://phosphoricons.com/ -->
<link rel="stylesheet" href="{{asset('fonts/phosphor/duotone/style.css')}}" />
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="{{asset('fonts/tabler-icons.min.css')}}" />
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="{{asset('fonts/feather.css')}}" />
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="{{asset('fonts/fontawesome.css')}}" />
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="{{asset('fonts/material.css')}}" />
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="{{asset('css/style.css')}}" id="main-style-link" />
<link rel="stylesheet" href="{{asset('css/style-preset.css')}}" />

  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->

  <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
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
    <x-admin.main-footer />
 <!-- Required Js -->

 <script src="{{ asset('js/plugins/simplebar.min.js')}}"></script>
<script src="{{ asset('js/script.js')}}"></script>
<script src="{{ asset('js/plugins/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/plugins/feather.min.js') }}"></script>
<script src="{{ asset('js/fonts/custom-font.js')}}"></script>
   
<script>
  layout_change('light');
</script>
   
<script>
  font_change('Roboto');
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

@stack('custom-scripts')
  </body>
  <!-- [Body] end -->
</html>
