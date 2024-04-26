<?php $__env->startSection('content'); ?>

   
<!--==  
    <!--==============================
    Breadcumb
============================== -->


    <div class="">
        <div class="breadcumb-wrapper mt-4" data-bg-src="<?php echo e(url('frontend')); ?>/assets/img/bg/all-page.png">
            <h1 class="breadcumb-title">Blog Details</h1>
            <ul class="breadcumb-menu d-none">
                <li><a href="index.php        ">Home</a></li>
                <li>Project  Details</li>
            </ul>
        </div>
    </div>
    <!--==============================
Service Area
==============================-->
    <section class="space-top space-extra-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="page-single">
                        <div class="page-img">
                            <?php if($blogs->getFirstMediaUrl('blogs')): ?>
                                <img class="w-100" src="<?php echo e($blogs->getFirstMediaUrl('blogs')); ?>" alt="Project Image">
                            <?php else: ?>
                                <img class="w-100" src="<?php echo e(url('frontend')); ?>/assets/img/service/service_details.jpg" alt="Service Image">
                            <?php endif; ?>
                        </div>
                        <h3 class="single-title"><?php echo e($blogs->title); ?></h3>
                        <hr>
                        <div class="service-content">
                            <?php echo $blogs->content; ?>

                           
                            <?php if($blogs->getMedia('blogs')->count() > 1): ?>
                                <h4 class="text-uppercase mb-20">Other Images</h4>
                                <div class="row gy-30">
                                    <?php $__currentLoopData = $blogs->getMedia('blogs'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($index > 0): ?> <!-- Skip the first image -->
                                            <div class="col-md-6">
                                                <img class="w-100" src="<?php echo e($image->getUrl()); ?>" alt="Other Image">
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar-area">
                        
                        
                        <div class="widget">
                            <h3 class="widget_title">Recent Posts</h3>
                            <div class="recent-post-wrap">
                                <?php $__currentLoopData = $latest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latestBlog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a href="<?php echo e(route('blog.details', ['id' => $latestBlog->id])); ?>">
                                            
                                                <img src="<?php echo e($latestBlog->getFirstMediaUrl('blogs')); ?>" alt="Blog Image" style="height: 100px;width: 100px;">
                                            
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="post-title">
                                            <a class="text-inherit" href="<?php echo e(route('blog.details', ['id' => $latestBlog->id])); ?>">
                                                <?php echo e($latestBlog->title); ?>

                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="widget  ">
                            <div class="widget-banner">
                                <h4 class="title" data-bg-src="<?php echo e(url('frontend')); ?>/assets/img/bg/widget_banner.jpg">Best Architecture <br> <span class="text-transparent">Services</span></h4>
                                <div class="content">
                                    <a href="+12345678900" class="link"><i class="fas fa-phone"></i>(123) 4567 8900</a>
                                    <p class="text">Monday – Friday: 7:00 am -8:00 pm 24/7 Emergency Service</p>
                                    <a href="<?php echo e(url('contact')); ?>" class="th-btn"><span class="line left"></span> INQUIRE NOW <span class="line"></span></a>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
    <div class="shape-mockup jump" data-top="0" data-right="0"><img src="<?php echo e(url('frontend')); ?>/assets/img/shape/shape_3.png" alt="shape"></div>

        </div>
    </section><!--==============================
Footer Area
==============================-->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\stage\resources\views/frontend/blog_details.blade.php ENDPATH**/ ?>