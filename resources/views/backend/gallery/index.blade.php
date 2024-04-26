@extends('layouts.simple.master')
@section('title', 'Home For Rent')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">   
<style>
  .truncate-text {
    max-width: 150px;
    /* Adjust the maximum width according to your design */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .nav-item {
    width: 20%;
    text-align: center;
  }
  .dropzone {
            margin-right: auto;
            margin-left: auto;
            padding: 50px;
            border: 2px dashed #7e37d8;
            border-radius: 15px;
            -o-border-image: none;
            border-image: none;
            background: rgba(126,55,216,0.2);
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            min-height: 150px;
            position: relative;
        }
        .dropzone .dz-preview.dz-image-preview {
            background: none !important;
        }
</style>

@endsection

@section('style')

@endsection

@section('breadcrumb-title')
<h2>Data of <span>Home For Rent</span></h2>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Properties</li>
<li class="breadcrumb-item active">Home For Rent</li>
@endsection

@section('content')

<div class="container-fluid">
  <div class="card">
    <form action="{{ route('gallery.store') }}" method="post" enctype="multipart/form-data" class="dropzone w-100" id="image-upload">
        @csrf
        <!--<div>-->
            <div class="dz-default dz-message m-0">
                <i class="icon-cloud-up" style="font-size: 30px;"></i>
                <h6 class="mb-0">Drop files here or click to upload.</h6>
            </div>
            <!--<h3>Upload Multiple Image By Click On Box</h3>-->
        <!--</div>-->
    </form>

  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h5>IMAGE GALLERY</h5>
        </div>
        <div class="my-gallery card-body row" id="image-gallery" itemscope="">
            @foreach($model->getMedia('gallery') as $media)
                <div class="col-xl-3 col-md-4 col-sm-6 col-12 mt-4">
                    <img class="img-thumbnail " src="{{ $media->getUrl() }}" itemprop="thumbnail" alt="Image description" style="height: 200px; width: 100%; object-fit:cover;">
                </div>
            @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Set up Dropzone
    Dropzone.options.imageUpload = {
        success: function(file, response) {
            // On successful upload, update the image gallery using Ajax
            $.ajax({
                url: '{{ route("gallery.getImages") }}',
                method: 'GET',
                success: function(data) {
                    $('#image-gallery').html(data);
                }
            });
        }
    };
</script>
@endsection