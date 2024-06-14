<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Surprise Me</title>
	<meta name="description" content="Surpriseme-Home Page">
	<meta name="keywords" content="surprise me">
	<!--<link rel="shortcut icon" href="<?php echo e(asset('assets/img/logo/f-icon.png')); ?>" type="image/x-icon">-->
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/fontawesome.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/animate.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/global.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/swiper.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/magnific-popup.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>">
</head>
<body class="<?php if(!Request::is('category') && !Request::is('contact') && !Request::is('about') && !Request::is('product-listing')): ?> home-2 <?php endif; ?>">
	<div id="preloader"></div>
	<div class="up">
		<a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
	</div>
	<div class="cursor"></div>
	 <?php echo $__env->make('frontend.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	 
	 <?php echo $__env->yieldContent('content'); ?>
	 
	 <?php echo $__env->make('frontend.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<!-- For Js Library -->
	<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/swiper-bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/appear.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/gsap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/knob.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.magnific-popup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/parallax.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/ScrollTrigger.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/ScrollToPlugin.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/ScrollSmoother.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/SplitText.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.filterizr.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/imagesloaded.pkgd.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/hover-revel.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/split-type.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/parallax-scroll.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.marquee.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/wow.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.meanmenu.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/tilt.jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/matter.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/script.js')); ?>"></script>
</body>
</html>			<?php /**PATH F:\raj\surprise_me\resources\views/frontend/layouts/app.blade.php ENDPATH**/ ?>