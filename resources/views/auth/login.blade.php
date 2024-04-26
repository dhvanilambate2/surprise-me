@php 
$setting = App\Models\SiteSettng::findOrFail('1'); 
@endphp
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Gaia - Real Estate</title>
    <meta name="author" content="Gaia">
    <meta name="description" content="Gaia - Real Estate">
    <meta name="keywords" content="Gaia - Real Estate">
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    
    <link rel="icon" type="image/png" sizes="192x192" href="{{ $setting->getFirstMediaUrl('fev_image') }}">
    <link rel="manifest" href="{{ url('frontend') }}/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ url('frontend') }}/assets/img/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@100;200;300;400;600;700&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!--==============================
	    All CSS File
	============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ url('frontend') }}/assets/css/bootstrap.min.css">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="{{ url('frontend') }}/assets/css/fontawesome.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ url('frontend') }}/assets/css/magnific-popup.min.css">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{ url('frontend') }}/assets/css/slick.min.css">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ url('frontend') }}/assets/css/style.css">
    
    <style>
        .header-top, 
.header-links {
    font-family: var(--para-font);
    background-color: #D4AF37;
}
.users_class:before{
    content : '' !important;
}
     .eye-icon{
      position: absolute;
    top: 27%;
    right: 20px;
}
.input-group>.form-control:focus{
    z-index: 0 !important;
}
    </style>

</head>

<body class="">

    <!--********************************
   		Code Start From Here 
	******************************** -->
        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            
            <div class="w-50 wow fadeInUp" data-wow-delay="0.2s">
                <div class="img-box5">
                    <div class="p-2" style="background-color: #272727;">
                        <h2 class="sec-title">Welcome back! <br>
                            Sign in to your account.
                        </h2>
                        <form class="" novalidate action="{{ route('login') }}" method="POST" class="contact-form">
                        @csrf
                            <div class="row">
                                <div class="form-group">
                                <label class="col-form-label pt-0">Your Name</label>
                                <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" type="text" required="" autocomplete="email" autofocus placeholder="Enter your Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              <div class="form-group password-group">
                                <label class="col-form-label">Password</label>
                                <div class="input-group position-relative ">
                                    <input class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" type="password" id="password-field" placeholder="Enter your Password">
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
                                <div class="form-btn col-12 mt-10">
                                    <button type="submit" class="th-btn"><span class="line left"></span> Login<span class="line"></span></button>
                                </div>
                            </div>
        
                        </form>
                    </div>
                </div>
            </div>
        </div>

<!--********************************
			Code End  Here 
	******************************** -->


<!-- Scroll To Top -->
<div class="scroll-top">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
    </svg>
</div>



<!--==============================
    All Js File
============================== -->
<!-- Jquery -->
<script src="{{ url('frontend') }}/assets/js/vendor/jquery-3.6.0.min.js"></script>
<!-- Slick Slider -->
<script src="{{ url('frontend') }}/assets/js/slick.min.js"></script>
<!-- Bootstrap -->
<script src="{{ url('frontend') }}/assets/js/bootstrap.min.js"></script>
<!-- Magnific Popup -->
<script src="{{ url('frontend') }}/assets/js/jquery.magnific-popup.min.js"></script>
<!-- Counter Up -->
<script src="{{ url('frontend') }}/assets/js/jquery.counterup.min.js"></script>
<!-- Wow Animation -->
<script src="{{ url('frontend') }}/assets/js/wow.min.js"></script>
<!-- Main Js File -->
<script src="{{ url('frontend') }}/assets/js/main.js"></script>
<!-- Form Validation  -->
<script src="{{ url('frontend') }}/assets/js/validation.js"></script>
<!-- Sweet alert-->
<script src="{{route('/')}}/assets/js/sweet-alert/sweetalert.min.js"></script>
<script>
var SweetAlert_custom = {
    init: function() {
        @if (session('success'))
            swal("Success", "{{ session('success') }}", "success")
        @endif

        @if (session('error'))
            swal("Error", "{{ session('error') }}", "error")
        @endif

    }
};
(function($) {
    SweetAlert_custom.init()
})(jQuery);
</script>
<!-- Sweet alert-->

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



{{-- <script>
document.addEventListener("DOMContentLoaded", function() {
    // Check if the session cookie exists
    if (document.cookie.indexOf('preloaderHidden') === -1) {
        // If not, hide the preloader and set the session cookie
        document.getElementById('preloader').classList.add('hidden');
        document.cookie = 'preloaderHidden=true; path=/';
    }
});

// Function to show the preloader again (for testing purposes)
function showPreloader() {
    // Remove the session cookie
    document.cookie = 'preloaderHidden=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
    document.getElementById('preloader').classList.remove('hidden');
}
</script> --}}
</body>

</html>
