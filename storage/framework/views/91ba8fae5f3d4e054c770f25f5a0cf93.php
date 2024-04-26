<?php $__env->startSection('title', 'Add Home For Rent'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(route('/')); ?>/assets/css/select2.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(route('/')); ?>/assets/css/dropzone.css">
    <style>
    label.error{
        margin: 0px !important;
        color: #fd517d !important;
    }
    .error{
        margin: 0px !important;
    }
    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h2>Add<span>Home For Rent</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">Properties</li>
    <a href="<?php echo e(route('home_for_rent.index')); ?>" class="breadcrumb-item">Home For Rent</a> 
    <li class="breadcrumb-item active">Add</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Add Home For Rent </h5>
                    </div>
                    <div class="card-body add-post">
                        
                        <form class="row themeform"  method="post" action="<?php echo e(route('home_for_rent.store')); ?>" enctype="multipart/form-data" id="addHomeForRentForm">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('post'); ?> <!-- Add this line to set the correct HTTP method -->

                            <div class="col-sm-8">
                                <input type="hidden" value="rent" name="home_for">
                                <div class="form-group">
                                    <label for="property_name">Name Of Property:</label>
                                    <input class="form-control" id="property_name" type="text"
                                        placeholder="Enter Name of Property" name="property_name" value="<?php echo e(old('property_name')); ?>" >

                                </div>
                                <div class="form-group">
                                    <label>Address:</label>
                                    <textarea id="address" name="address" rows="4" placeholder="Enter a Address" class="form-control" required><?php echo e(old('address')); ?></textarea>

                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea id="description" class="rounded" name="description" required><?php echo e(old('description')); ?></textarea>

                                </div>
                                <div class="form-group">
                                    <label>Sort Description:</label>
                                    <textarea id="short_description" name="short_description" rows="4" placeholder="Enter a Sort Description" class="form-control" ><?php echo e(old('short_description')); ?></textarea>
                                    <span class="text-danger" id="description-error"></span>

                                </div>
                                <div class="form-group">
                                    <label for="brochure">Brochure PDF (if available):</label>
                                    <input type="file" class="form-control" id="brochure" name="brochure" accept=".pdf">
                                 </div>
                                 <div class="form-group">
                                    <label for="validationCustom01">Property Location:</label>
                                    <input class="form-control" type="text"
                                        placeholder="Embed Map Here" name="property_location"
                                        value="<?php echo e(old('property_location')); ?>">
                              
                                </div>
                                  
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Status:</label>
                                    <div class="custom-dropdown">
                                        <input type="hidden" name="status" id="selectedStatus" value="draft">
                                        <div class="dropdown-toggle form-control" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Draft
                                        </div>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <div class="dropdown-item" data-value="draft"><i class="fas fa-draft"></i> Draft</div>
                                            <div class="dropdown-item" data-value="review"><i class="fas fa-review"></i> Ready For Review</div>
                                            <?php if(Auth::user()->type == 'admin'): ?>
                                                <div class="dropdown-item" data-value="publish"><i class="fas fa-publish"></i> Publish</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                  
                                 </div>

                                <div class="form-group">
                                    <label>Main Image: ( 810 X 400 )</label>
                                    <input type="file" class="form-control" id="main_image" name="main_image" onchange="preview_images1();" />
                                    <div class="row" id="image_preview1"></div>
                                   
                                </div>
                                <div class="form-group">
                                    <label>Other Images: (450 X 450)</label>
                                    <input type="file" class="form-control" id="images" name="images[]" onchange="preview_images(this);" multiple/>
                                    <div class="row" id="image_preview"></div>
                            
                                </div>
                                
                            </div>
                            
                            
                            
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(route('/')); ?>/assets/js/select2/select2.full.min.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/select2/select2-custom.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/dropzone/dropzone.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/dropzone/dropzone-script.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/chat-menu.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/email-app.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/form-validation-custom.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/editor/ckeditor/ckeditor.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/editor/ckeditor/styles.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/editor/ckeditor/adapters/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('description');
        });
    </script>
    <script>
    // Make sure to include the Dropzone and any other  libraries

    // Initialize Dropzone for video upload
    Dropzone.options.multiVideoUpload = {
        paramName: "videos", // The name that will be used to transfer the file
        acceptedFiles: "video/*", // Only allow video files
        maxFilesize: 512, // Set an appropriate maximum file size in megabytes
        addRemoveLinks: true, // Allow removing files from the upload queue

        init: function () {
            this.on("addedfile", function (file) {
                // Display a video preview thumbnail (basic example)
                var videoPreview = document.createElement("video");
                videoPreview.controls = true;
                videoPreview.style.width = "100%";
                videoPreview.style.maxHeight = "200px"; // Set an appropriate max height
                var videoUrl = URL.createObjectURL(file);
                videoPreview.src = videoUrl;
                
                // Append the video preview to the container
                document.getElementById("videoPreviewContainer").appendChild(videoPreview);
            });

            this.on("removedfile", function (file) {
                // Remove the video preview when a file is removed
                var videoPreviewContainer = document.getElementById("videoPreviewContainer");
                while (videoPreviewContainer.firstChild) {
                    videoPreviewContainer.removeChild(videoPreviewContainer.firstChild);
                }
            });
        }
    };
</script>


<!-- Add the following script at the end of your file -->
<script>
    $(document).ready(function() {
        $('.custom-dropdown').on('click', '.dropdown-item', function() {
            var selectedValue = $(this).data('value');
            $('#selectedStatus').val(selectedValue);
            $('.dropdown-toggle').html($(this).html());
        });

        $('.custom-dropdown').on('click', function() {
            $(this).toggleClass('active');
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.custom-dropdown').length) {
                $('.custom-dropdown').removeClass('active');
            }
        });
    });
</script>

<script>
 
            function preview_images(input) {
        
                console.log(input);
                // Clear the existing images
                $("#image_preview").empty();
        
                var total_file = input.files.length;
                for (var i = 0; i < total_file; i++) {
                    var imageSrc = URL.createObjectURL(input.files[i]);
                    var imageElement = `<div class='col-md-6 mt-3 text-center'>
                                            <img style='width:100%' class='img-responsive' src='${imageSrc}' data-order='${i}'>${i}
                                            <button type='button' class='btn btn-danger btn-sm mt-2 px-1 py-0 rounded-pill' onclick='removeImage(this, ${i})'>Remove ${i}</button>
                                        </div>`;
                    $('#image_preview').append(imageElement);
                }
        
                // Sort images based on the 'data-order' attribute
                sortImages();
            }
        
            function removeImage(button, order) {
                // Remove the image and button associated with the specified order
                $(button).parent().remove();
    
            
                // Remove the corresponding file input
                var fileInput = document.getElementById("images");
                var files = Array.from(fileInput.files);
                console.log(files);
                files.splice(order, 1); // Remove the file at the specified order
            
                // Create a new FileList with the updated files
                var newFileList = new DataTransfer();
                files.forEach(function (file) {
                    newFileList.items.add(file);
                });
                
                console.log(newFileList);
                // Update the file input's files
                fileInput.files = newFileList.files;
            
                // Sort images again after removal
                sortImages();
            }
    
        
            function sortImages() {
                // Update the 'data-order' attribute based on the current order of images
                $("#image_preview div").each(function (index) {
                    $(this).find("img").attr("data-order", index);
                    console.log(index);
                });
            }
    
    
    
    
// function sortImages() {
//     var imagePreview = $("#image_preview");
//     var images = imagePreview.children('.col-md-6');

//     images.sort(function(a, b) {
//         var orderA = $(a).find('img').data('order');
//         var orderB = $(b).find('img').data('order');
//         return orderA - orderB;
//     });

//     imagePreview.empty().append(images);
// }
function preview_images1() {
    // Clear the existing images
    $("#image_preview1").empty();

    var total_file = document.getElementById("main_image").files.length;
    for (var i = 0; i < total_file; i++) {
        var imageSrc = URL.createObjectURL(event.target.files[i]);
        var imageElement = `<div class='col-md-6 mt-3'>
                                <img style='width:100%' class='img-responsive' src='${imageSrc}'>
                            </div>`;
        $('#image_preview1').append(imageElement);
    }
}
</script>
<script>
$(document).ready(function () {
            // Add validation rules and messages
            $("#addHomeForRentForm").validate({
                rules: {
                    property_name: {
                        required: true,
                        maxlength: 255 // Adjust as needed
                    },
                    address: {
                        required: true,
                        maxlength: 100 // Adjust as needed
                    },
                    description: {
                    },
                    short_description: {
                        maxlength: 100 // Adjust as needed
                    },
                    brochure: {
                    },
                    status: {
                        required: true,
                    },
                    'images[]': {
                        required: true,
                       // imageDimensions: [450, 450] // Custom method for image dimensions
                    },
                    property_location: {  
                    },
                    main_image: {
                        required: true,
                        // imageDimensions: [810, 400]
                        // Define rules for main_image
                    },
                },
                messages: {
                    property_name: {
                        required: "Please enter the property name",
                        maxlength: "Maximum length is 255 characters"
                    },
                    address: {
                        required: "Please enter the address",
                        maxlength: "Maximum length is 100 characters"
                    },
                    description: {
                    },
                    short_description: {
                        maxlength: "Maximum length is 100 characters"
                    },
                    main_image: {
                        //required: "Please select the main image",
                        //imageDimensions: "Image dimensions must be 810x400 pixels"
                    },
                    'images[]': {
                        //required: "Please select an image",
                        //imageDimensions: "Image dimensions must be 450x450 pixels"
                    },
                    // Add messages for other fields as needed
                },
               
            });
            $.validator.addMethod('ckeditorRequired', function (value, element) {
                var ckeditorContent = CKEDITOR.instances['description'].getData().trim();
                return ckeditorContent !== '';
            }, 'Please enter the description');
           $.validator.addMethod('imageDimensions', function (value, element, dimensions) {
                var width = dimensions[0];
                var height = dimensions[1];

                // Check if the file is an image
                if (element.files && element.files[0]) {

                    if (element.files[0].type.match(/^image\//)) {
                        var img = new Image();

                        // Set up the onload event to ensure the image is fully loaded
                        img.onload = function () {
                            //console.log(img.width === width && img.height === height);
                            // Validate image dimensions
                            if (img.width === width && img.height === height) {
                                // Image dimensions are valid
                                // Trigger revalidation (this is required when using jQuery Validate)
                                $(element).valid();
                            }
                        };

                        // Set the image source after setting up the onload event
                        img.src = window.URL.createObjectURL(element.files[0]);
                    }
                }

                // If the element is not an image or doesn't have a file, consider it valid
                return true;
            }, 'Image dimensions must be {0}x{1} pixels.');

        });
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\stage\resources\views/backend/rent/create.blade.php ENDPATH**/ ?>