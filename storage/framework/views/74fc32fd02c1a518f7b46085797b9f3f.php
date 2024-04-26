<?php $__env->startSection('title', 'Edit Home For Rent'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(route('/')); ?>/assets/css/select2.css">
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h2>Edit<span>Home For Rent</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">Properties</li>
    <li class="breadcrumb-item">Manage Homes</li>
    <a href="<?php echo e(route('home_for_rent.index')); ?>" class="breadcrumb-item">Home For Rent</a> 
    <li class="breadcrumb-item active justify-content-between align-items-center text-nowrap"><i data-feather="edit" style="width: 12%;"></i> <?php echo e($homeDetails->property_name); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Home For Rent</h5>
                    </div>
                    <div class="card-body add-post">
                       
                        <form class="row needs-validation themeform" method="post" action="<?php echo e(Route('home_for_rent.update',$homeDetails->id)); ?>" enctype="multipart/form-data" id="package_form">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="col-sm-8">
                                <input type="hidden" value="rent" name="home_for">
                                <input type="hidden" name="status" id="selectedStatus" value="<?php echo e($homeDetails->status); ?>">
                                <div class="form-group">
                                    <label for="property_name">Name Of Property:</label>
                                    <input class="form-control" id="property_name" type="text" placeholder="Enter Name of Property" name="property_name" value="<?php echo e(old('property_name', $homeDetails->property_name)); ?>">
                                    <span class="text-danger" id="property_name-error"></span>
                                </div>
                                <div class="form-group">
                                    <label>Address:</label>
                                    <textarea id="address" name="address" rows="4" placeholder="Enter a Address" class="form-control" required><?php echo e(old('address', $homeDetails->address)); ?></textarea>
                                    <span class="text-danger" id="address-error"></span>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group m-form__group">
                                            <label>Price:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">USD</span>
                                                    <input class="form-control" id="price" type="number" placeholder="Enter Price" name="price" value="<?php echo e(old('price', $homeDetails->price)); ?>">
                                                </div>
                                            </div>
                                            <span class="text-danger" id="price-error"></span>
                                        </div>  
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bedrooms:</label>
                                            <input class="form-control" id="badrooms" type="number" placeholder="Enter Bedrooms" name="badrooms" value="<?php echo e(old('badrooms', $homeDetails->bedrooms)); ?>">
                                            <span class="text-danger" id="badrooms-error"></span>
                                        </div>  
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bathrooms:</label>
                                            <input class="form-control" id="bathroom" type="number" placeholder="Enter bathroom" name="bathroom" value="<?php echo e(old('bathroom', $homeDetails->bathrooms)); ?>">
                                            <span class="text-danger" id="bathroom-error"></span>
                                        </div>  
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 d-flex">
                                        <div class="form-group">
                                            <label>Total SqFT:</label>
                                            <div class="d-flex align-items-center">
                                                <input class="form-control" id="price" type="text" name="sqft_width" value="<?php echo e(old('sqft_width', $homeDetails->sqft_width)); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea id="description" rows="4"  class="form-control" name="description" rows="4" placeholder="Enter a Description"><?php echo e(old('description', $homeDetails->description)); ?></textarea>
                                    <span class="text-danger" id="description-error"></span>
                                </div>
                                <div class="form-group">
                                    <label>Short Description:</label>
                                    <textarea id="short_description" name="short_description" rows="4" placeholder="Enter a Short Description"
                                        class="form-control"><?php echo e(old('short_description', $homeDetails->sub_description)); ?></textarea>
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
                                                value="<?php echo e(old('facebook', $homeDetails->facebook)); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="instagram">Instagram Link</label>
                                            <input class="form-control" id="instagram" type="url"
                                                placeholder="Enter Your instagram Link" name="instagram"
                                                value="<?php echo e(old('instagram', $homeDetails->instagram)); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="skype">Skype Link</label>
                                            <input class="form-control" id="skype" type="url"
                                                placeholder="Enter Your Skype Link" name="skype"
                                                value="<?php echo e(old('skype', $homeDetails->skype)); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="twitter">Twitter Link</label>
                                            <input class="form-control" id="twitter" type="url"
                                                placeholder="Enter Your Twitter Link" name="twitter"
                                                value="<?php echo e(old('twitter', $homeDetails->twitter)); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="validationCustom01">Property Location:</label>
                                    <input class="form-control" type="text" placeholder="Embed Map Here" name="property_location" value="<?php echo e(old('property_location', $homeDetails->property_location)); ?>">
                                </div>

                            </div>
                            <div class="col-sm-4">
                                <?php
                                    switch ($homeDetails->home_type) {
                                        case 'houses':
                                            $home_type_name = "Houses";
                                            $home_type_value = "houses";
                                            break;
                                        case 'apartments':
                                            $home_type_name = "Apartments";
                                            $home_type_value = "apartments";
                                            break;
                                        case 'townhomes':
                                            $home_type_name = "Townhomes";
                                            $home_type_value = "townhomes";
                                            break;
                                        default:
                                            $home_type_name = "Houses";
                                            $home_type_value = "houses";
                                            break;
                                    }
                                ?>
                                <div class="form-group">
                                    <label>Home Type:</label>
                                    <div class="custom-dropdown custom-dropdown-3">
                                        <input type="hidden" name="home_type" id="selectedHomeType" value="<?php echo e($home_type_value); ?>">
                                        <div class="dropdown-toggle dropdown-toggle-3 form-control" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?php echo e($home_type_name); ?>

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
                                    <?php if($homeDetails->main_image): ?>
                                        <div class="my-1"> 
                                            <img src="<?php echo e(asset('public/images/' . $homeDetails->main_image)); ?>" alt="Main Image Preview" style="height: 100px;width: 200px;">
                                        </div>
                                    <?php endif; ?>
                                    <div class="" id='image_lists'>
                                        <div class="dropzone w-100" id="mainImageDropzone"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Other Images: ( 450 X 450 )</label>
                                    <div class="d-flex flex-wrap gap-3">
                                        <?php $__currentLoopData = $homeDetails->getMedia('images'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="d-flex flex-column">
                                                <img src="<?php echo e($image->getUrl()); ?>" alt="<?php echo e($image->name); ?>" style="height: 100px;width: 100px;">
                                                <a href="javascript:void(0);" class="text-center remove-image" data-image-id="<?php echo e($image->id); ?>">Remove</a>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <div class="" id='image_lists'>
                                        <div class="dropzone w-100" id="myDropzone"></div>
                                    </div>
                                    
                                    <input type="hidden" id="removedImageIds" name="removed_image_ids" value="">    
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(route('/')); ?>/assets/js/select2/select2.full.min.js"></script>
    <!--<script src="<?php echo e(route('/')); ?>/assets/js/select2/select2-custom.js"></script>-->
    <!--<script src="<?php echo e(route('/')); ?>/assets/js/dropzone/dropzone.js"></script>-->
    <!--<script src="<?php echo e(route('/')); ?>/assets/js/dropzone/dropzone-script.js"></script>-->
    <script src="<?php echo e(route('/')); ?>/assets/js/chat-menu.js"></script>
    <!--<script src="<?php echo e(route('/')); ?>/assets/js/email-app.js"></script>-->
    <script src="<?php echo e(route('/')); ?>/assets/js/form-validation-custom.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/editor/ckeditor/ckeditor.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/editor/ckeditor/styles.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/editor/ckeditor/adapters/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://unpkg.com/croppie"></script>
  <script>
        $(document).ready(function() {
            CKEDITOR.replace('description');
        });
    </script>
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
        url: '<?php echo e(route("home_for_rent.imgStore")); ?>',
        sending: function(file, xhr, formData) {
            formData.append("_token", "<?php echo e(csrf_token()); ?>");
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
    Dropzone.options.mainImageDropzone = {
        url: '<?php echo e(route("home_for_rent.imgStore")); ?>',
        sending: function(file, xhr, formData) {
            formData.append("_token", "<?php echo e(csrf_token()); ?>");
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
            var descriptionData = CKEDITOR.instances.description.getData();
                formData.append('description', descriptionData);
          // Make AJAX request
          $.ajax({
              url: "<?php echo e(route('home_for_rent.update',$homeDetails->id)); ?>",
              type: 'POST',
              data: formData,
              headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                
            },
              cache: false,
              contentType: false,
              processData: false,
              success: function (data) {
                  
                    if (data.success) {
                        window.location = "<?php echo e(URL::to('/admin/home_for_rent')); ?>";
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
<script>
        $(document).ready(function() {
              var imageCounter = 1; // Initialize a counter for unique IDs

                $("#add_image").click(function() {
                    var uniqueId = "before_crop_image_" + imageCounter;
                    var fileInputForm =
                                '<div class="row mb-3">' +
                                        '<div class="col-5">'+
                                            '<input type="type" name="title[]" class="form-control h-100" id="title" placeholder="Enter Title">'+ 
                                        '</div>'+
                                        '<div class="col-5">'+
                                            '<input type="file" name="resources_images[]"  class="form-control" id="resources_images">'+ 
                                        '</div>'+
                                        '<div class="col-2 p-0 d-flex">'+
                                            '<button type="button" class="text-danger btn p-0 remove_image"><i class="pe-7s-trash" style="font-size: 25px;"></i></button>'+
                                        '</div>'+
                                    '</div>';
                    $("#image_lists").append(fileInputForm);
            
                    // Increment the counter for the next unique ID
                    imageCounter++;
                });
          
            /* this event will serve as removing of new added file input */
            $("body").delegate(".remove_image", "click", function(){
              $(this).parent().parent().remove();
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/backend/rent/edit.blade.php ENDPATH**/ ?>