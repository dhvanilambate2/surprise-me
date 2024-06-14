@extends('layouts.simple.master')
@section('title', 'Blog Categories')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ route('/') }}/assets/css/select2.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link href="https://unpkg.com/croppie/croppie.css" rel="stylesheet" />
    <style>
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
    <h2>Categories<span>Edit</span></h2>
@endsection

@section('breadcrumb-items')
    <a href="{{ route('categories.index') }}" class="breadcrumb-item">Categories</a>
    <li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Blog Category</h5>
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
                            action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data" id="package_form">
                            @csrf
                            @method('PUT')

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Category Name:</label>
                                    <input class="form-control" id="name" type="text"
                                        placeholder="Enter Category Name" name="name"
                                        value="{{ old('name', $category->name) }}">
                                </div>
                                <div class="form-group">
                                    <label>Category Image: </label>
                                    @foreach ($category->getMedia('category_image') as $image)
                                        <div class="d-flex flex-column">
                                            <img src="{{ $image->getUrl() }}" alt="{{ $image->name }}"
                                                style="height: 100px;width: 100px;">

                                        </div>
                                    @endforeach
                                    <div class="" id='image_lists'>
                                        <div class="dropzone w-100" id="mainImageDropzone"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="btn-showcase">
                                <button class="btn btn-primary btn-pill" id="form_submit_button"
                                    type="submit">Submit</button>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://unpkg.com/croppie"></script>

    <script>
        var main_image = [];

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
                            width: 500,
                            height: 500
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
                        width: 500,
                        height: 500
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

                // Serialize form data
                var formData = new FormData($('#package_form')[0]);
                var name = $('#name').val()

                // Add cropped image data to formData
                console.log(name);
                formData.append('main_image', main_image[0]);
                // Make AJAX request
                $.ajax({
                    url: "{{ route('categories.update', $category->id) }}",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',

                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        if (data.success) {
                            window.location = "{{ URL::to('/admin/categories') }}";
                        }
                    },
                    error: function(xhr, status, error) {
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

    <!-- Add the following script at the end of your file -->

@endsection
