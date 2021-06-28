<html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <link rel="contract" sizes="76x76" href="{{asset('adminTemplate/assets/img/contract.png')}}">
      <link rel="icon" type="image/png" href="{{asset('adminTemplate/assets/img/contract.png')}}">

      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">

      <link rel="stylesheet" href="{{ asset('loginTemplate/fonts/icomoon/style.css') }}">
      <link rel="stylesheet" href="{{ asset('loginTemplate/css/owl.carousel.min.css') }}">

      <link rel="stylesheet" href="{{ asset('loginTemplate/css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('loginTemplate/css/style.css') }}">

      <title>Selamat Datang</title>
    </head>
    <body>
      <div class="d-lg-flex half">
          <div class="bg order-1 order-md-2" style="background-image: url({{asset('loginTemplate/images/tes.svg')}});"></div>
          <div class="contents order-2 order-md-1">

          <div class="container">
              <div class="row align-items-center justify-content-center">
              <div class="col-md-7 mt-2">
                  <h3 style="font-family: 'Staatliches', cursive;">P e r p u s k u</h3>
                  <p class="mb-4">SMK WIKRAMA 1 GARUT</p>
                  <form method="POST" action="{{ route('auth.register') }}">
                      @csrf

                  <div class="form-group first">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" placeholder="Name" id="name" name="name" autocomplete="off" value="{{ old('name') }}">

                        @error('name')
                            <div class="text-danger text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                  </div>
                  <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Email" id="email" name="email" autocomplete="off" value="{{ old('email') }}">

                        @error('email')
                            <div class="text-danger text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                  </div>
                  <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" placeholder="Password" id="password" name="password"  autocomplete="off">

                        @error('email')
                            <div class="text-danger text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                  </div>
                  <div class="form-group last mb-3">
                        <label for="password">Confirm Password</label>
                        <input type="password" class="form-control" placeholder="confirmation password" id="password" name="password_confirmation"  autocomplete="off">
                   </div>

                  <div class="d-flex mb-3 align-items-center">
                      <label class="control control--checkbox mb-0 d-inline">
                          <span class="caption mb-2">Remember me</span>
                        <p class="text-sm">punya akun ? <a href="{{ route('auth.login') }}">Login</a> </p>
                      <input name="remember" id="remember" type="checkbox" checked="checked"/>
                      <div class="control__indicator"></div>
                      </label>
                  </div>

                  <button type="submit" class="btn btn-block btn-primary">Register</button>
                  </form>
              </div>
              </div>
          </div>
          </div>
      </div>

      <script src="{{ asset('loginTemplate/js/jquery-3.3.1.min.js') }}" ></script>
      <script src="{{ asset('loginTemplate/js/popper.min.js') }}" ></script>
      <script src="{{ asset('loginTemplate/js/bootstrap.min.js') }}" ></script>
      <script src="{{ asset('loginTemplate/js/main.js') }}"></script>
    </body>
