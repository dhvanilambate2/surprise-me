<?php $__env->startSection('title', 'Add Team'); ?>

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
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h2>Add<span>Team</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">Setting</li>
    <a href="<?php echo e(route('setting_home.index')); ?>" class="breadcrumb-item">Home Page</a>
    <li class="breadcrumb-item active">Add</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Add Team</h5>
                    </div>
                    <div class="card-body add-post">
                        
                        <form class="row needs-validation themeform" method="post" action="<?php echo e(route('setting_home.team_store')); ?>"
                            enctype="multipart/form-data" id="package_form">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('post'); ?> <!-- Add this line to set the correct HTTP method -->

                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" id="name" type="text" placeholder="Enter Name"
                                        name="name" value="<?php echo e(old('name')); ?>">
                                        <span class="text-danger" id="name-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="post">Post</label>
                                    <input class="form-control" id="post" type="text" placeholder="Enter Post"
                                        name="post" value="<?php echo e(old('post')); ?>">
                                        <span class="text-danger" id="post-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea id="description" class="rounded" name="description"><?php echo e(old('description')); ?></textarea>
                                    <span class="text-danger" id="description-error"></span>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label for="facebook">Facebook Link</label>
                                            <input class="form-control" id="facebook" type="url"
                                                placeholder="Enter Your Facebook Link" name="facebook"
                                                value="<?php echo e(old('facebook')); ?>">
                                            <span class="text-danger" id="facebook-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="skype">Skype Link</label>
                                            <input class="form-control" id="skype" type="url"
                                                placeholder="Enter Your Skype Link" name="skype"
                                                value="<?php echo e(old('skype')); ?>">
                                            <span class="text-danger" id="skype-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="twitter">Twitter Link</label>
                                            <input class="form-control" id="twitter" type="url"
                                                placeholder="Enter Your Twitter Link" name="twitter"
                                                value="<?php echo e(old('twitter')); ?>">
                                            <span class="text-danger" id="twitter-error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Team Member Image: </label>
                                    <div class="" id='image_lists'>
                                        <div class="dropzone w-100" id="teamImageDropzone"></div>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(route('/')); ?>/assets/js/select2/select2.full.min.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/select2/select2-custom.js"></script>
    <!--<script src="<?php echo e(route('/')); ?>/assets/js/dropzone/dropzone.js"></script>-->
    <!--<script src="<?php echo e(route('/')); ?>/assets/js/dropzone/dropzone-script.js"></script>-->
    <script src="<?php echo e(route('/')); ?>/assets/js/chat-menu.js"></script>
    <script src="<?php echo e(route('/')); ?>/assets/js/email-app.js"></script>
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
    var images = [];
        Dropzone.options.teamImageDropzone = {
            url: '<?php echo e(route("setting_home.teamImgStore")); ?>',
            sending: function(file, xhr, formData) {
                formData.append("_token", "<?php echo e(csrf_token()); ?>");
            },
            maxFiles:1,
            addRemoveLinks: true, 
            init: function() {
                this.on("removedfile", function(file) {
                    images.splice(images.indexOf(file), 1);
                });
            },
            transformFile: function(file, done) { 
                var teamImageDropzone = this;
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
                    teamImageDropzone.removeFile(file);
                });
                
                teamImageDropzone.on("addedfile", function(file) {
                    // Remove the "Remove" button for each file
                    file.previewElement.querySelector(".dz-remove").addEventListener("click", function() {
                        teamImageDropzone.removeFile(file);
                        images.splice(images.indexOf(file), 1);
                    });
                });
                
                buttonConfirm.addEventListener('click', function() {
                    croppie.result({
                      type:'blob',
                      size: {
                        width: 1245,
                        height: 1867
                      }
                    }).then(function(blob) {
                        teamImageDropzone.createThumbnail(
                            blob,
                            teamImageDropzone.options.thumbnailWidth,
                            teamImageDropzone.options.thumbnailHeight,
                            teamImageDropzone.options.thumbnailMethod,
                            false, 
                            function(dataURL) {
                                // Update the Dropzone file thumbnail
                                teamImageDropzone.emit('thumbnail', file, dataURL);
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
                        width: 320,
                        height: 480
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
                  url: "<?php echo e(route('setting_home.team_store')); ?>",
                  type: 'POST',
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function (data) {
                      
                      if (data.success) {
                            window.location = "<?php echo e(URL::to('/admin/setting_home')); ?>";
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/backend/setting/home/team_create.blade.php ENDPATH**/ ?>