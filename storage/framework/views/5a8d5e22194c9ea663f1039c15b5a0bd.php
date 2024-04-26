
<?php $__env->startSection('title', 'Home For Rent'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">   
<style>
  .truncate-text {
    max-width: 150px;
    /* Adjust the maximum width according to your design */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .nav-item {
    width: 20%;
    text-align: center;
  }
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
<h2>Data of <span>Home For Rent</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Properties</li>
<li class="breadcrumb-item active">Home For Rent</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
  <div class="card">
    <form action="<?php echo e(route('gallery.store')); ?>" method="post" enctype="multipart/form-data" class="dropzone w-100" id="image-upload">
        <?php echo csrf_field(); ?>
        <!--<div>-->
            <div class="dz-default dz-message m-0">
                <i class="icon-cloud-up" style="font-size: 30px;"></i>
                <h6 class="mb-0">Drop files here or click to upload.</h6>
            </div>
            <!--<h3>Upload Multiple Image By Click On Box</h3>-->
        <!--</div>-->
    </form>

  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h5>IMAGE GALLERY</h5>
        </div>
        <div class="my-gallery card-body row" id="image-gallery" itemscope="">
            <?php $__currentLoopData = $model->getMedia('gallery'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xl-3 col-md-4 col-sm-6 col-12 mt-4">
                    <img class="img-thumbnail " src="<?php echo e($media->getUrl()); ?>" itemprop="thumbnail" alt="Image description" style="height: 200px; width: 100%; object-fit:cover;">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Set up Dropzone
    Dropzone.options.imageUpload = {
        success: function(file, response) {
            // On successful upload, update the image gallery using Ajax
            $.ajax({
                url: '<?php echo e(route("gallery.getImages")); ?>',
                method: 'GET',
                success: function(data) {
                    $('#image-gallery').html(data);
                }
            });
        }
    };
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/backend/gallery/index.blade.php ENDPATH**/ ?>