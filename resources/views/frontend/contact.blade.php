@extends('frontend.layouts.app')
@section('content')
<!-- Start of breadcrumb section -->
	<section id="bi-breadcrumbs" class="bi-bredcrumbs-section position-relative" data-background="{{ asset('assets/surpriseme/contact/contact-bg.jpg') }}">
		<div class="background_overlay"></div>
		<div class="container">
			<div class="bi-breadcrumbs-content headline ul-li text-center">
				<h2>Contact</h2>
				<ul>
					<li><a href="#">Home</a></li>
					<li>Contact</li>
				</ul>
			</div>
		</div>
	</section>	
<!-- Start of breadcrumb section-->

<!-- Start of contact info section -->
	<section id="bi-contact-info" class="bi-contact-info-section inner-page-padding">
		<div class="container">
			<div class="bi-contact-info-content">
				<div class="row justify-content-center">
					<div class="col-lg-4 col-md-6">
						<div class="bi-contact-info-item position-relative">
							<span class="info-bg position-absolute" data-background="{{ asset('assets/surpriseme/contact/part1.png') }}"></span>
							<div class="inner-icon d-flex justify-content-center align-items-center">
								<img src="assets/img/icon/ci2.png" alt="">
							</div>
							<div class="inner-text headline pera-content">
								<h3>Email Address</h3>
								<a href="#">info@themexriver.com</a>
								<a href="#">support@themexriver.com</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="bi-contact-info-item position-relative">
							<span class="info-bg position-absolute" data-background="{{ asset('assets/surpriseme/contact/part1.png') }}"></span>
							<div class="inner-icon d-flex justify-content-center align-items-center">
								<img src="assets/img/icon/ci1.png" alt="">
							</div>
							<div class="inner-text headline pera-content">
								<h3>Phone Number</h3>
								<a href="#">+12 48875 6365 699</a>
								<a href="#">+24 58796 5456 0076</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="bi-contact-info-item position-relative">
							<span class="info-bg position-absolute" data-background="{{ asset('assets/surpriseme/contact/part1.png') }}"></span>
							<div class="inner-icon d-flex justify-content-center align-items-center">
								<img src="assets/img/icon/ci3.png" alt="">
							</div>
							<div class="inner-text headline pera-content">
								<h3>Location / Address</h3>
								<a href="#">The Queen’s Walk, Bishop’s,</a>
								<a href="#"> London SE1 7PB, United Kingdom.</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>	
<!-- End of contact info section -->

<!-- Start of contact Form section -->
	<section id="bi-contact-form" class="bi-contact-form-section">
		<div class="bi-contact-map">
			<div class="bi-contact-map-content d-flex flex-wrap">
				<div class="google-map">
					<iframe
					width="850"
					height="835"
					frameborder="0"
					style="border:0"
					src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3055679.938791722!2d-118.69192057451524!3d34.02073045604696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c75ddc27da13%3A0xe9cf4e3f61be365!2sLos%20Angeles%2C%20CA%2C%20USA!5e0!3m2!1sen!2sin!4v1625541262480!5m2!1sen!2sin">
				</iframe>
			</div>
			<div class="bi-team-details-contact-info headline pera-content">
				<div class="bi-team-details-contact-title">
					<div class="bi-section-title-1 headline pera-content">
						<div class="bi-subtitle text-uppercase wow fadeInRight"  data-wow-delay="200ms" data-wow-duration="1000ms">
							Welcome Creative Agency
						</div>
						<h2 class="headline-title">
							Keep In Touch
						</h2>
					</div>
					<p>In nec libero luctus, aliquet turpis at, vehicula nisi. Cras eget mauris in nisl tempus lobortis.</p>
					<div class="bi-team-details-contact-form">
						<form action="sendmail.php" method="post">
							<div class="row">
								<div class="col-md-6">
									<input type="text" name="name" placeholder="First Name">
								</div>
								<div class="col-md-6">
									<input type="text" name="Email" placeholder="Email">
								</div>
								<div class="col-md-6">
									<input type="text" name="phone" placeholder="Phone No.">
								</div>
								<div class="col-md-6">
									<input type="text" name="subject" placeholder="Subject">
								</div>
								<div class="col-md-12">
									<textarea name="message" placeholder="Your Message"></textarea>
								</div>
								<div class="col-md-12">
									<div class="bi-submit-btn">
										<button type="submit">Send messages</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>		
<!-- End of  contact Form section -->	
@endsection