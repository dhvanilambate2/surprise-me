<?php $__env->startSection('title', 'Add Home For Sale'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(route('/')); ?>/assets/css/select2.css">

<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<link href="https://unpkg.com/croppie/croppie.css" rel="stylesheet"/>

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
    <h2>Add<span>Home For Sale</span></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">Properties</li>
    <a href="<?php echo e(route('home_for_sale.index')); ?>" class="breadcrumb-item">Home For Sale</a> 
    <li class="breadcrumb-item active">Add</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Add Home For Sale </h5>
                    </div>
                    <div class="card-body add-post">
                        
                        <div class="dropzone" id="myDropzone"></div>
  
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="https://unpkg.com/croppie"></script>
<script>
Dropzone.options.myDropzone = {
 url: '/post',
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
        buttonConfirm.style.top = '10px';
        buttonConfirm.style.zIndex = 9999;
        buttonConfirm.textContent = 'Confirm';
        editor.appendChild(buttonConfirm);
        buttonConfirm.addEventListener('click', function() {
            croppie.result({
              type:'blob',
              size: {
                width: 256,
                height: 256
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
                        done(blob);
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
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/backend/sale/create.blade.php ENDPATH**/ ?>