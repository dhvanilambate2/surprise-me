<!-- Start of header section-->
	<header id="bi-header" class="bi-header-section header-style-two">
		<div class="bi-header-content">
			<div class="bi-header-logo-main-menu d-flex align-items-center justify-content-between">
				<div class="brand-logo">
					<a href="{{ url('/') }}">
					    <!--<img src="assets/img/logo/logo2.png" alt="">-->
					    Surprise Me
					</a>
				</div>
				<div class="bi-header-main-navigation">
					<nav class="main-navigation clearfix ul-li">
						<ul id="main-nav" class="nav navbar-nav clearfix">
							<li>
								<a href="{{ url('/') }}">Home</a>
							</li>
							<li><a href="{{ route('about') }}">About</a></li>
							<li>
								<a href="{{ route('category') }}">Category</a>
							
							</li>
							<li><a href="{{ route('vendor') }}">Vendor</a></li>
							<li class="dropdown">
								<a href="{{ route('product-listing') }}">Product Listing</a>
								<!--<ul class="dropdown-menu clearfix">-->
								<!--	<li><a href="service.html" target="_blank">Product Listing</a></li>-->
								<!--	<li class="dropdown">-->
								<!--		<a href="service-single.html">Product Listing</a>-->
								<!--		<ul class="dropdown-menu clearfix">-->
								<!--			<li><a href="service-single.html" target="_blank">Brand & Art</a></li>-->
								<!--			<li><a href="service-single.html" target="_blank">Digital Marketing</a></li>-->
								<!--			<li><a href="service-single.html" target="_blank">Web Development</a></li>-->
								<!--			<li><a href="service-single.html" target="_blank">Design & Development</a></li>-->
								<!--			<li><a href="service-single.html" target="_blank">3D Animation</a></li>-->
								<!--			<li><a href="service-single.html" target="_blank">Branding & Ilastration</a></li>-->
								<!--		</ul>-->
								<!--	</li>-->
								<!--</ul>-->
							</li>
							<li><a href="{{ route('contact') }}">Contact</a></li>
						</ul>
					</nav>
				</div>
				<div class="bi-header-cta-btn-grp d-flex align-items-center">
					<!--<div class="bi-header-search">-->
					<!--	<button class="search-btn"><i class="far fa-search"></i></button>-->
					<!--</div>-->
					<!--<div class="cta-btn-info d-flex align-items-center">-->
					<!--	<div class="inner-icon d-flex justify-content-center align-items-center">-->
					<!--		<i class="fas fa-phone"></i>-->
					<!--	</div>-->
					<!--	<div class="inner-text">-->
					<!--		<span>Give us a call</span>-->
					<!--		<a href="#">+92 123 456 7890</a>-->
					<!--	</div>-->
					<!--</div>-->
					<div class="cta-btn-area">
						<div class="bi-btn-2  bi-btn-area text-uppercase">
							<a class="bi-btn-main  bi-btn-hover bi-btn-item" href="{{ url('contact') }}">  <span></span> Request a Quote</a>
						</div>
					</div>
				</div>
			</div>
			<div class="mobile_menu position-relative">
				<div class="mobile_menu_button open_mobile_menu">
					<i class="fal fa-bars"></i>
				</div>
				<div class="mobile_menu_wrap">
					<div class="mobile_menu_overlay open_mobile_menu"></div>
					<div class="mobile_menu_content">
						<div class="mobile_menu_close open_mobile_menu">
							<i class="fal fa-times"></i>
						</div>
						<div class="m-brand-logo">
							<a href="!#"><img src="{{ asset('assets/img/logo/logo2.png') }}" alt=""></a>
						</div>
						<div class="mobile-search-bar position-relative">
							<form action="#">
								<input type="text" name="search" placeholder="Keywords">
								<button><i class="fal fa-search"></i></button>
							</form>
						</div>
						<nav class="mobile-main-navigation  clearfix ul-li">
							<ul id="m-main-nav" class="nav navbar-nav clearfix">
								<li>
								<a href="{{ url('/') }}">Home</a>
							</li>
							<li><a href="{{ route('about') }}">About</a></li>
							<li>
								<a href="{{ route('category') }}">Category</a>
							
							</li>
							<li><a href="{{ route('vendor') }}">Vendor</a></li>
							<li class="dropdown">
								<a href="{{ route('product-listing') }}">Product Listing</a>
								<ul class="dropdown-menu clearfix">
									<li><a href="#">Product Listing</a></li>
									<!--<li class="dropdown">-->
									<!--	<a href="service-single.html">Product Listing</a>-->
									<!--	<ul class="dropdown-menu clearfix">-->
									<!--		<li><a href="service-single.html" target="_blank">Brand & Art</a></li>-->
									<!--		<li><a href="service-single.html" target="_blank">Digital Marketing</a></li>-->
									<!--		<li><a href="service-single.html" target="_blank">Web Development</a></li>-->
									<!--		<li><a href="service-single.html" target="_blank">Design & Development</a></li>-->
									<!--		<li><a href="service-single.html" target="_blank">3D Animation</a></li>-->
									<!--		<li><a href="service-single.html" target="_blank">Branding & Ilastration</a></li>-->
									<!--	</ul>-->
									<!--</li>-->
								</ul>
							</li>
							<li><a href="{{ route('contact') }}">Contact</a></li>
							</ul>
						</nav>
						<div class="bi-mobile-header-social text-center">
							<a href="#"> <i class="fab fa-instagram"></i></a>
							<a href="#"> <i class="fab fa-linkedin-in"></i></a>
							<a href="#"> <i class="fab fa-facebook"></i></a>
							<a href="#"> <i class="fab fa-youtube"></i></a>
						</div>
					</div>
				</div>
				<!-- /Mobile-Menu -->
			</div>
		</div>
	</header>
	<!-- search filed -->
	<div class="search-body">
		<div class="search-form">
			<form action="#" class="search-form-area">
				<input class="search-input" type="search" placeholder="Search Here">
				<button type="submit" class="search-btn1">
					<i class="fas fa-search"></i>
				</button>	
			</form>
			<div class="outer-close text-center search-btn">
				<i class="far fa-times"></i>
			</div>
		</div>
	</div>
<!-- End of header section-->