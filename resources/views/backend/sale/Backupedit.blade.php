@extends('layouts.simple.master')
@section('title', 'Edit Home For Sale')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ route('/') }}/assets/css/select2.css">
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
        .input-group .form-control{
            border-top-left-radius: 0px !important;
            border-bottom-left-radius: 0px !important;
        }
    </style>
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h2>Edit<span>Home For Sale</span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Properties</li>
    <li class="breadcrumb-item">Manage Homes</li>
    <a href="{{route('home_for_sale.index')}}" class="breadcrumb-item">Home For Sale</a> 
    <li class="breadcrumb-item active justify-content-between align-items-center text-nowrap"><i data-feather="edit" style="width: 12%;"></i> {{ $homeDetails->property_name }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Home For Sale</h5>
                    </div>
                    <div class="card-body add-post">
                        
                        
                        <form class="row needs-validation themeform" method="post" action="{{ Route('home_for_sale.update',$homeDetails->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="col-sm-8">
                                <input type="hidden" value="rent" name="home_for">
                                <div class="form-group">
                                    <label for="property_name">Name Of Property:</label>
                                    <input class="form-control" id="property_name" type="text" placeholder="Enter Name of Property" name="property_name" value="{{ old('property_name', $homeDetails->property_name) }}">
                                    <span class="text-danger" id="property_name-error"></span>
                                </div>
                                <div class="form-group">
                                    <label>Address:</label>
                                    <textarea id="address" name="address" rows="4" placeholder="Enter a Address" class="form-control" required>{{ old('address', $homeDetails->address) }}</textarea>
                                    <span class="text-danger" id="address-error"></span>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group m-form__group">
                                            <label>Price:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">USD</span>
                                                    <input class="form-control" id="price" type="number" placeholder="Enter Price" name="price" value="{{ old('price', $homeDetails->price) }}">
                                                </div>
                                            </div>
                                            <span class="text-danger" id="price-error"></span>
                                        </div>  
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bedrooms:</label>
                                            <input class="form-control" id="badrooms" type="number" placeholder="Enter Bedrooms" name="badrooms" value="{{ old('badrooms', $homeDetails->bedrooms) }}">
                                            <span class="text-danger" id="badrooms-error"></span>
                                        </div>  
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bathrooms:</label>
                                            <input class="form-control" id="bathroom" type="number" placeholder="Enter bathroom" name="bathroom" value="{{ old('bathroom', $homeDetails->bathroom) }}">
                                            <span class="text-danger" id="bathroom-error"></span>
                                        </div>  
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 d-flex">
                                        <div class="form-group">
                                            <label>Total SqFT:</label>
                                            <div class="d-flex align-items-center">
                                                <input class="form-control" id="price" type="text" name="sqft_width" value="{{ old('sqft_width', $homeDetails->sqft_width) }}"> <i data-feather="x" class="w-25"></i>
                                                <input class="form-control" id="price" type="number" name="sqft_height" value="{{ old('sqft_height', $homeDetails->sqft_height) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea id="description" rows="4"  class="form-control" name="description" rows="4" placeholder="Enter a Description">{{ old('description', $homeDetails->description) }}</textarea>
                                    <span class="text-danger" id="description-error"></span>
                                </div>
                                <div class="form-group">
                                    <label>Short Description:</label>
                                    <textarea id="short_description" name="short_description" rows="4" placeholder="Enter a Short Description"
                                        class="form-control">{{ old('short_description', $homeDetails->sub_description) }}</textarea>
                                    <span class="text-danger" id="short_description-error"></span>

                                </div>
                                <div class="form-group">
                                    <label>Resources Images: </label>
                                    <div class="row" id='image_lists'>
                                        <div class="row mb-3">
                                            <div class="col-5">
                                                <input type="type" name="title[]" class="form-control h-100" id="title" placeholder="Enter Title"> 
                                            </div>
                                            <div class="col-5">
                                                <input type="file" name="resources_images[]" class="form-control" id="resources_images"> 
                                            </div>
                                            <div class="col-2 p-0 d-flex">
                                                <button type="button" class="text-danger btn p-0 remove_image"><i class="pe-7s-trash" style='font-size: 25px;'></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-danger" id="resources_images-error"></div>
                                    <button type="button" class="btn btn-primary p-1 mt-2 " id='add_image'><i class="pe-7s-plus" style='font-size: 25px;vertical-align: middle;'></i></button>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="facebook">Facebook Link</label>
                                            <input class="form-control" id="facebook" type="url"
                                                placeholder="Enter Your Facebook Link" name="facebook"
                                                value="{{ old('facebook', $homeDetails->facebook) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="instagram">Instagram Link</label>
                                            <input class="form-control" id="instagram" type="url"
                                                placeholder="Enter Your instagram Link" name="instagram"
                                                value="{{ old('instagram', $homeDetails->instagram) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="skype">Skype Link</label>
                                            <input class="form-control" id="skype" type="url"
                                                placeholder="Enter Your Skype Link" name="skype"
                                                value="{{ old('skype', $homeDetails->skype) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="twitter">Twitter Link</label>
                                            <input class="form-control" id="twitter" type="url"
                                                placeholder="Enter Your Twitter Link" name="twitter"
                                                value="{{ old('twitter', $homeDetails->twitter) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="validationCustom01">Property Location:</label>
                                    <input class="form-control" type="text" placeholder="Embed Map Here" name="property_location" value="{{ old('property_location', $homeDetails->property_location) }}">
                                </div>

                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Status:</label>
                                    <div class="custom-dropdown custom-dropdown-2">
                                        <input type="hidden" name="status" id="selectedStatus" value="draft">
                                        <div class="dropdown-toggle dropdown-toggle-2 form-control" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Draft
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
                                    <label>Home Type:</label>
                                    <div class="custom-dropdown custom-dropdown-3">
                                        <input type="hidden" name="home_type" id="selectedHomeType" value="houses">
                                        <div class="dropdown-toggle dropdown-toggle-3 form-control" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Houses
                                        </div>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="dropdown-item dropdown-item-3" data-value="houses"><i class="fas fa-draft"></i> Houses </div>
                                            <div class="dropdown-item dropdown-item-3" data-value="apartments"><i class="fas fa-review"></i> Apartments</div>
                                            <div class="dropdown-item dropdown-item-3" data-value="townhomes"><i class="fas fa-publish"></i> Townhomes</div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                 

                               <div class="form-group">
                                    <label>Main Image: ( 810 X 400 )</label>
                                    @if($homeDetails->main_image)
                                        <div class="my-1"> 
                                            <img src="{{ asset('public/images/' . $homeDetails->main_image) }}" alt="Main Image Preview" style="height: 100px;width: 200px;">
                                        </div>
                                    @endif
                                    <div class="" id='image_lists'>
                                        <div class="dropzone w-100" id="mainImageDropzone"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Other Images: ( 450 X 450 )</label>
                                    <div class="d-flex flex-wrap gap-3">
                                        @foreach($homeDetails->getMedia('images') as $image)
                                            <div class="d-flex flex-column">
                                                <img src="{{ $image->getUrl() }}" alt="{{ $image->name }}" style="height: 100px;width: 100px;">
                                                <a href="javascript:void(0);" class="text-center remove-image" data-image-id="{{ $image->id }}">Remove</a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="" id='image_lists'>
                                        <div class="dropzone w-100" id="myDropzone"></div>
                                    </div>
                                    
                                    <input type="text" id="removedImageIds" name="removed_image_ids" value="">    
                                </div>  
                            </div>

                            <div class="btn-showcase">
                                <button class="btn btn-primary btn-pill" type="button"
                                    id="form_submit_button">Submit</button>
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
    var uploaded_images = [];
    var main_image = [];
    

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
    Dropzone.options.mainImageDropzone = {
        url: '{{ route("home_for_rent.imgStore") }}',
        sending: function(file, xhr, formData) {
            formData.append("_token", "{{ csrf_token() }}");
        },
        maxFiles:1,
        addRemoveLinks: true, 
        init: function() {
            this.on("removedfile", function(file) {
                main_image.splice(main_image.indexOf(file), 1);
            });
        },
        transformFile: function(file, done) { 
            var mainImageDropzone = this;
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
            mainImageDropzone.on("addedfile", function(file) {
                // Remove the "Remove" button for each file
                file.previewElement.querySelector(".dz-remove").addEventListener("click", function() {
                    mainImageDropzone.removeFile(file);
                    main_image.splice(main_image.indexOf(file), 1);
                });
            });
            buttonConfirm.addEventListener('click', function() {
                croppie.result({
                  type:'blob',
                  size: {
                    width: 810,
                    height: 400
                  }
                }).then(function(blob) {
                    mainImageDropzone.createThumbnail(
                        blob,
                        mainImageDropzone.options.thumbnailWidth,
                        mainImageDropzone.options.thumbnailHeight,
                        mainImageDropzone.options.thumbnailMethod,
                        false, 
                        function(dataURL) {
                            // Update the Dropzone file thumbnail
                            mainImageDropzone.emit('thumbnail', file, dataURL);
                            // Return the file to Dropzone
                            main_image.push(blob);
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
                    width: 810,
                    height: 400
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
            var property_name = $('#property_name').val()
            
          // Add cropped image data to formData
                console.log(property_name);
                console.log(main_image);
                
            for (var i = 0; i < uploaded_images.length; i++) {
                formData.append('uploaded_images[]', uploaded_images[i]);
            }
            formData.append('main_image',main_image[0])
          // Make AJAX request
          $.ajax({
              url: "{{ route('home_for_rent.update',$homeDetails->id) }}",
              type: 'POST',
              data: formData,
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                
            },
              cache: false,
              contentType: false,
              processData: false,
              success: function (data) {
                  
                    if (data.success) {
                        window.location = "{{ URL::to('/admin/home_for_rent') }}";
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


<!-- dropdown code -->
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
       
       $('.custom-dropdown-3').on('click', '.dropdown-item-3', function() {
            var selectedValue = $(this).data('value');
            $('#selectedHomeType').val(selectedValue);
            $('.dropdown-toggle-3').html($(this).html());
        });
        $('.custom-dropdown-3').on('click', function() {
            $(this).toggleClass('active');
        });
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.custom-dropdown-3').length) {
                $('.custom-dropdown-3').removeClass('active');
            }
        });
        
        $('.custom-dropdown-1').on('click', '.dropdown-item-1', function() {
            var selectedValue = $(this).data('value');
            $('#selectedHomeFor').val(selectedValue);
            $('.dropdown-toggle-1').html($(this).html());
        });
        $('.custom-dropdown-1').on('click', function() {
            $(this).toggleClass('active');
        });
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.custom-dropdown-1').length) {
                $('.custom-dropdown-1').removeClass('active');
            }
        });
    });
</script>
@endsection