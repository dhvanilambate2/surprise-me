@extends('layouts.simple.master')
@section('title', 'Add Client Review')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link href="https://unpkg.com/croppie/croppie.css" rel="stylesheet"/>
    <style>
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
    <h2>Add<span>Client Review</span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Setting</li>
    <a href="{{ route('setting_home.index') }}" class="breadcrumb-item">Home Page</a>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Add Client Review</h5>
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
                        <form class="row needs-validation themeform" method="post" action="{{ route('setting_home.review_store') }}"
                            enctype="multipart/form-data" id="package_form">
                            @csrf
                            @method('post') <!-- Add this line to set the correct HTTP method -->

                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" id="name" type="text" placeholder="Enter Name"
                                        name="name" value="{{ old('name') }}">
                                    <span class="text-danger" id="name-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="post">Post</label>
                                    <input class="form-control" id="post" type="text" placeholder="Enter Post"
                                        name="post" value="{{ old('post') }}">
                                    <span class="text-danger" id="post-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea id="description" class="rounded" name="description">{{ old('description') }}</textarea>
                                    <span class="text-danger" id="description-error"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Image: </label>
                                    <div class="" id='image_lists'>
                                        <div class="dropzone w-100" id="reviewImageDropzone"></div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="btn-showcase">
                                <button class="btn btn-primary btn-pill" id="form_submit_button" type="button">Submit</button>
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
    <!--<script src="{{ route('/') }}/assets/js/select2/select2.full.min.js"></script>-->
    <!--<script src="{{ route('/') }}/assets/js/select2/select2-custom.js"></script>-->
    <!--<script src="{{ route('/') }}/assets/js/dropzone/dropzone.js"></script>-->
    <!--<script src="{{ route('/') }}/assets/js/dropzone/dropzone-script.js"></script>-->
    <script src="{{ route('/') }}/assets/js/chat-menu.js"></script>
    <!--<script src="{{ route('/') }}/assets/js/email-app.js"></script>-->
    <script src="{{ route('/') }}/assets/js/form-validation-custom.js"></script>
    <script src="{{ route('/') }}/assets/js/editor/ckeditor/ckeditor.js"></script>
    <script src="{{ route('/') }}/assets/js/editor/ckeditor/styles.js"></script>
    <script src="{{ route('/') }}/assets/js/editor/ckeditor/adapters/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://unpkg.com/croppie"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('description');
        });
    </script>

    
    <script>
    var images = [];
        Dropzone.options.reviewImageDropzone = {
            url: '{{ route("setting_home.teamImgStore") }}',
            sending: function(file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
            },
            maxFiles:1,
            addRemoveLinks: true, 
            init: function() {
                this.on("removedfile", function(file) {
                    images.splice(images.indexOf(file), 1);
                });
            },
            transformFile: function(file, done) { 
                var reviewImageDropzone = this;
                var editor = document.createElement('div');
                editor.style.position = 'fixed';
                editor.style.left = 0;
                editor.style.right = 0;
                editor.style.top = 0;
                editor.style.bottom = 0;
                editor.style.zIndex = 9999;
                editor.style.backgroundColor = '#000';
                document.body.appendChild(editor);
                
                // Create confirm button at the top left of the viewport
                var buttonConfirm = document.createElement('button');
                buttonConfirm.style.position = 'absolute';
                buttonConfirm.style.left = '10px';
                buttonConfirm.classList.add('btn');
                buttonConfirm.classList.add('btn-primary');
                buttonConfirm.style.top = '10px';
                buttonConfirm.style.zIndex = 9999;
                buttonConfirm.textContent = 'Confirm';
                editor.appendChild(buttonConfirm);
                
                // Create cancel button at the top right of the viewport
                var buttonCancel = document.createElement('button');
                buttonCancel.style.position = 'absolute';
                buttonCancel.style.right = '10px';
                buttonCancel.classList.add('btn');
                buttonCancel.classList.add('btn-danger'); // Choose an appropriate color
                buttonCancel.style.top = '10px';
                buttonCancel.style.zIndex = 9999;
                buttonCancel.textContent = 'Cancel';
                editor.appendChild(buttonCancel);
                
                buttonCancel.addEventListener('click', function() {
                    // Remove the editor from the view
                    document.body.removeChild(editor);
                    // Remove the file from Dropzone
                    reviewImageDropzone.removeFile(file);
                });
                
                
                reviewImageDropzone.on("addedfile", function(file) {
                    // Remove the "Remove" button for each file
                    file.previewElement.querySelector(".dz-remove").addEventListener("click", function() {
                        reviewImageDropzone.removeFile(file);
                        images.splice(images.indexOf(file), 1);
                    });
                });
                buttonConfirm.addEventListener('click', function() {
                    croppie.result({
                      type:'blob',
                      size: {
                        width: 90,
                        height: 90
                      }
                    }).then(function(blob) {
                        reviewImageDropzone.createThumbnail(
                            blob,
                            reviewImageDropzone.options.thumbnailWidth,
                            reviewImageDropzone.options.thumbnailHeight,
                            reviewImageDropzone.options.thumbnailMethod,
                            false, 
                            function(dataURL) {
                                // Update the Dropzone file thumbnail
                                reviewImageDropzone.emit('thumbnail', file, dataURL);
                                // Return the file to Dropzone
                                images.push(blob);
                                // console.log(blob.dataURL);
                         });
                        // Return the file to Dropzone
                        done(blob);
                    });
                    // Remove the editor from the view
                    document.body.removeChild(editor);
                });

                
            
                var croppie = new Croppie(editor, {
                    // enableResize: true,
                    viewport: {
                        width: 450,
                        height: 450
                    }
                  });
                  // Tell Croppie to load the file
                  croppie.bind({
                    url: URL.createObjectURL(file)
                    
                  });
            }
        };
        
        
        
        
        $(document).ready(function() {
             
            $('#form_submit_button').click(function (event) {
              event.preventDefault();

                var formData = new FormData($('#package_form')[0]);
                var descriptionData = CKEDITOR.instances.description.getData();
                formData.append('description', descriptionData);
                formData.append('images',images[0])
                
              // Make AJAX request
              $.ajax({
                  url: "{{ route('setting_home.review_store') }}",
                  type: 'POST',
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function (data) {
                      
                      if (data.success) {
                            window.location = "{{ URL::to('/admin/setting_home') }}";
                    }
                  },
                  error: function (xhr, status, error) {
                      if (xhr.status === 422) {
                        // If validation fails, display validation errors
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#'+key+'-error').text(value);
                        });
                    } else {
                        // Handle other types of errors
                        console.error(xhr.responseText);
                    }
                  }
              });
          });
        });
    </script>

@endsection
