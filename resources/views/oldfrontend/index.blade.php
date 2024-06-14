@extends('frontend.layout.app')

@section('content')
@php 
$setting = App\Models\SiteSettng::findOrFail('1'); 
@endphp
   

 <!--==============================
     Preloader
  ==============================-->
    <div class="preloader" id="preloader">
        <button class="th-btn style3 preloaderCls">Cancel Preloader </button>
        <div class="preloader-inner">
            <span class="loader" style="width: 250px !important;"><img src="{{ $setting->getFirstMediaUrl('loader_image') }}" class="img-fluid"></span>
        </div>
    </div>
    <div class="th-cursor"></div>
<!--==============================
Hero Area
==============================-->

<div class="th-hero-wrapper hero-4 mw-100">
    <div class="hero-slider-4 th-carousel" id="heroSlide4" data-fade="false" data-slide-show="1">
        <div>
            <div class="th-hero-slide">
                <div class="th-hero-bg" data-bg-src="{{ url('frontend') }}/assets/img/bg/hero_bg_4_1.jpeg" data-overlay="black" data-opacity="6"></div>
                <div class="container">
                    <div class="hero-style4">
                        <!-- <span class="h4 hero-subtitle" data-ani="slideinup" data-ani-delay="0.1s">Find Your Perfect Space</span> -->
                        <h1 class="hero-title" data-ani="slideinup" data-ani-delay="0.3s">Find Your </h1>
                        <h1 class="hero-title" data-ani="slideinup" data-ani-delay="0.5s">Perfect</h1>
                        <h1 class="hero-title pb-3" data-ani="slideinup" data-ani-delay="0.5s">Space</h1>
                        <a href="{{ url('projects') }}" class="th-btn" data-ani="slideinup" data-ani-delay="0.7s"><span class="line left"></span> View Projects <span class="line"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="th-hero-slide">
                <div class="th-hero-bg" data-bg-src="{{ url('frontend') }}/assets/img/bg/hero_bg_4_2.jpeg" data-overlay="black" data-opacity="6"></div>
                <div class="container">
                    <div class="hero-style4">
                        <!-- <span class="h4 hero-subtitle" data-ani="slideinup" data-ani-delay="0.1s">DESIGN IS MAKING SENSE OF THINGS.</span> -->
                        <h1 class="hero-title" data-ani="slideinup" data-ani-delay="0.3s">Discover</h1>
                        <h1 class="hero-title" data-ani="slideinup" data-ani-delay="0.5s">Distinctive</h1>
                        <h1 class="hero-title pb-3" data-ani="slideinup" data-ani-delay="0.5s">Residences</h1>
                        <a href="{{ url('projects') }}" class="th-btn" data-ani="slideinup" data-ani-delay="0.7s"><span class="line left"></span> View Projects <span class="line"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div>
                <div class="th-hero-slide">
                    <div class="th-hero-bg" data-bg-src="{{ url('frontend') }}/assets/img/bg/hero_bg_4_3.jpg" data-overlay="black" data-opacity="6"></div>
                    <div class="container">
                        <div class="hero-style4">
                            <span class="h4 hero-subtitle" data-ani="slideinup" data-ani-delay="0.1s">DESIGN IS MAKING SENSE OF THINGS.</span>
                            <h1 class="hero-title" data-ani="slideinup" data-ani-delay="0.3s">Architecture</h1>
                            <h1 class="hero-title" data-ani="slideinup" data-ani-delay="0.5s">With Different</h1>
                            <h1 class="hero-title text-transparent" data-ani="slideinup" data-ani-delay="0.5s">Approach</h1>
                            <a href="project.html" class="th-btn" data-ani="slideinup" data-ani-delay="0.7s"><span class="line left"></span> View Projects <span class="line"></span></a>
                        </div>
                    </div>
                </div>
            </div> -->
    </div>
    <div class="icon-box">
        <button data-slick-prev="#heroSlide4" class="slick-arrow default cursor-btn"><i class="fal fa-long-arrow-left"></i></button>
        <button data-slick-next="#heroSlide4" class="slick-arrow default cursor-btn"><i class="fal fa-long-arrow-right"></i></button>
    </div>
</div>
<!--======== / Hero Section ========-->

<!--==============================
About Area  
==============================-->

<div class="space" id="about-sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 mb-5 mb-xl-0 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="img-box1">
                    <div class="img1">
                        <img src="{{ url('frontend') }}/assets/img/home/about.png" alt="About">
                    </div>
                </div>
            </div>
            <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                <!-- <p class="sub-title">Eraclis Papachristou Architectural Office</p> -->
                <h2 class="sec-title mb-40">About <span class="text-transparent">Gaia</span></h2>
                <p class="mb-30">Welcome to Gaia, your premier destination for real estate excellence. At Gaia, we redefine the real estate experience, offering a dynamic platform that seamlessly connects buyers, sellers, and renters with their ideal properties. Our commitment to innovation, transparency, and personalized service ensures that navigating the real estate landscape becomes not only efficient but also enjoyable. Dive into a world of possibilities with Gaia, where your property journey is guided by expertise, trust, and a commitment to exceeding expectations.</p>
                <!--<a href="{{ url('/') }}" class="th-btn"><span class="line left"></span> Why Us <span class="line"></span></a>-->
            </div>
        </div>
    </div>
    <div class="shape-mockup jump" data-top="0" data-right="0"><img src="{{ url('frontend') }}/assets/img/shape/shape_3.png" alt="shape"></div>
</div>


<!--==============================
Feature Area  
==============================-->
<section class="space-bottom">
    <div class="container">
        <div class="row gy-4">
            <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="feature-card">
                    <div class="feature-card_icon shape-icon">
                        <img class="svg-img" src="{{ url('frontend') }}/assets/img/icon/feature_card_1.svg" alt="icon">
                    </div>
                    <h3 class="feature-card_title">Competitive Pricings</h3>
                    <p class="feature-card_text">Experience the advantage of competitive pricing as we offer you exceptional value in the real estate market, ensuring affordability without compromising on quality and features.</p>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="feature-card">
                    <div class="feature-card_icon shape-icon">
                        <img class="svg-img" src="{{ url('frontend') }}/assets/img/icon/feature_card_2.svg" alt="icon">
                    </div>
                    <h3 class="feature-card_title">Luxury Home Customization</h3>
                    <p class="feature-card_text">Immerse yourself in opulence with our luxury home customization service, meticulously tailored to transform your residence into a bespoke haven of elegance and comfort. <br>&nbsp;</p>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                <div class="feature-card">
                    <div class="feature-card_icon shape-icon">
                        <img class="svg-img" src="{{ url('frontend') }}/assets/img/icon/feature_card_3.svg" alt="icon">
                    </div>
                    <h3 class="feature-card_title">Skilled Property Management</h3>
                    <p class="feature-card_text">Experience peace of mind with our skilled property management services, where expert oversight and strategic solutions ensure the seamless operation and optimization of your real estate investments.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!--==============================
Project Area  
==============================-->
<section class="space-bottom overflow-hidden">
    <div class="container">
        <div class="row justify-content-md-between align-items-end">
            <div class="col-md-8 wow fadeInUp" data-wow-delay="0.2s">
                <div class="title-area">
                    <h2 class="sec-title">Current
                        <span class="text-transparent">projects</span>
                    </h2>
                </div>
            </div>
            <div class="col-auto mt-n4 mt-lg-0 wow fadeInUp" data-wow-delay="0.3s">
                <div class="sec-btn">
                    <a href="{{ url('projects') }}" class="link-btn">View The Projects</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container th-container3">
        <div class="project-slide-wrap">
            <div class="row" id="projectSlide3">
                @php
                    $count = 01;
                @endphp
                @foreach($home_details as $home_detail)
                <div class="col-lg-6">
                    <div class="project-card">
                        <div class="project-img">
                        @if($home_detail->getFirstMediaUrl('images'))
                            @if($home_detail->home_for == 'rent')
                                <a href="{{ route('home_for_rent.details', ['id' => $home_detail->id]) }}">
                                    <img src="{{ $home_detail->getFirstMediaUrl('images') }}" alt="project image" style="height:410px !important; width:100%">
                                </a>
                            @else 
                                <a href="{{ route('home_for_sale.details', ['id' => $home_detail->id]) }}">
                                    <img src="{{ $home_detail->getFirstMediaUrl('images') }}" alt="project image" style="height:410px !important; width:100%">
                                </a>
                            @endif
                            
                        @endif
                        </div>
                        {{-- {{dd($home_detail->status);}} --}}
                        @if($home_detail->home_for == 'rent')
                            <h3 class="h5 project-title"><a href="{{ route('home_for_rent.details', ['id' => $home_detail->id]) }}">{{ $home_detail->property_name }}</a></h3>
                        @else 
                            <h3 class="h5 project-title"><a href="{{ route('home_for_sale.details', ['id' => $home_detail->id]) }}">{{ $home_detail->property_name }}</a></h3>
                        @endif
                        <p class="project-map"><i class="fal fa-location-dot"></i>{{ $home_detail->address }}</p>
                        @if ($count > 9)
                            <div class="project-number">{{ $count }}</div>
                        @else
                            <div class="project-number">0{{ $count }}</div>
                        @endif
                    </div>
                </div>
                    @php
                        $count++
                    @endphp
                @endforeach
                
            </div>
            <div class="slider-nav-wrap">
                <div class="slider-nav">
                    <button data-slick-prev="#projectSlide3" class="nav-btn"><i class="fal fa-long-arrow-left"></i></button>
                    <div class="custom-dots"></div>
                    <button data-slick-next="#projectSlide3" class="nav-btn"><i class="fal fa-long-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</section><!--==============================
Counter Area  
==============================-->


<!-- <section class=" ">
        <div class="container">
            <div class="video-counter">
                <div class="th-video">
                    <img src="{{ url('frontend') }}/assets/img/normal/video_1.jpg" alt="video">
                    <a href="https://www.youtube.com/watch?v=_sI_Ps7JSEk" class="play-btn style2 popup-video"><i class="fas fa-play"></i></a>
                </div>
                <div class="counter-card-video">
                    <h2 class="sec-title mb-4 wow fadeInUp" data-wow-delay="0.2s">Simplicity Is The <span class="text-transparent">Ultimate</span></h2>
                    <div class="counter-card-wrap">
                        <div class="counter-card wow fadeInUp" data-wow-delay="0.2s">
                            <h3 class="counter-card_number"><span class="counter-number">600</span></h3>
                            <p class="counter-card_text">Projects</p>
                        </div>
                        <div class="counter-card wow fadeInUp" data-wow-delay="0.3s">
                            <h3 class="counter-card_number"><span class="counter-number">60</span></h3>
                            <p class="counter-card_text">Employees</p>
                        </div>
                        <div class="counter-card wow fadeInUp" data-wow-delay="0.4s">
                            <h3 class="counter-card_number"><span class="counter-number">200</span></h3>
                            <p class="counter-card_text">Conractors</p>
                        </div>
                        <div class="counter-card wow fadeInUp" data-wow-delay="0.5s">
                            <h3 class="counter-card_number"><span class="counter-number">10000</span></h3>
                            <p class="counter-card_text">More Then Publications in The World Press</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> -->

<!--==============================
Service Area  
==============================-->


<!-- <section class="overflow-hidden space">
        <div class="container">
            <div class="row justify-content-lg-between align-items-end">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="title-area">
                        <h2 class="sec-title">High-quality architectural
                            <span class="text-transparent">services</span>
                        </h2>
                    </div>
                </div>
                <div class="col-auto mt-n4 mt-lg-0 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="sec-btn">
                        <a href="service.html" class="link-btn">View all Services</a>
                    </div>
                </div>
            </div>
            <div class="service-grid-area">
                <div class="service-list-slide">
                    <button data-slick-prev="#sr-list" class="slick-btn top"><i class="fal fa-chevron-up"></i></button>
                    <div class="th-carousel" id="sr-list" data-slide-show="4" data-lg-slide-show="4" data-md-slide-show="4" data-sm-slide-show="4" data-xs-slide-show="4" data-vertical="true" data-verticalSwiping="true" data-asnavfor="#sr-grid, #sr-img">
                        <div>
                            <div class="service-list">
                                <span class="service-list_number">01</span>
                                <h4 class="service-list_title">Architecture</h4>
                            </div>
                        </div>
                        <div>
                            <div class="service-list">
                                <span class="service-list_number">02</span>
                                <h4 class="service-list_title">Interior Design</h4>
                            </div>
                        </div>
                        <div>
                            <div class="service-list">
                                <span class="service-list_number">03</span>
                                <h4 class="service-list_title">Urban Interventions</h4>
                            </div>
                        </div>
                        <div>
                            <div class="service-list">
                                <span class="service-list_number">04</span>
                                <h4 class="service-list_title">Landscape Design</h4>
                            </div>
                        </div>
                        <div>
                            <div class="service-list">
                                <span class="service-list_number">05</span>
                                <h4 class="service-list_title">Interdisciple Entity</h4>
                            </div>
                        </div>
                    </div>
                    <button data-slick-next="#sr-list" class="slick-btn bottom"><i class="fal fa-chevron-down"></i></button>
                </div>
                <div class="service-grid-slide">
                    <div class="th-carousel" id="sr-grid" data-slide-show="1" data-md-slide-show="1" data-asnavfor="#sr-list, #sr-img">
                        <div>
                            <div class="service-card style2">
                                <div class="service-card_icon">
                                    <img class="svg-img" src="{{ url('frontend') }}/assets/img/icon/service_1_1.svg" alt="service image">
                                </div>
                                <p class="service-card_num text-transparent">01</p>
                                <h3 class="service-card_title">Architecture</h3>
                                <p class="service-card_text">We see architecture as the composition of all elements that define a particular space and inform the character of a building.</p>
                                <a href="service-details.html" class="link-btn">View Details</a>
                            </div>
                        </div>
                        <div>
                            <div class="service-card style2">
                                <div class="service-card_icon">
                                    <img class="svg-img" src="{{ url('frontend') }}/assets/img/icon/service_1_2.svg" alt="service image">
                                </div>
                                <p class="service-card_num text-transparent">02</p>
                                <h3 class="service-card_title">Interior Design</h3>
                                <p class="service-card_text">In Order architecture as the composition of all elements that define a particular space and inform the character of a interior.</p>
                                <a href="service-details.html" class="link-btn">View Details</a>
                            </div>
                        </div>
                        <div>
                            <div class="service-card style2">
                                <div class="service-card_icon">
                                    <img class="svg-img" src="{{ url('frontend') }}/assets/img/icon/service_1_3.svg" alt="service image">
                                </div>
                                <p class="service-card_num text-transparent">03</p>
                                <h3 class="service-card_title">Urban Interventions</h3>
                                <p class="service-card_text">The Urban architecture as the composition of all elements that define a particular space and inform the character of into.</p>
                                <a href="service-details.html" class="link-btn">View Details</a>
                            </div>
                        </div>
                        <div>
                            <div class="service-card style2">
                                <div class="service-card_icon">
                                    <img class="svg-img" src="{{ url('frontend') }}/assets/img/icon/service_1_4.svg" alt="service image">
                                </div>
                                <p class="service-card_num text-transparent">04</p>
                                <h3 class="service-card_title">Landscape Design</h3>
                                <p class="service-card_text">The Best architecture as composition of all elements that define a particular space and inform the character of a Landscape.</p>
                                <a href="service-details.html" class="link-btn">View Details</a>
                            </div>
                        </div>
                        <div>
                            <div class="service-card style2">
                                <div class="service-card_icon">
                                    <img class="svg-img" src="{{ url('frontend') }}/assets/img/icon/service_1_5.svg" alt="service image">
                                </div>
                                <p class="service-card_num text-transparent">05</p>
                                <h3 class="service-card_title">Interdisciple Entity</h3>
                                <p class="service-card_text">You see architecture as the composition of all elements that define a particular space and inform the character of a Gowring.</p>
                                <a href="service-details.html" class="link-btn">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="service-grid-img">
                    <div class="th-carousel" id="sr-img" data-slide-show="1" data-md-slide-show="1" data-asnavfor="#sr-grid, #sr-list">
                        <div>
                            <div class="img">
                                <img src="{{ url('frontend') }}/assets/img/service/service_1_1.jpg" alt="service Image">
                            </div>
                        </div>
                        <div>
                            <div class="img">
                                <img src="{{ url('frontend') }}/assets/img/service/service_1_2.jpg" alt="service Image">
                            </div>
                        </div>
                        <div>
                            <div class="img">
                                <img src="{{ url('frontend') }}/assets/img/service/service_1_3.jpg" alt="service Image">
                            </div>
                        </div>
                        <div>
                            <div class="img">
                                <img src="{{ url('frontend') }}/assets/img/service/service_1_4.jpg" alt="service Image">
                            </div>
                        </div>
                        <div>
                            <div class="img">
                                <img src="{{ url('frontend') }}/assets/img/service/service_1_5.jpg" alt="service Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->



<!--==============================
Team Area  
==============================-->
@if($team_section->status == 1)

<section class="space-bottom">
    <div class="container">
        <div class="row justify-content-md-between align-items-end">
            <div class="col-md-8 wow fadeInUp" data-wow-delay="0.2s">
                <div class="title-area">
                    <h2 class="sec-title">Meet Our 
                        <span class="text-transparent">Team</span>
                    </h2>
                </div>
            </div>
            <div class="col-auto mt-n4 mt-lg-0 wow fadeInUp" data-wow-delay="0.3s">
                <div class="sec-btn">
                    <a href="{{ url('teams') }}" class="link-btn">Show More</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row th-carousel" data-slide-show="4" data-lg-slide-show="3" data-md-slide-show="2">
            <!-- Single Item -->
            
            @foreach($teams as $index => $team)
                @if($index < 4)
                    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-card  ">
                            <p class="team-desig">{{ $team->post }}</p>
                            <h3 class="h5 team-title"><a href="{{ route('team.details', ['id' => $team->id]) }}">{{ $team->name }}</a></h3>
                            <div class="th-social">
                                @if($team->facebook)
                                    <a target="_blank" href="{{$team->facebook}}"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if($team->skype)
                                    <a target="_blank" href="{{$team->skype}}"><i class="fab fa-skype"></i></a>
                                @endif
                                @if($team->twitter)
                                    <a target="_blank" href="{{$team->twitter}}"><i class="fab fa-twitter"></i></a>
                                @endif
                            </div>
                            <div class="team-img">
                                <img src="{{ $team->getFirstMediaUrl('teams') }}" alt="Team">
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif

<!--==============================
Testimonial Area  
==============================-->
@if($review_section->status == 1)
<div class="space-bottom ">
    <div class="container">
        <h2 class="sec-title text-center wow fadeInUp" data-wow-delay="0.2s">Client <span class="text-transparent">Reviews</span></h2>
        <div class="row testi-box-slide th-carousel" data-slide-show="2" data-md-slide-show="1">
            @foreach($reviews as $item)
            <div class="col-lg-6">
                <div class="testi-box">
                    <p class="testi-box_text">{!! $item->description !!}</p>
                    <div class="testi-box_profile">
                        <div class="testi-box_img">
                            <img src="{{ $item->getFirstMediaUrl('reviews') }}" alt="Avater">
                        </div>
                        <div class="testi-box_info">
                            <h3 class="testi-box_name">{{ $item->name }}</h3>
                            <span class="testi-box_desig">{{ $item->post }}</span>
                        </div>
                    </div>
                    <div class="testi-box_icon">
                        <img src="{{ $item->getFirstMediaUrl('reviews') }}" alt="icon">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif


<section class="space-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 mb-40 mb-xl-0 wow fadeInUp" data-wow-delay="0.<br />
<b>Warning</b>:  Undefined variable $x in <b>D:\angfuzsoft\html\artra-html\build\inc\sections\contact-sec-v1.php</b> on line <b>4</b><br />
2s">
                <div class="img-box5">
                    <div class="img1">
                        <img src="{{ url('frontend') }}/assets/img/home/contact.png" alt="contact">
                    </div>
                    <div class="info-card-wrap">
                        <div class="info-card">
                            <div class="info-card_icon">
                                <i class="fal fa-phone"></i>
                            </div>
                            <div class="info-card_content">
                                <span class="info-card_text">CALL US:</span>
                                <a href="tel:+12345678900" class="info-card_link text-nowrap">(+1) {{ $setting->phone}}</a>
                            </div>
                        </div>
                        <div class="info-card">
                            <div class="info-card_icon">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="info-card_content">
                                <span class="info-card_text">EMAIL US:</span>
                                <a href="mailto:info@gaiahomesfl.com" class="info-card_link text-nowrap fs-5">{{ $setting->email }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.2s">
                <h2 class="sec-title">Need assistance? <br>
                    Drop us a <span class="text-transparent">Message</span> anytime.
                </h2>
                <form class="needs-validation" novalidate action="{{ route('contact.store') }}" method="POST" class="contact-form">
                @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <input type="text" class="form-control" name="name" id="name" maxlength="50" placeholder="Your Name" value="{{ old('name') }}" required>
                            <input type="hidden" class="form-control" name="hid" id="hid" value="0" required>
                            <input type="hidden" class="form-control" name="home_mode" id="home_mode" value="contact" required>
                           <div class="invalid-feedback">
                                Please Enter your Name.
                              </div>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="number" class="form-control" name="number" id="number" placeholder="Your Number" value="{{ old('number') }}" required>
                            <div class="invalid-feedback">
                                Please Enter Number.
                             </div>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="subject" id="subject" maxlength="200" placeholder="Subject" value="{{ old('subject') }}" required>
                            <div class="invalid-feedback">
                                Please Enter Subject.
                             </div> 
                        </div>
                        <div class="form-group col-12">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" maxlength="200" value="{{ old('email') }}" required>
                            <div class="invalid-feedback">
                                Please Enter Email.
                             </div>
                        </div>
                        <div class="form-group col-12">
                            <textarea name="message" id="message" cols="30" rows="3" class="form-control" placeholder="Message" required>{{ old('message') }}</textarea>
                            <div class="invalid-feedback">
                                Please Enter Message.
                             </div
                        </div>
                        <div class="form-btn col-12 mt-10">
                            <button type="submit" class="th-btn"><span class="line left"></span> Send Message <span class="line"></span></button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="shape-mockup jump" data-top="0" data-right="0"><img src="{{ url('frontend') }}/assets/img/shape/shape_3.png" alt="shape"></div>
</section>





<!--==============================
Blog Area  
==============================-->

<!-- <section class="space">
        <div class="container">
            <div class="row justify-content-md-between align-items-end">
                <div class="col-md-8 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="title-area">
                        <h2 class="sec-title">Our Latest
                            <span class="text-transparent">Blogs</span>
                        </h2>
                    </div>
                </div>
                <div class="col-auto mt-n4 mt-lg-0 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="sec-btn">
                        <a href="blog.html" class="link-btn">View The Blogs</a>
                    </div>
                </div>
            </div>
            <div class="row th-carousel" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="1">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="blog-grid">
                        <div class="blog-img">
                            <img src="{{ url('frontend') }}/assets/img/blog/blog_3_1.jpg" alt="blog image">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta style2">
                                <a href="blog.html">Architecture</a>
                                <a href="blog.html">February 15, 2023</a>
                            </div>
                            <p class="blog-text">Morbi condimentum congue dui, elementum maximus augue porttitor a. Quisque volutpat et dui at fringilla. Integer sed justo quis lacus sodales porta. Class aptent taciti sociosqu ad litora torquent per conubia nostra.</p>
                            <a href="blog-details.html" class="link-btn">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="blog-grid">
                        <div class="blog-img">
                            <img src="{{ url('frontend') }}/assets/img/blog/blog_3_2.jpg" alt="blog image">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta style2">
                                <a href="blog.html">Architecture</a>
                                <a href="blog.html">February 16, 2023</a>
                            </div>
                            <p class="blog-text">Morbi condimentum congue dui, elementum maximus augue porttitor a. Quisque volutpat et dui at fringilla. Integer sed justo quis lacus sodales porta. Class aptent taciti sociosqu ad litora torquent per conubia nostra.</p>
                            <a href="blog-details.html" class="link-btn">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="blog-grid">
                        <div class="blog-img">
                            <img src="{{ url('frontend') }}/assets/img/blog/blog_3_3.jpg" alt="blog image">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta style2">
                                <a href="blog.html">Architecture</a>
                                <a href="blog.html">February 17, 2023</a>
                            </div>
                            <p class="blog-text">Morbi condimentum congue dui, elementum maximus augue porttitor a. Quisque volutpat et dui at fringilla. Integer sed justo quis lacus sodales porta. Class aptent taciti sociosqu ad litora torquent per conubia nostra.</p>
                            <a href="blog-details.html" class="link-btn">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="blog-grid">
                        <div class="blog-img">
                            <img src="{{ url('frontend') }}/assets/img/blog/blog_3_4.jpg" alt="blog image">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta style2">
                                <a href="blog.html">Architecture</a>
                                <a href="blog.html">February 18, 2023</a>
                            </div>
                            <p class="blog-text">Morbi condimentum congue dui, elementum maximus augue porttitor a. Quisque volutpat et dui at fringilla. Integer sed justo quis lacus sodales porta. Class aptent taciti sociosqu ad litora torquent per conubia nostra.</p>
                            <a href="blog-details.html" class="link-btn">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    
  


@endsection