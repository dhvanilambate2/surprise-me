<?php $__currentLoopData = $model->getMedia('gallery'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-xl-3 col-md-4 col-6">
        <img class="img-thumbnail" src="<?php echo e($media->getUrl()); ?>" itemprop="thumbnail" alt="Image description">
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/backend/gallery/images.blade.php ENDPATH**/ ?>