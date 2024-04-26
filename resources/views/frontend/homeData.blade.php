 @php
$count = 01;
@endphp
@if(count($homeDetails) > 0)
    @foreach ($homeDetails as $item)
        <div class="col-xl-4 col-md-6">
            <div class="gallery-box">
                @if($item->home_for == 'rent')
                    <a href="{{ route('home_for_rent.details', ['id' => $item->id]) }}">
                @else
                    <a href="{{ route('home_for_sale.details', ['id' => $item->id]) }}">
                @endif
                
                    <div class="project-img">
                        @if($item->main_image)
                            <img src="{{ asset('public/images/' . $item->main_image) }}" alt="Main Image Preview" style="width: 100%;height: 450px; object-fit:cover;">
                        @endif
                    </div>
                    <div class="gallery-content">
                        @if ($count > 9)
                            <div class="project-number">{{ $count }}</div>
                        @else
                            <div class="project-number">0{{ $count }}</div>
                        @endif
                        <h3 class="h5 project-title">{{ $item->property_name }}</h3>
                        <p class="project-map"><i class="fal fa-location-dot"></i>{{ $item->address }}</p>
                    </div>
                </a>
            </div>
        </div>
    
        @php
            $count++
        @endphp
    @endforeach
     <div class="d-flex justify-content-center mt-5">
                {{ $homeDetails->links() }}
        </div>
@else 
    <h3 class="text-light text-center">Not Found..!!</h3>
@endif