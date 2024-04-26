@extends('frontend.layout.app')

@section('content')
<style>
    #profile_card:hover {
        cursor: pointer;
    }
</style>
<!--==============================
    Breadcumb
============================== -->
<div class="">
    <div class="breadcumb-wrapper mt-4 " data-bg-src="{{ url('frontend') }}/assets/img/bg/team.png">
        <h1 class="breadcumb-title">Our Experts</h1>
        <ul class="breadcumb-menu d-none">
            <li><a href="index.html">Home</a></li>
            <li>Our Expert</li>
        </ul>
    </div>
</div>
<!--==============================
Team Area  
==============================-->
<section class="space">
    <div class="container">
        <div class="row gy-30">
            <!-- Single Item -->
          
            @foreach($teams as $team)
            <div class="col-md-6 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
        
                  <div class="team-card style2" id="profile_card" data-id="{{ route('team.details', ['id' => $team->id]) }}">
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
            @endforeach

        </div>
    </div>
</section>


<script>
    document.getElementById('profile_card').addEventListener('click', function() {
        var url = this.getAttribute('data-id');
        window.location.href = url;
    });
</script>
@endsection