@extends('layouts.simple.master')
@section('title', 'Site Setting')

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
    <h2>Site<span>Setting</span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Setting</li>
    <li class="breadcrumb-item active">Site Setting</a>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Site Setting </h5>
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
                        <form class="row needs-validation themeform" method="post" action="{{ route('setting_site.update','1') }}"
                            enctype="multipart/form-data" id="package_form">
                            @csrf
                            @method('PUT') <!-- Add this line to set the correct HTTP method -->

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" id="email" type="text" placeholder="Enter Email"
                                    name="email" value="{{ old('email', $sites->email) }}">
                                    <span class="text-danger" id="email-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input class="form-control" id="phone" type="text" placeholder="Enter Number" name="phone" value="{{ old('phone', $sites->phone) }}">
                                    <span class="text-danger" id="phone-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="time">Office Hours</label>
                                    <input class="form-control" id="time" type="text" placeholder="Enter Office Hours"
                                    name="time" value="{{ old('time',$sites->hours) }}">
                                    <span class="text-danger" id="hours-error"></span>
                                </div>
                                <div class="form-group">
                                    <label>Address:</label>
                                    <textarea id="text-box" name="address" rows="4" placeholder="Enter a Address" class="form-control">{{ old('address',$sites->address) }}</textarea>
                                    <span class="text-danger" id="address-error"></span>
                                </div>
                                 <div class="row">
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label for="facebook">Facebook Link</label>
                                            <input class="form-control" id="facebook" type="url"
                                                placeholder="Enter Your Facebook Link" name="facebook"
                                                value="{{ old('facebook',$sites->facebook) }}">
                                            <span class="text-danger" id="facebook-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="skype">Skype Link</label>
                                            <input class="form-control" id="skype" type="url"
                                                placeholder="Enter Your Skype Link" name="skype"
                                                value="{{ old('skype',$sites->skype) }}">
                                            <span class="text-danger" id="skype-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="twitter">Twitter Link</label>
                                            <input class="form-control" id="twitter" type="url"
                                                placeholder="Enter Your Twitter Link" name="twitter"
                                                value="{{ old('twitter',$sites->twitter) }}">
                                            <span class="text-danger" id="twitter-error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Header Logo:</label>
                                             @if($sites->hasMedia('header_logo'))
                                                <div class=" mb-3" >
                                                    @foreach($sites->getMedia('header_logo') as $image)
                                                        <div class=" p-3" style="background: #e6dbf8;box-shadow: 0 0rem 4px black;">
                                                            <img src="{{ $image->getUrl() }}" alt="{{ $image->name }}" style="height: auto;width: 100%; object-fit: contain;">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                            <div class="" id='image_lists'>
                                                <div class="dropzone w-100" id="headerImageDropzone"></div>
                                            </div>
                                        </div>
                                    </div>    
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Footer Logo:</label>
                                            @if($sites->hasMedia('footer_logo'))
                                                <div class="mb-3">
                                                    @foreach($sites->getMedia('footer_logo') as $image)
                                                        <div class=" p-3" style="background: #e6dbf8;box-shadow: 0 0rem 4px black;">
                                                            <img src="{{ $image->getUrl() }}" alt="{{ $image->name }}" style="height: auto;width: 100%; object-fit: contain;">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                            <div class="" id='image_lists'>
                                                <div class="dropzone w-100" id="footerImageDropzone"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Loader Image:</label>
                                            @if($sites->hasMedia('loader_image'))
                                                <div class="mb-3">
                                                    @foreach($sites->getMedia('loader_image') as $image)
                                                        <div class=" p-3" style="background: #e6dbf8;box-shadow: 0 0rem 4px black;">
                                                            <img src="{{ $image->getUrl() }}" alt="{{ $image->name }}" style="height: auto;width: 100%; object-fit: contain;">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                            <div class="" id='image_lists'>
                                                <div class="dropzone w-100" id="loaderImageDropzone"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Fevicon Images:</label>
                                            @if($sites->hasMedia('fev_image'))
                                                <div class=" mb-3">
                                                    @foreach($sites->getMedia('fev_image') as $image)
                                                        <div class="p-3" style="background: #e6dbf8;box-shadow: 0 0rem 4px black;">
                                                            <img src="{{ $image->getUrl() }}" alt="{{ $image->name }}" style="height: auto;width: 100%; object-fit: contain;">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                            <div class="" id='image_lists'>
                                                <div class="dropzone w-100" id="fevImageDropzone"></div>
                                            </div>
                                        </div>
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
        var header_logo = [];
        var footer_logo = [];
        var loader_image = [];
        var fev_image = [];
        Dropzone.options.headerImageDropzone = {
            url: '{{ route("setting_home.teamImgStore") }}',
            sending: function(file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
            },
            maxFiles:1,
            addRemoveLinks: true, 
            init: function() {
                this.on("removedfile", function(file) {
                    header_logo.splice(header_logo.indexOf(file), 1);
                });
            },
            transformFile: function(file, done) { 
                var headerImageDropzone = this;
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
                    headerImageDropzone.removeFile(file);
                });
                
                
                headerImageDropzone.on("addedfile", function(file) {
                    // Remove the "Remove" button for each file
                    file.previewElement.querySelector(".dz-remove").addEventListener("click", function() {
                        headerImageDropzone.removeFile(file);
                        header_logo.splice(header_logo.indexOf(file), 1);
                    });
                });
                buttonConfirm.addEventListener('click', function() {
                    croppie.result({
                      type:'blob',
                      size: {
                        width: 4000,
                        height: 2000
                      }
                    }).then(function(blob) {
                        headerImageDropzone.createThumbnail(
                            blob,
                            headerImageDropzone.options.thumbnailWidth,
                            headerImageDropzone.options.thumbnailHeight,
                            headerImageDropzone.options.thumbnailMethod,
                            false, 
                            function(dataURL) {
                                // Update the Dropzone file thumbnail
                                headerImageDropzone.emit('thumbnail', file, dataURL);
                                // Return the file to Dropzone
                                header_logo.push(blob);
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
                        width: 600,
                        height: 300
                    }
                  });
                  // Tell Croppie to load the file
                  croppie.bind({
                    url: URL.createObjectURL(file)
                    
                  });
            }
        };
        Dropzone.options.footerImageDropzone = {
            url: '{{ route("setting_home.teamImgStore") }}',
            sending: function(file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
            },
            maxFiles:1,
            addRemoveLinks: true, 
            init: function() {
                this.on("removedfile", function(file) {
                    footer_logo.splice(footer_logo.indexOf(file), 1);
                });
            },
            transformFile: function(file, done) { 
                var footerImageDropzone = this;
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
                    footerImageDropzone.removeFile(file);
                });
                
                
                footerImageDropzone.on("addedfile", function(file) {
                    // Remove the "Remove" button for each file
                    file.previewElement.querySelector(".dz-remove").addEventListener("click", function() {
                        footerImageDropzone.removeFile(file);
                        footer_logo.splice(footer_logo.indexOf(file), 1);
                    });
                });
                buttonConfirm.addEventListener('click', function() {
                    croppie.result({
                      type:'blob',
                      size: {
                        width: 4000,
                        height: 2000
                      }
                    }).then(function(blob) {
                        footerImageDropzone.createThumbnail(
                            blob,
                            footerImageDropzone.options.thumbnailWidth,
                            footerImageDropzone.options.thumbnailHeight,
                            footerImageDropzone.options.thumbnailMethod,
                            false, 
                            function(dataURL) {
                                // Update the Dropzone file thumbnail
                                footerImageDropzone.emit('thumbnail', file, dataURL);
                                // Return the file to Dropzone
                                footer_logo.push(blob);
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
                        width: 600,
                        height: 300
                    }
                  });
                  // Tell Croppie to load the file
                  croppie.bind({
                    url: URL.createObjectURL(file)
                    
                  });
            }
        };
        Dropzone.options.loaderImageDropzone = {
            url: '{{ route("setting_home.teamImgStore") }}',
            sending: function(file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
            },
            maxFiles:1,
            addRemoveLinks: true, 
            init: function() {
                this.on("removedfile", function(file) {
                    loader_image.splice(loader_image.indexOf(file), 1);
                });
            },
            transformFile: function(file, done) { 
                var loaderImageDropzone = this;
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
                    loaderImageDropzone.removeFile(file);
                });
                
                
                loaderImageDropzone.on("addedfile", function(file) {
                    // Remove the "Remove" button for each file
                    file.previewElement.querySelector(".dz-remove").addEventListener("click", function() {
                        loaderImageDropzone.removeFile(file);
                        loader_image.splice(loader_image.indexOf(file), 1);
                    });
                });
                buttonConfirm.addEventListener('click', function() {
                    croppie.result({
                      type:'blob',
                      size: {
                        width: 4000,
                        height: 4000
                      }
                    }).then(function(blob) {
                        loaderImageDropzone.createThumbnail(
                            blob,
                            loaderImageDropzone.options.thumbnailWidth,
                            loaderImageDropzone.options.thumbnailHeight,
                            loaderImageDropzone.options.thumbnailMethod,
                            false, 
                            function(dataURL) {
                                // Update the Dropzone file thumbnail
                                loaderImageDropzone.emit('thumbnail', file, dataURL);
                                // Return the file to Dropzone
                                loader_image.push(blob);
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
                        width: 300,
                        height: 300
                    }
                  });
                  // Tell Croppie to load the file
                  croppie.bind({
                    url: URL.createObjectURL(file)
                    
                  });
            }
        };
        Dropzone.options.fevImageDropzone = {
            url: '{{ route("setting_home.teamImgStore") }}',
            sending: function(file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
            },
            maxFiles:1,
            addRemoveLinks: true, 
            init: function() {
                this.on("removedfile", function(file) {
                    fev_image.splice(fev_image.indexOf(file), 1);
                });
            },
            transformFile: function(file, done) { 
                var fevImageDropzone = this;
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
                    fevImageDropzone.removeFile(file);
                });
                
                
                fevImageDropzone.on("addedfile", function(file) {
                    // Remove the "Remove" button for each file
                    file.previewElement.querySelector(".dz-remove").addEventListener("click", function() {
                        fevImageDropzone.removeFile(file);
                        fev_image.splice(fev_image.indexOf(file), 1);
                    });
                });
                buttonConfirm.addEventListener('click', function() {
                    croppie.result({
                      type:'blob',
                      size: {
                        width: 192,
                        height: 192
                      }
                    }).then(function(blob) {
                        fevImageDropzone.createThumbnail(
                            blob,
                            fevImageDropzone.options.thumbnailWidth,
                            fevImageDropzone.options.thumbnailHeight,
                            fevImageDropzone.options.thumbnailMethod,
                            false, 
                            function(dataURL) {
                                // Update the Dropzone file thumbnail
                                fevImageDropzone.emit('thumbnail', file, dataURL);
                                // Return the file to Dropzone
                                fev_image.push(blob);
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
                        width: 192,
                        height: 192
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
                formData.append('header_logo',header_logo[0]);
                formData.append('footer_logo',footer_logo[0]);
                formData.append('loader_image',loader_image[0]);
                formData.append('fev_image',fev_image[0]);
                
              // Make AJAX request
              $.ajax({
                  url: "{{ route('setting_site.update', '1') }}",
                  type: 'POST',
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function (data) {
                      
                      if (data.success) {
                            window.location = "{{ URL::to('/admin/setting_site') }}";
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
