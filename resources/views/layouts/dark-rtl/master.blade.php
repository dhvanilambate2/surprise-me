<!DOCTYPE html>
<html lang="en" dir="rtl">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Gaia admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
      <meta name="keywords" content="admin template, Gaia admin template, dashboard template, flat admin template, responsive admin template, web app">
      <meta name="author" content="pixelstrap">
      <link rel="icon" href="{{route('/')}}/assets/images/favicon.png" type="image/x-icon">
      <link rel="shortcut icon" href="{{route('/')}}/assets/images/favicon.png" type="image/x-icon">
      <title>Gaia - @yield('title')</title>
      @include('layouts.dark-rtl.css')
      @yield('style')      
   </head>
   <body class="dark-only" main-theme-layout="rtl">
      <!-- Loader starts-->
      <div class="loader-wrapper">
         <div class="typewriter">
            <h1>New Era Admin Loading..</h1>
         </div>
      </div>
      <!-- Loader ends-->
      <!-- page-wrapper Start-->
      <div class="page-wrapper">
         <!-- Page Header Start-->
         @include('layouts.dark-rtl.header')
         <!-- Page Header Ends  -->
         <!-- Page Body Start-->
         <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('layouts.dark-rtl.sidebar')
            <!-- Page Sidebar Ends-->
            <!-- Right sidebar Start-->
            @include('layouts.dark-rtl.chat_sidebar')
            <!-- Right sidebar Ends-->
            <div class="page-body">
               <div class="container-fluid">
                  <div class="page-header">
                     <div class="row">
                        <div class="col-lg-6 main-header">
                           @yield('breadcrumb-title')                           
                           <h6 class="mb-0">admin panel</h6>
                        </div>
                        <div class="col-lg-6 breadcrumb-right">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="../ltr/index.html"><i class="pe-7s-home"></i></a></li>
                              @yield('breadcrumb-items')                              
                           </ol>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Container-fluid starts-->
               @yield('content')
               <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            @include('layouts.dark-rtl.footer')            
         </div>
      </div>
      @include('layouts.dark-rtl.script')       
   </body>
</html>