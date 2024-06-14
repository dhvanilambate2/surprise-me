@extends('layouts.simple.master')
@section('title', 'Add Services')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ route('/') }}/assets/css/select2.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link href="https://unpkg.com/croppie/croppie.css" rel="stylesheet" />
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
    <!--<link rel="stylesheet" type="text/css" href="{{ route('/') }}/assets/css/dropzone.css">-->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">-->
    <style>
        label.error {
            margin: 0px !important;
            color: #fd517d !important;
        }

        #image_demo {
            width: 100%;
            max-height: 400px;
            /* Set a maximum height for the croppie container */
            overflow-y: auto;
            /* Enable vertical scrolling if the content exceeds the maximum height */
            margin-top: 30px;
        }

        .error {
            margin: 0px !important;
        }

        .dropzone {
            margin-right: auto;
            margin-left: auto;
            padding: 50px;
            border: 2px dashed #7e37d8;
            border-radius: 15px;
            -o-border-image: none;
            border-image: none;
            background: rgba(126, 55, 216, 0.2);
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            min-height: 150px;
            position: relative;
        }

        .dropzone .dz-preview.dz-image-preview {
            background: none !important;
        }

        .input-group .form-control {
            border-top-left-radius: 0px !important;
            border-bottom-left-radius: 0px !important;
        }
    </style>

@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h2>Add<span> Service</span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Vendor</li>
    <a href="{{ route('services.index') }}" class="breadcrumb-item">Services Details</a>
    <li class="breadcrumb-item active">Add Shop Details</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Add Service</h5>
                    </div>
                    <div class="card-body add-post">

                        <form class="row themeform" method="post" action="{{ route('services.store') }}"
                            enctype="multipart/form-data" id="package_form">
                            @csrf

                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="service_name">Name Of Service:</label>
                                    <input class="form-control" id="service_name" type="text"
                                        placeholder="Enter Name of Services" name="service_name"
                                        value="{{ old('service_name') }}">
                                    <span class="text-danger" id="service_name-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="sub_title">Sub Title:</label>
                                    <input class="form-control" id="sub_title" type="text" placeholder="Enter Sub Title"
                                        name="sub_title" value="{{ old('sub_title') }}">
                                    <span class="text-danger" id="sub_title-error"></span>
                                </div>
                                <div class="form-group m-form__group">
                                    <label>Price:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">INR</span>
                                            <input class="form-control" id="price" type="number"
                                                placeholder="Enter Price" name="price" value="{{ old('price') }}">
                                        </div>
                                    </div>
                                    <span class="text-danger" id="price-error"></span>
                                </div>
                                <div class="form-group">
                                    <label>Category:</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="category-error"></span>
                                </div>
                                <div class="form-group">
                                    <label>Select Vendor:</label>
                                    <select name="vendor" id="vendor" class="form-control">
                                        <option value="">Select Vendor</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}"> {{ $vendor->name }} </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="vendor-error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea id="description" rows="4" class="form-control" name="description" placeholder="Enter a Description">{{ old('description') }}</textarea>
                                    <span class="text-danger" id="description-error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="validationCustom01">Location:</label>
                                    <input class="form-control" type="text" placeholder="Embed Map Here" name="location"
                                        value="{{ old('location') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Status:</label>
                                    <div class="custom-dropdown custom-dropdown-2">
                                        <input type="hidden" name="status" id="selectedStatus" value="draft">
                                        <div class="dropdown-toggle dropdown-toggle-2 form-control"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Draft
                                        </div>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <div class="dropdown-item dropdown-item-2" data-value="draft"><i
                                                    class="fas fa-draft"></i> Draft
                                            </div>
                                            <div class="dropdown-item dropdown-item-2" data-value="review"><i
                                                    class="fas fa-review"></i>
                                                Ready For Review</div>
                                            @can('services-publish')
                                                <div class="dropdown-item dropdown-item-2" data-value="publish"><i
                                                        class="fas fa-publish"></i> Publish</div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Main Image:</label>
                                    <div class="" id='image_lists'>
                                        <div class="dropzone w-100" id="mainImageDropzone"></div>
                                    </div>
                                    <span class="text-danger" id="main_image-error"></span>
                                </div>
                                <div class="form-group">
                                    <label>Other Images:</label>
                                    <div class="" id='image_lists'>
                                        <div class="dropzone w-100" id="myDropzone"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="btn-showcase">
                                <div class="spinner-border text-dark d-none" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <button class="btn btn-primary btn-pill" type="button" id="form_submit_button">
                                    Submit
                                </button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ route('/') }}/assets/js/select2/select2.full.min.js"></script>
    <script src="{{ route('/') }}/assets/js/select2/select2-custom.js"></script>
    <!--<script src="{{ route('/') }}/assets/js/dropzone/dropzone.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>-->
    <!--<script src="{{ route('/') }}/assets/js/dropzone/dropzone-script.js"></script>-->
    <script src="{{ route('/') }}/assets/js/chat-menu.js"></script>
    <script src="{{ route('/') }}/assets/js/form-validation-custom.js"></script>
    <script src="{{ route('/') }}/assets/js/editor/ckeditor/ckeditor.js"></script>
    <script src="{{ route('/') }}/assets/js/editor/ckeditor/styles.js"></script>
    <script src="{{ route('/') }}/assets/js/editor/ckeditor/adapters/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://unpkg.com/croppie"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('description');
        });
    </script>
    <script>
        var uploaded_images = [];
        var main_image = [];


        Dropzone.options.myDropzone = {
            url: '{{ route('categories.imgStore') }}',
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


                myDropZone.on("addedfile", function(file) {
                    // Remove the "Remove" button for each file
                    file.previewElement.querySelector(".dz-remove").addEventListener("click", function() {
                        myDropZone.removeFile(file);
                        uploaded_images.splice(uploaded_images.indexOf(file), 1);
                    });
                });

                buttonCancel.addEventListener('click', function() {
                    // Remove the editor from the view
                    document.body.removeChild(editor);
                    // Remove the file from Dropzone
                    myDropZone.removeFile(file);
                });
                buttonConfirm.addEventListener('click', function() {
                    croppie.result({
                        type: 'blob',
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
            url: '{{ route('categories.imgStore') }}',
            sending: function(file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
            },
            maxFiles: 1,
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

                mainImageDropzone.on("addedfile", function(file) {
                    // Remove the "Remove" button for each file
                    file.previewElement.querySelector(".dz-remove").addEventListener("click", function() {
                        mainImageDropzone.removeFile(file);
                        main_image.splice(main_image.indexOf(file), 1);
                    });
                });
                buttonCancel.addEventListener('click', function() {
                    // Remove the editor from the view
                    document.body.removeChild(editor);
                    // Remove the file from Dropzone
                    mainImageDropzone.removeFile(file);
                });
                buttonConfirm.addEventListener('click', function() {
                    croppie.result({
                        type: 'blob',
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

            $('#form_submit_button').click(function(event) {
                // Prevent default form submission
                event.preventDefault();
                $('.spinner-border').removeClass('d-none');
                // Serialize form data
                var formData = new FormData($('#package_form')[0]);

                for (var i = 0; i < uploaded_images.length; i++) {
                    formData.append('uploaded_images[]', uploaded_images[i]);
                }
                var descriptionData = CKEDITOR.instances.description.getData();
                formData.append('description', descriptionData);
                formData.append('main_image', main_image[0])
                // Make AJAX request
                $.ajax({
                    url: "{{ route('services.store') }}",
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        if (data.success) {
                            // Redirect to the appropriate page based on the selected home for option
                            window.location = "{{ URL::to('/admin/services)') }}";

                        }
                    },
                    error: function(xhr, status, error) {
                        $('.spinner-border').addClass('d-none');
                        if (xhr.status === 422) {
                            // If validation fails, display validation errors
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key + '-error').text(value);
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



@endsection
