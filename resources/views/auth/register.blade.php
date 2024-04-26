{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
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
@section('title', 'Signup')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid p-0">
   <!-- login page start-->
   <div class="authentication-main">
      <div class="row">
         <div class="col-md-12">
            <div class="auth-innerright">
               <div class="authentication-box">
                  <div class="card-body">
                     <div class="cont text-center">
                        <div>
                           <form class="theme-form" {{ route('register') }} method="post">
                            @csrf

                              <h4 class="text-center">NEW USER</h4>
                              <h6 class="text-center">Enter your Username and Password For Signup</h6>
                              <div class="form-row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="First Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                       @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <input class="form-control @error('phone') is-invalid @enderror" type="text" placeholder="Phone Number" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                       @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="Enter Email"  name="email" value="{{ old('email') }}" required autocomplete="email">
                                 @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              <div class="form-group">
                                 <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" value="{{ old('password') }}" required autocomplete="password">
                                 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              <div class="form-row">
                                 <div class="col-sm-4">
                                    <button class="btn btn-primary" type="submit">Sign Up</button>
                                 </div>
                                 <div class="col-sm-8">
                                    <div class="text-left mt-2 m-l-20">Are you already user?  <a class="btn-link text-capitalize" href="{{ route('login') }}">Login</a></div>
                                 </div>
                              </div>
                              <div class="form-divider"></div>
                              <div class="social mt-3">
                                 <div class="form-row btn-showcase">
                                    <div class="col-sm-4">
                                       <button class="btn social-btn btn-fb">Facebook</button>
                                    </div>
                                    <div class="col-sm-4">
                                       <button class="btn social-btn btn-twitter">Twitter</button>
                                    </div>
                                    <div class="col-sm-4">
                                       <button class="btn social-btn btn-google">Google +</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                        <div class="sub-cont">
                           <div class="img">
                              <div class="img__text">
                                 <h2>New here?</h2>
                                 <p>Sign up and discover great amount of new opportunities!</p>
                              </div>
                              <a href="{{ route('login') }}"><div class="img__btn"><span class="d-flex align-center justify-content-center">Sign IN</span></div></a>

                           </div>
                           <div>
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
</div>
@endsection

@section('script')
<script src="{{route('/')}}/assets/js/login.js"></script>
@endsection