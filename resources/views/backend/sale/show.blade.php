@extends('layouts.simple.master')
@section('title', 'Home For Sale')

@section('css')
    <!-- Add your custom CSS here if needed -->
    {{-- <style>
        .property-images img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
    </style> --}}
@endsection

@section('style')
    <!-- Add your custom styles here if needed -->

    <style>
        .property-images img {
            max-width: 100%;
            height: 300px;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .property-images img:hover {
            transform: scale(1.05);
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h2>Show <span>Home For Sale</span></h2>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Properties</li>
<a href="{{route('home_for_sale.index')}}" class="breadcrumb-item">Home For Sale</a> 
<li class="breadcrumb-item active">Show</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="blog-single">
                <div class="blog-box blog-details">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Display each image associated with the homeDetails -->
                            @if($homeDetails->hasMedia('images'))
                            <div class="property-images row" >
                                @foreach($homeDetails->getMedia('images') as $image)
                                    <div class="col-3">
                                        <img src="{{ $image->getUrl() }}" alt="{{ $image->name }}" class="img-fluid w-100">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        
                        </div>
                    </div>
                    <div class="blog-details">
                            <h2 class="text-center mt-3">{{ $homeDetails->property_name }}</h2>
                        <h4>{{ $homeDetails->sub_description }}</h4>
                        <div class="single-blog-content-top">
                            {!! $homeDetails->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <!-- Add your custom scripts here if needed -->
@endsection
