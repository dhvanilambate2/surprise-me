<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Gaia admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
      <meta name="keywords" content="admin template, Gaia admin template, dashboard template, flat admin template, responsive admin template, web app (Laravel 8)">
      <meta name="author" content="pixelstrap">
      {{-- <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon"> --}}
      <link rel="apple-touch-icon" sizes="57x57" href="{{route('/')}}/assets/images/favicon/apple-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="60x60" href="{{route('/')}}/assets/images/favicon/apple-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="72x72" href="{{route('/')}}/assets/images/favicon/apple-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="76x76" href="{{route('/')}}/assets/images/favicon/apple-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="114x114" href="{{route('/')}}/assets/images/favicon/apple-icon-114x114.png">
      <link rel="apple-touch-icon" sizes="120x120" href="{{route('/')}}/assets/images/favicon/apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="{{route('/')}}/assets/images/favicon/apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="{{route('/')}}/assets/images/favicon/apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="{{route('/')}}/assets/images/favicon/apple-icon-180x180.png">
      <link rel="icon" type="image/png" sizes="192x192" href="{{route('/')}}/assets/images/favicon/android-icon-192x192.png">
      <link rel="icon" type="image/png" sizes="32x32" href="{{route('/')}}/assets/images/favicon/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="{{route('/')}}/assets/images/favicon/favicon-96x96.png">
      <link rel="icon" type="image/png" sizes="16x16" href="{{route('/')}}/assets/images/favicon/favicon-16x16.png">
      <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
      <title>Surprise Me - @yield('title')</title>
      @include('layouts.app.css')
      @yield('style')
   </head>
   <body>
      <!-- Loader starts-->
      {{-- <div class="loader-wrapper">
         <div class="typewriter">
            <h1>New Era Admin Loading..</h1>
         </div>
      </div> --}}
      <!-- Loader ends-->
      <!-- page-wrapper Start-->
      <div class="page-wrapper">
           @yield('content')
      </div>
      @include('layouts.app.script')
   </body>
</html>
