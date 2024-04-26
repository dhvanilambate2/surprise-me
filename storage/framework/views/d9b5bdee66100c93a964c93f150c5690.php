<?php 
$setting = App\Models\SiteSettng::findOrFail('1'); 
?>
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
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo e(url('frontend')); ?>/assets/img/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo e(url('frontend')); ?>/assets/img/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(url('frontend')); ?>/assets/img/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(url('frontend')); ?>/assets/img/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(url('frontend')); ?>/assets/img/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(url('frontend')); ?>/assets/img/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo e(url('frontend')); ?>/assets/img/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(url('frontend')); ?>/assets/img/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(url('frontend')); ?>/assets/img/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo e(url('frontend')); ?>/assets/img/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(url('frontend')); ?>/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo e(url('frontend')); ?>/assets/img/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(url('frontend')); ?>/assets/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo e(url('frontend')); ?>/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo e(url('frontend')); ?>/assets/img/favicons/ms-icon-144x144.png">
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
    <link rel="stylesheet" href="<?php echo e(url('frontend')); ?>/assets/css/bootstrap.min.css">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="<?php echo e(url('frontend')); ?>/assets/css/fontawesome.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="<?php echo e(url('frontend')); ?>/assets/css/magnific-popup.min.css">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="<?php echo e(url('frontend')); ?>/assets/css/slick.min.css">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(url('frontend')); ?>/assets/css/style.css">
    
    <style>
        .header-top, 
.header-links {
    font-family: var(--para-font);
    background-color: #D4AF37;
}
    </style>

</head>

<body class="">


    <!--[if lte IE 9]>
    	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

    <!--********************************
   		Code Start From Here 
	******************************** -->



    
<!--==============================
    Mobile Menu
  ============================== -->
    <div class="th-menu-wrapper">
        <div class="th-menu-area text-center">
            <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
                <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e($setting->getFirstMediaUrl('header_logo')); ?>" alt="tidal"></a>
            </div>
            <div class="th-mobile-menu">
                <ul>
                
                                        <li class="menu-item-has-children">
                                            <a href="#">Projects</a>
                                            <ul class="sub-menu">
                                                <li><a href="<?php echo e(url('home_for_sale')); ?>">Homes for Sale</a></li>
                                                <li><a href="<?php echo e(url('home_for_rent')); ?>">Homes to Rent</a></li>
                                            </ul>
                                        </li>
                                        
                                        <li class="menu-item-has-children">
                                            <a href="<?php echo e(url('contact')); ?>">Contact Us</a>
                                        </li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
	Header Area
==============================-->
    <header class="th-header header-layout4">
        <div class="header-top">
            <div class="th-container container">
                <div class="social-box">
                    <div class="th-social">
                        <!-- <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a target="_blank" href="https://skype.com/"><i class="fab fa-skype"></i></a>
                        <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky-wrapper">
            <div class="sticky-active">
                <!-- Main Menu Area -->
                <div class="menu-area">
                    <div class="container">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-md-3 col-4">
                                <div class="header-logo">
                                    <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e($setting->getFirstMediaUrl('header_logo')); ?>" alt="tidal"></a>
                                </div>
                            </div>
                            <div class="col-md-9 col-8 d-flex justify-content-end">
                                <nav class="main-menu d-none d-lg-inline-block">
                                    <ul>
                                    
                                        <li class="menu-item-has-children">
                                            <a href="#">Projects</a>
                                            <ul class="sub-menu">
                                                <li><a href="<?php echo e(url('home_for_sale')); ?>">Homes for Sale</a></li>
                                                <li><a href="<?php echo e(url('home_for_rent')); ?>">Homes to Rent</a></li>
                                            </ul>
                                        </li>
                                        
                                        
                                        <li class="menu-item-has-children">
                                            <a href="<?php echo e(url('contact')); ?>">Contact Us</a>
                                        </li>
                                    </ul>
                                </nav>
                                <button type="button" class="th-menu-toggle d-inline-block d-lg-none"><i class="far fa-bars"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

            <?php echo $__env->yieldContent('content'); ?>


<!--==============================
Footer Area
==============================-->
<footer class="footer-wrapper footer-layout4">
    <div class="widget-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="widget footer-widget">
                        <div class="footer-logo">
                            <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e($setting->getFirstMediaUrl('footer_logo')); ?>" alt="Gaia" class="img-fluid w-75"></a>
                        </div>
                        <div class="th-widget-about">
                            <p class="footer-text">Welcome to Gaia, your premier destination for real estate excellence. At Gaia, we redefine the real estate experience, offering a dynamic platform that seamlessly connects buyers, sellers, and renters with their ideal properties.</p>
                            <h6 class="text-theme mb-2">Social Network:</h6>
                            <div class="th-social">
                            <?php if($setting->facebook): ?>
                                <a target="_blank" href="<?php echo e($setting->facebook); ?>"><i class="fab fa-facebook-f"></i></a>
                            <?php endif; ?>
                            <?php if($setting->skype): ?>
                                <a target="_blank" href="<?php echo e($setting->skype); ?>"><i class="fab fa-skype"></i></a>
                            <?php endif; ?>
                            <?php if($setting->twitter): ?>
                                <a target="_blank" href="<?php echo e($setting->twitter); ?>"><i class="fab fa-twitter"></i></a>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 wow fadeInUp d-flex justify-content-between" data-wow-delay="0.2s">
                    <div class="widget widget_nav_menu footer-widget style2">
                        <h3 class="widget_title">Quick Links</h3>
                        <div class="menu-all-pages-container">
                            <div class="list-two-column">
                                <ul class="menu">
                                    <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                                    <li><a href="<?php echo e(url('home_for_sale')); ?>">Home for Sale</a></li>
                                    <li><a href="<?php echo e(url('home_for_rent')); ?>">Home for Rent</a></li>
                                    <li><a href="<?php echo e(url('blog')); ?>">Blogs</a></li>
                                    <li><a href="<?php echo e(url('contact')); ?>">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="widget footer-widget style2">
                        <h3 class="widget_title">Contact Now</h3>
                        <div class="th-widget-contact">
                            <div class="info-box">
                                <div class="info-box_icon">
                                    <i class="fal fa-location-dot"></i>
                                </div>                        
                                <div class="media-body">
                                    <span class="info-box_label">Office Address :</span>
                                    <p class="info-box_text"><?php echo e($setting->address); ?></p>
                                </div>
                            </div>
                            <div class="info-box">
                                <div class="info-box_icon">
                                    <i class="fal fa-phone"></i>
                                </div>
                                <div class="media-body">
                                    <span class="info-box_label">Contact Number : </span>
                                    <a href="tel:+1<?php echo e($setting->phone); ?>" class="info-box_link">+(1) <?php echo e($setting->phone); ?></a>
                                </div>
                            </div>
                            <div class="info-box">
                                <div class="info-box_icon">
                                    <i class="fal fa-envelope"></i>
                                </div>
                                <div class="media-body">
                                    <span class="info-box_label">Email Address :</span>
                                    <a href="mailto:<?php echo e($setting->email); ?>" class="info-box_link"><?php echo e($setting->email); ?></a>
                                </div>
                            </div>
                            <div class="info-box">
                                <div class="info-box_icon">
                                    <i class="fal fa-clock"></i>
                                </div>
                                <div class="media-body">
                                    <span class="info-box_label">Office Hours :</span>
                                    <a href="#" class="info-box_link"><?php echo e($setting->hours); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <p class="copyright-text text-center">Copyright By © <a href="<?php echo e(url('/')); ?>">Gaia</a> - 2023</p>
        </div>
    </div>
</footer>



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
<script src="<?php echo e(url('frontend')); ?>/assets/js/vendor/jquery-3.6.0.min.js"></script>
<!-- Slick Slider -->
<script src="<?php echo e(url('frontend')); ?>/assets/js/slick.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo e(url('frontend')); ?>/assets/js/bootstrap.min.js"></script>
<!-- Magnific Popup -->
<script src="<?php echo e(url('frontend')); ?>/assets/js/jquery.magnific-popup.min.js"></script>
<!-- Counter Up -->
<script src="<?php echo e(url('frontend')); ?>/assets/js/jquery.counterup.min.js"></script>
<!-- Wow Animation -->
<script src="<?php echo e(url('frontend')); ?>/assets/js/wow.min.js"></script>
<!-- Main Js File -->
<script src="<?php echo e(url('frontend')); ?>/assets/js/main.js"></script>
<!-- Sweet alert-->
<script src="<?php echo e(route('/')); ?>/assets/js/sweet-alert/sweetalert.min.js"></script>
<script>
var SweetAlert_custom = {
    init: function() {
        <?php if(session('success')): ?>
            swal("Success", "<?php echo e(session('success')); ?>", "success")
        <?php endif; ?>

        <?php if(session('error')): ?>
            swal("Error", "<?php echo e(session('error')); ?>", "error")
        <?php endif; ?>

    }
};
(function($) {
    SweetAlert_custom.init()
})(jQuery);
</script>
<!-- Sweet alert-->


</body>

</html>
<?php /**PATH C:\laragon\www\stage\resources\views/frontend/layout/app.blade.php ENDPATH**/ ?>