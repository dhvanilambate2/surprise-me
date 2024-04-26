<?php $__env->startSection('title', 'Edit Home For Rent'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(route('/')); ?>/assets/css/select2.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(route('/')); ?>/assets/css/dropzone.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h2>Edit<span>Home For Rent</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">Properties</li>
    <a href="<?php echo e(route('home_for_rent.index')); ?>" class="breadcrumb-item">Home For Rent</a> 
    <li class="breadcrumb-item active">Edit</li>
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
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form class="row needs-validation themeform" method="post" action="<?php echo e(Route('home_for_rent.update',$homeDetails->id)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="col-sm-12">
                                <input type="hidden" value="rent" name="home_for">
                                <div class="form-group">
                                    <label for="validationCustom01">Name Of Property:</label>
                                    <input class="form-control" id="validationCustom01" type="text"
                                        placeholder="Enter Name of Property" name="property_name" value="<?php echo e(old('property_name', $homeDetails->property_name)); ?>" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="form-group">
                                    <label>Address:</label>
                                    <textarea id="text-box" name="address" rows="4" placeholder="Enter a Address" class="form-control" required><?php echo e(old('address',$homeDetails->address)); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea id="description" class="rounded" name="description" required><?php echo old('description', $homeDetails->description); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Sort Description:</label>
                                    <textarea id="text-box" name="short_description" rows="4" placeholder="Enter a Address" class="form-control" required><?php echo e(old('short_description',$homeDetails->sub_description)); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="brochure">Brochure PDF (if available):</label>
                                    <input type="file" class="form-control" id="brochure" name="brochure" accept=".pdf">
                                 </div>
                                  <div class="form-group">
                                    <label for="validationCustom01">Property Location:</label>
                                    <input class="form-control" type="text"
                                        placeholder="Enter Name of Property" name="property_location" value="<?php echo e(old('property_location', $homeDetails->property_location)); ?>">
                                </div>
                                  <div class="form-group">
                                    <label>Status:</label>
                                    <div class="m-checkbox-inline">
                                        <label for="draft">
                                            <input class="radio_animated" value="draft" id="draft" type="radio" name="status" <?php if($homeDetails->status == 'draft'): ?> checked <?php endif; ?>>Draft
                                        </label>
                                        <label for="review">
                                            <input class="radio_animated" value="review" id="review" type="radio" name="status" <?php if($homeDetails->status == 'review'): ?> checked <?php endif; ?>>Ready For Review
                                        </label>
                                         <?php if(Auth::user()->type == 'admin'): ?>
                                        <label for="publish">
                                            <input class="radio_animated" value="publish" id="publish" type="radio" name="status" <?php if($homeDetails->status == 'publish'): ?> checked <?php endif; ?>>Publish
                                        </label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <label>Main Image:</label>
                           <div class="dropzone digits w-100">
                                <input type="file" name="main_image" id="main_image" accept="image/*" >
                                <div id="imagePreviewContainer">
                                    <!-- Display the current main image if available -->
                                    <?php if($homeDetails->main_image): ?>
                                        <img src="<?php echo e(asset('public/images/' . $homeDetails->main_image)); ?>" alt="Main Image Preview" style="height: 100px;width: 100px;">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="dropzone digits w-100">
                                <input type="file" id="multiFileUpload"  name="images[]" multiple >
                                <div id="imagePreviewContainer">
                                    <?php if($homeDetails->hasMedia('images')): ?>
                                    <div class="d-flex mt-3">
                                        <?php $__currentLoopData = $homeDetails->getMedia('images'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="d-flex flex-column">
                                                <img src="<?php echo e($image->getUrl()); ?>" alt="<?php echo e($image->name); ?>" style="height: 100px;width: 100px;">
                                                <a href="javascript:void(0);" class="text-center remove-image" data-image-id="<?php echo e($image->id); ?>">Remove</a>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            
                            <input type="hidden" id="removedImageIds" name="removed_image_ids" value="">

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


<!-- Add the following script at the end of your file -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\stage\resources\views/backend/rent/edit.blade.php ENDPATH**/ ?>