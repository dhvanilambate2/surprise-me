@extends('layouts.simple.master')
@section('title', 'Add Home For Sale')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ route('/') }}/assets/css/select2.css">
    <link rel="stylesheet" type="text/css" href="{{ route('/') }}/assets/css/dropzone.css">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h2>Add<span>Home For Sale</span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Properties</li>
    <a href="{{ route('home_for_sale.index') }}" class="breadcrumb-item">Home For Sale</a>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Add Home For Sale</h5>
                    </div>
                    <div class="card-body add-post">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="row needs-validation themeform" method="post"
                            action="{{ route('home_for_sale.store') }}" enctype="multipart/form-data">
                            @csrf
                            @method('post') <!-- Add this line to set the correct HTTP method -->

                            <div class="col-sm-12">
                                <input type="hidden" value="sale" name="home_for">
                                <div class="form-group">
                                    <label for="validationCustom01">Name Of Property:</label>
                                    <input class="form-control" id="validationCustom01" type="text"
                                        placeholder="Enter Name of Property" name="property_name"
                                        value="{{ old('property_name') }}" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="form-group">
                                    <label>Address:</label>
                                    <textarea id="text-box" name="address" rows="4" placeholder="Enter a Address" class="form-control" required>{{ old('address') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea id="description" class="rounded" name="description" required>{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Sort Description:</label>
                                    <textarea id="text-box" name="short_description" rows="4" placeholder="Enter a Sort Description" class="form-control" required>{{ old('short_description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="brochure">Brochure PDF (if available):</label>
                                    <input type="file" class="form-control" id="brochure" name="brochure"
                                        accept=".pdf">
                                </div>
                                <div class="form-group">
                                    <label for="validationCustom01">Property Location:</label>
                                    <input class="form-control" type="text"
                                        placeholder="Embed Map Here" name="property_location"
                                        value="{{ old('property_location') }}">
                                </div>
                                <div class="form-group">
                                    <label>Status:</label>
                                    <div class="m-checkbox-inline">
                                       <label for="draft">
                                       <input class="radio_animated" value="draft" id="draft" type="radio" name="status" checked="">Draft
                                       </label>
                                       <label for="draft">
                                       <input class="radio_animated" value="review" id="draft" type="radio" name="status">Ready For Review
                                       </label>
                                       @if(Auth::user()->type == 'admin')
                                       <label for="publish">
                                       <input class="radio_animated" value="publish" id="publish" type="radio" name="status">Publish
                                       </label>
                                       @endif
                                    </div>
                                 </div>
                            </div>
                            <label>Main Image: ( 810 X 400 )</label>
                            <div class="dropzone digits w-100">
                                <input type="file" name="main_image" multiple required>
                                <div id="imagePreviewContainer"></div>
                            </div>
                            <label>Other Image:  ( 450 X 450 )</label>
                            <div class="dropzone digits w-100">
                                <input type="file" id="multiFileUpload" name="images[]" multiple required>
                                <div id="imagePreviewContainer"></div>
                            </div>
                            {{-- <input type="hidden" name="images[]" > --}}
                            {{-- <div class="dropzone digits w-100" id="multiFileUpload" action="/upload.php">
                                <div class="m-0 dz-message needsclick">
                                    <i class="icon-cloud-up"></i>
                                    <h6 class="mb-0">Drop files here or click to upload.</h6>
                                </div>
                            </div> --}}
                            <div class="btn-showcase">
                                <button class="btn btn-primary btn-pill" type="submit">Submit</button>
                                <input class="btn btn-light btn-pill" type="reset" value="Discard">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ route('/') }}/assets/js/select2/select2.full.min.js"></script>
    <script src="{{ route('/') }}/assets/js/select2/select2-custom.js"></script>
    <script src="{{ route('/') }}/assets/js/dropzone/dropzone.js"></script>
    <script src="{{ route('/') }}/assets/js/dropzone/dropzone-script.js"></script>
    <script src="{{ route('/') }}/assets/js/chat-menu.js"></script>
    <script src="{{ route('/') }}/assets/js/email-app.js"></script>
    <script src="{{ route('/') }}/assets/js/form-validation-custom.js"></script>
    <script src="{{ route('/') }}/assets/js/editor/ckeditor/ckeditor.js"></script>
    <script src="{{ route('/') }}/assets/js/editor/ckeditor/styles.js"></script>
    <script src="{{ route('/') }}/assets/js/editor/ckeditor/adapters/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('description');
        });
    </script>

    <!-- Add the following script at the end of your file -->

@endsection
