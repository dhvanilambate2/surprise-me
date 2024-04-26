

<?php $__env->startSection('content'); ?>

<!--==============================
    Breadcumb
============================== -->
<div class="">
    <div class="breadcumb-wrapper  mt-4" data-bg-src="<?php echo e(url('frontend')); ?>/assets/img/bg/all-page.png">
        <h1 class="breadcumb-title">Blogs</h1>
        <ul class="breadcumb-menu d-none">
            <li><a href="index.php">Home</a></li>
            <li>Blogs</li>
        </ul>
    </div>
</div>
<!--==============================
Gallery Area  
==============================-->
<div class="space">
    <div class="container">
        
        <div class="row">
            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="blog-grid">
                        <div class="blog-img">
                            <img src="<?php echo e($item->getFirstMediaUrl('blogs')); ?>" alt="blog image" style="width: 450px; height: 450px;">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta style2">
                                <a href="<?php echo e(route('blog.details', ['id' => $item->id])); ?>">Architecture</a>
                                <a href="<?php echo e(route('blog.details', ['id' => $item->id])); ?>">February 15, 2023</a>
                            </div>
                            <p class="blog-text"><?php echo e($item->title); ?></p>
                            <a href="<?php echo e(route('blog.details', ['id' => $item->id])); ?>" class="link-btn">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
            </div>  
       
        <div class="text-center mt-5 pt-4">
            <a href="<?php echo e(url('blog')); ?>" class="th-btn"><span class="line left"></span> Load More <span class="line"></span></a>
        </div>
    <div class="shape-mockup jump" data-top="0" data-right="0"><img src="<?php echo e(url('frontend')); ?>/assets/img/shape/shape_3.png" alt="shape"></div>

    </div>
</div><!--==============================
Footer Area
==============================-->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/frontend/blog.blade.php ENDPATH**/ ?>