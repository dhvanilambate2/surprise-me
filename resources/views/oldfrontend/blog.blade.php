@extends('frontend.layout.app')

@section('content')

<!--==============================
    Breadcumb
============================== -->
<div class="">
    <div class="breadcumb-wrapper  mt-4" data-bg-src="{{ url('frontend') }}/assets/img/bg/all-page.png">
        <h1 class="breadcumb-title">Blogs</h1>
        <ul class="breadcumb-menu d-none">
            <li><a href="index.php">Home</a></li>
            <li>Blogs</li>
        </ul>
    </div>
</div>
<!--==============================
Gallery Area  
==============================-->
<div class="space">
    <div class="container">
        
        <div class="row">
            @foreach ($blogs as $item)
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="blog-grid">
                        <div class="blog-img">
                            <img src="{{ $item->getFirstMediaUrl('blogs') }}" alt="blog image" style="width: 450px; height: 450px;">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta style2">
                                <a href="{{ route('blog.details', ['id' => $item->id]) }}">Architecture</a>
                                <a href="{{ route('blog.details', ['id' => $item->id]) }}">February 15, 2023</a>
                            </div>
                            <p class="blog-text">{{ $item->title }}</p>
                            <a href="{{ route('blog.details', ['id' => $item->id]) }}" class="link-btn">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach

                
            </div>  
       
        <div class="text-center mt-5 pt-4">
            <a href="{{ url('blog') }}" class="th-btn"><span class="line left"></span> Load More <span class="line"></span></a>
        </div>
    <div class="shape-mockup jump" data-top="0" data-right="0"><img src="{{ url('frontend') }}/assets/img/shape/shape_3.png" alt="shape"></div>

    </div>
</div><!--==============================
Footer Area
==============================-->


@endsection