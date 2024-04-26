@extends('layouts.simple.master')
@section('title', 'Edit Blog')

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
    <h2>Edit<span>Blog</span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Blog</li>
    <a href="{{ route('blogs.index') }}" class="breadcrumb-item">Blog Details</a>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Blog</h5>
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
                        <form class="row needs-validation themeform" method="post" action="{{ route('blogs.update', $blogs->id) }}" enctype="multipart/form-data" id="package_form">
                            @csrf
                            @method('PUT')

                            <div class="col-sm-8">
                                <input type="hidden" value="blog" name="home_for">
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input class="form-control" id="title" type="text"
                                        placeholder="Enter Title" name="title" value="{{ old('title', $blogs->title) }}" required>
                                    <span class="text-danger" id="title-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="blog_category">Category</label>
                                    <select name="blog_category" id="blog_category" class="form-control" required>
                                        <option value="">Select category</option>
                                        @foreach ($blog_categories as $item)
                                            <option value="{{$item->id}}" {{ (old('blog_category', $blogs->blog_category))? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="blog_category-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea id="content" rows="4" class="form-control" placeholder="Enter a Content" name="content" required>{{ old('content', $blogs->content) }}</textarea>
                                    <span class="text-danger" id="content-error"></span>
                                </div>
                                
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <?php
                                        switch ($blogs->status) {
                                            case 'draft':
                                                $blog_status_name = "Draft";
                                                $blog_status_value = "draft";
                                                break;
                                            case 'review':
                                                $blog_status_name = " Ready For Review";
                                                $blog_status_value = "review";
                                                break;
                                            case 'publish':
                                                $blog_status_name = "Publish";
                                                $blog_status_value = "publish";
                                                break;
                                            default:
                                                $blog_status_name = "Draft";
                                                $blog_status_value = "draft";
                                                break;
                                        }
                                    ?>
                                    <label>Status:</label>
                                    <div class="custom-dropdown custom-dropdown-2">
                                        <input type="hidden" name="status" id="selectedStatus" value="{{ $blog_status_value }}">
                                        <div class="dropdown-toggle dropdown-toggle-2 form-control" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ $blog_status_name }}
                                        </div>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <div class="dropdown-item dropdown-item-2" data-value="draft"><i class="fas fa-draft"></i> Draft
                                            </div>
                                            <div class="dropdown-item dropdown-item-2" data-value="review"><i class="fas fa-review"></i>
                                                Ready For Review</div>
                                            @if (Auth::user()->type == 'admin')
                                                <div class="dropdown-item dropdown-item-2" data-value="publish"><i
                                                        class="fas fa-publish"></i> Publish</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Blog Images: ( 450 X 450 )</label>
                                    <div id="imagePreviewContainer">
                                        @if($blogs->hasMedia('blogs'))
                                            <div class="d-flex mt-3">
                                                @foreach($blogs->getMedia('blogs') as $image)
                                                    <div class="d-flex flex-column">
                                                        <img src="{{ $image->getUrl() }}" alt="{{ $image->name }}" style="height: 100px;width: 100px;">
                                                        <a href="javascript:void(0);" class="text-center remove-image" data-image-id="{{ $image->id }}">Remove</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <input type="hidden" id="removedImageIds" name="removed_image_ids" value="{{ old('removed_image_ids') }}">
                                    <div class="" id='image_lists'>
                                        <div class="dropzone w-100" id="myDropzone"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-showcase">
                                <button class="btn btn-primary btn-pill" type="button" id="form_submit_button">Submit</button>
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
        $('.remove-image').on('click', function() {
            var imageId = $(this).data('image-id');
            var imageUrl = $(this).prev('img').attr('src');

            // Update the hidden input field with the removed image IDs
            var removedImageIds = $('#removedImageIds').val();
            removedImageIds += (removedImageIds ? ',' : '') + imageId;
            $('#removedImageIds').val(removedImageIds);

            // Remove the image preview
            $(this).parent().remove();
        });
    });
</script>
  <script>
        $(document).ready(function() {
            $('.custom-dropdown-2').on('click', '.dropdown-item-2', function() {
                var selectedValue = $(this).data('value');
                $('#selectedStatus').val(selectedValue);
                $('.dropdown-toggle-2').html($(this).html());
            });
            $('.custom-dropdown-2').on('click', function() {
                $(this).toggleClass('active');
            });
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.custom-dropdown-2').length) {
                    $('.custom-dropdown-2').removeClass('active');
                }
            });
        });
    </script>


<script>
    var uploaded_images = [];
    

    Dropzone.options.myDropzone = {
        url: '{{ route("home_for_rent.imgStore") }}',
        sending: function(file, xhr, formData) {
            formData.append("_token", "{{ csrf_token() }}");
        },
        
        addRemoveLinks: true, 
        init: function() {
            this.on("removedfile", function(file) {
                uploaded_images.splice(uploaded_images.indexOf(file), 1);
            });
        },
        transformFile: function(file, done) { 
            var myDropZone = this;
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
                myDropZone.removeFile(file);
            });
            myDropZone.on("addedfile", function(file) {
                // Remove the "Remove" button for each file
                file.previewElement.querySelector(".dz-remove").addEventListener("click", function() {
                    myDropZone.removeFile(file);
                    uploaded_images.splice(uploaded_images.indexOf(file), 1);
                });
            });
            buttonConfirm.addEventListener('click', function() {
                croppie.result({
                  type:'blob',
                  size: {
                    width: 450,
                    height: 450
                  }
                }).then(function(blob) {
                    myDropZone.createThumbnail(
                        blob,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        false, 
                        function(dataURL) {
                            // Update the Dropzone file thumbnail
                            myDropZone.emit('thumbnail', file, dataURL);
                            // Return the file to Dropzone
                            uploaded_images.push(blob);
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
      // Prevent default form submission
          event.preventDefault();

          // Serialize form data
          var formData = new FormData($('#package_form')[0]);
                
            for (var i = 0; i < uploaded_images.length; i++) {
                formData.append('uploaded_images[]', uploaded_images[i]);
            }
          // Make AJAX request
          $.ajax({
              url: "{{ route('blogs.update',$blogs->id) }}",
              type: 'POST',
              data: formData,
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                
            },
              cache: false,
              contentType: false,
              processData: false,
              success: function (data) {
                window.location = "{{ URL::to('/admin/blogs') }}";
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
