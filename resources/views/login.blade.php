<!doctype html>
<html lang="en">
  <!-- [Head] start -->
  <head>
    <title>Login </title>
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



<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="{{asset('fonts/fontawesome.css')}}" />

<link rel="stylesheet" href="{{asset('css/style.css')}}" id="main-style-link" />

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
   
              <div class="row">
                <div class="d-flex justify-content-center">
                  <div class="auth-header">
                   
                    <p class="f-16 mt-2">Enter your credentials to continue</p>
                  </div>
                </div>
              </div>
            
              <h5 class="my-4 d-flex justify-content-center">Sign in with Email address</h5>
              <form method="POST" action="{{ route('login') }}">
                @csrf
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="user_login" name="user_login" placeholder="Email address / Username" />
                <label for="user_login">Email address / Username</label>
                @error('user_login')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                <label for="password">Password</label>
                @error('password')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
             
              </div>
              {{-- <div class="d-flex mt-1 justify-content-between">
                <div class="form-check">
                  <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="" />
                  <label class="form-check-label text-muted" for="customCheckc1">Remember me</label>
                </div>
                <h5 class="text-secondary">Forgot Password?</h5>
              </div> --}}
              <div class="d-grid mt-4">
                <button type="submit" class="btn btn-secondary">Sign In</button>
              </div>
            </form>
              <hr />
              <h5 class="d-flex justify-content-center">Don't have an account?</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Main Content ] end -->
    <!-- Required Js -->
   

    <script src="{{ asset('js/script.js')}}"></script>
   
    <script src="{{ asset('js/plugins/feather.min.js') }}"></script>

    <script src="{{ asset('js/theme.js')}}"></script>
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
    

  </body>
  <!-- [Body] end -->
</html>
