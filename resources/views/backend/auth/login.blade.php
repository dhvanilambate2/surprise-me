{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <input class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" type="password" id="password-field">
                                    <div class="input-group-append">
                                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                </div>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('layouts.app.master')
@section('title', 'Login')

@section('css')
<style>
  .register_btn{
    overflow: hidden;
    z-index: 2;
    position: relative;
    height: 40px;
    background: transparent;
    color: #fff;
    text-transform: uppercase;
    font-size: 15px;
    cursor: pointer;
    margin: 0 50px;
  }
 
  }
</style>
@endsection

@section('style')
@endsection

@section('content')
<style>
     .eye-icon{
      position: absolute;
    top: 12px;
    right: 20px;
}
.input-group>.form-control:focus{
    z-index: 0 !important;
}
</style>
<!-- login page start-->
<div class="container-fluid p-0">
  <div class="authentication-main">
     <div class="row">
        <div class="col-md-12">
          <div class="auth-innerright">
            <div class="authentication-box">
              <div class="card-body p-0">
                <div class="cont text-center">
                  <div> 
                    <form class="theme-form" action="{{ route('login') }}" method="POST">
                        @csrf
                      <h4>LOGIN</h4>
                      <h6>Enter your Username and Password</h6>
                      <div class="form-group">
                        <label class="col-form-label pt-0">Your Name</label>
                        <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" type="text" required="" autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group password-group">
                        <label class="col-form-label">Password</label>
                        <div class="input-group position-relative ">
                            <input class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" type="password" id="password-field">
                            <div class="input-group-append eye-icon">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                        </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      {{-- <div class="checkbox p-0">
                        <input id="checkbox1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="checkbox1">Remember me</label>
                      </div> --}}
                      <div class="form-group form-row mt-3 mb-0">
                        <button class="btn btn-primary btn-block" type="submit">LOGIN</button>
                      </div>
                      
                    </form>
                  </div>
                  <div class="sub-cont">
                    <div class="img">
                      <div class="img__text">
                        <h2>New here?</h2>
                        <p>Sign up and discover great amount of new opportunities!</p>
                      </div>
                      <a href="{{ route('register') }}"><div class="img__btn"><span class="d-flex align-center justify-content-center">Sign UP</span></div></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
     </div>
  </div>
</div>
<!-- login page end-->
@endsection

@section('script')
<script src="{{asset('assets/js/login.js')}}"></script>
<script>
    // Show/hide password functionality
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
@endsection