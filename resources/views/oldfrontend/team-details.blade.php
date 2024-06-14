@extends('frontend.layout.app')

@section('content')

<!--==============================
    Breadcumb
============================== -->
    <div class="">
        <div class="breadcumb-wrapper mt-4" data-bg-src="{{ url('frontend') }}/assets/img/bg/team-detail.jpeg">
            <h1 class="breadcumb-title">Expert Details</h1>
            <ul class="breadcumb-menu d-none">
                <li><a href="index.html">Home</a></li>
                <li>Expert Details</li>
            </ul>
        </div>
    </div>
    <!--==============================
Team Area  
==============================-->
    <section class="space">
        <div class="container">
            <div class="row mb-40 align-items-center">
                <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="team-details-img">
                        <img class="w-100" src="{{ $team->getFirstMediaUrl('teams') }}" alt="team image">
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-about">
                        <h2 class="h3 team-about_title">{{ $team->name }} <span class="team-about_desig">{{ $team->post }}</span></h2>
                        <div class="social-box">
                            <p class="title">Social Network:</p>
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
                        </div>
                        <p class="mb-25">{!! $team->description !!}</p>
                        {{-- <div class="inner-list mb-40">
                            <ol>
                                <li>Architecture the inila duman aten fermen.</li>
                                <li>The design architecture duiman finibus.</li>
                                <li>Placus udeane sene voice miss cuse aten.</li>
                            </ol>
                        </div> --}}
                        <a href="{{ url('contact') }}" class="th-btn"><span class="line left"></span> Quick Contact <span class="line"></span></a>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-xxl-5 col-xl-6 mb-40 mb-xl-0 wow fadeInUp" data-wow-delay="0.2s">
                    <h5 class="text-theme mb-25">My Skills:</h5>
                    <div class="skill-feature">
                        <p class="skill-feature_title">Architect</p>
                        <div class="progress">
                            <div class="progress-bar" style="width: 80%;">
                                <p class="progress-value">80%</p>
                            </div>
                        </div>
                    </div>
                    <div class="skill-feature">
                        <p class="skill-feature_title">Interior design</p>
                        <div class="progress">
                            <div class="progress-bar" style="width: 70%;">
                                <p class="progress-value">70%</p>
                            </div>
                        </div>
                    </div>
                    <div class="skill-feature">
                        <p class="skill-feature_title">3D Design</p>
                        <div class="progress">
                            <div class="progress-bar" style="width: 60%;">
                                <p class="progress-value">60%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 offset-xxl-1 wow fadeInUp" data-wow-delay="0.3s">
                    <h5 class="mb-25 text-theme">Key Factors:</h5>
                    <div class="inner-list">
                        <ol>
                            <li>Architecture the inila duman aten fermen.</li>
                            <li>The design architecture duiman finibus.</li>
                            <li>Placus udeane sene voice miss cuse aten.</li>
                            <li>Architecture the inila duman aten fermen.</li>
                            <li>The design architecture duiman finibus.</li>
                            <li>Placus udeane sene voice miss cuse aten.</li>
                        </ol>
                    </div>
                </div>
            </div> --}}
    <div class="shape-mockup jump" data-top="0" data-right="0"><img src="{{ url('frontend') }}/assets/img/shape/shape_3.png" alt="shape"></div>

        </div>
    </section><!--==============================
Testimonial Area  
==============================-->
    {{-- <div class="space-bottom">
        <div class="container">
            <div class="testi-card-wrap wow fadeInUp" data-wow-delay="0.2s">
                <div class="row testi-card-slide th-carousel" id="testiSlide2" data-slide-show="1" data-fade="true">
                    <div class="col-12">
                        <div class="testi-card">
                            <div class="testi-card_img">
                                <img src="{{ url('frontend') }}/assets/img/testimonial/testi_2_1.jpg" alt="Avater">
                                <div class="testi-card_icon">
                                    <img src="{{ url('frontend') }}/assets/img/testimonial/testi_icon_2.svg" alt="quote icon">
                                </div>
                            </div>
                            <div class="testi-card_content">
                                <p class="h3 testi-card_text">Each penny at Baroque is completed committed, educated, and supportive. The unimaginably item was delightful, and worth each penny. I would totally suggest educate</p>
                                <h6 class="testi-card_desig">CEO at <span class="text-theme">Just Awesome</span></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="testi-card">
                            <div class="testi-card_img">
                                <img src="{{ url('frontend') }}/assets/img/testimonial/testi_2_2.jpg" alt="Avater">
                                <div class="testi-card_icon">
                                    <img src="{{ url('frontend') }}/assets/img/testimonial/testi_icon_2.svg" alt="quote icon">
                                </div>
                            </div>
                            <div class="testi-card_content">
                                <p class="h3 testi-card_text">Worth each at Baroque is unimaginably committ, educated, and supportive. The completed item was delightful, and worth each penny. I would totally suggest committ</p>
                                <h6 class="testi-card_desig">Director at <span class="text-theme">Kunfango</span></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="testi-card">
                            <div class="testi-card_img">
                                <img src="{{ url('frontend') }}/assets/img/testimonial/testi_2_3.jpg" alt="Avater">
                                <div class="testi-card_icon">
                                    <img src="{{ url('frontend') }}/assets/img/testimonial/testi_icon_2.svg" alt="quote icon">
                                </div>
                            </div>
                            <div class="testi-card_content">
                                <p class="h3 testi-card_text">Educated at Baroque is supportive committed, educated, and unimaginably. The completed item was delightful, and worth each penny. I would totally suggest complete</p>
                                <h6 class="testi-card_desig">Manager at <span class="text-theme">Jangalok</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="icon-box">
                    <button data-slick-prev="#testiSlide2" class="slick-arrow default"><i class="fat fa-long-arrow-left"></i></button>
                    <button data-slick-next="#testiSlide2" class="slick-arrow default"><i class="fat fa-long-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </div>--}}
<!--============================== 
Footer Area
==============================-->   

@endsection