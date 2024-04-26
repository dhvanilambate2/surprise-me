<?php $__env->startSection('content'); ?>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css"/>
<style>
  .owl-carousel {
    position: relative;
  }

  .owl-carousel .item {
    padding: 1rem;
  }

  .owl-carousel .owl-nav {
    position: absolute;
    top: 35%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center; /* Center vertically */
    transform: translateY(0%);
  }

  .owl-carousel .owl-nav button {
    background: transparent;
    border: none;
    font-size: 16px; /* Adjust the font size for the buttons */
    color: #FFF;
    height: 32px; /* Set the height for rounded appearance */
    width: 32px;  /* Set the width for rounded appearance */
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
  }
  
  .owl-carousel .owl-nav button.owl-next, 
  .owl-carousel .owl-nav button.owl-prev {
    background-color: white !important;
    border-radius: 50%; /* Make it circular */
  }
  
  .owl-carousel .owl-nav button.owl-prev:hover {
     color:#B0B0B0;
  }
  
  .owl-carousel .owl-nav button.owl-next:hover {
     color:#B0B0B0;
  }
  
  .owl-theme .owl-dots, .owl-theme .owl-nav {
    text-align: center;
    -webkit-tap-highlight-color: transparent;
    margin-bottom: -10px; /* Adjust the margin to decrease space */
  }
</style>

   
<!--==  
    <!--==============================
    Breadcumb
============================== -->


    <div class="">
        <div class="breadcumb-wrapper mt-4" data-bg-src="<?php echo e(url('frontend')); ?>/assets/img/bg/all-page.png">
            <h1 class="breadcumb-title">Blog Details</h1>
            <ul class="breadcumb-menu">
                <li><a href="<?php echo e(url('blog')); ?>">Blogs</a></li>
                <li><?php echo e($blogs->title); ?></li>
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

                           
                            <!--<?php if($blogs->getMedia('blogs')->count() > 1): ?>-->
                            <!--    <h4 class="text-uppercase mb-20">Other Images</h4>-->
                            <!--    <div class="row gy-30">-->
                            <!--        <?php $__currentLoopData = $blogs->getMedia('blogs'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                            <!--            <?php if($index > 0): ?> <!-- Skip the first image -->
                            <!--                <div class="col-md-6">-->
                            <!--                    <img class="w-100" src="<?php echo e($image->getUrl()); ?>" alt="Other Image">-->
                            <!--                </div>-->
                            <!--            <?php endif; ?>-->
                            <!--        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                            <!--    </div>-->
                            <!--<?php endif; ?>-->
                            
                             <?php if($blogs->getMedia('blogs')->count() > 1): ?>
                                <h4 class="text-uppercase mb-20">Other Images</h4>
                                <div class="ctm-carousel-img owl-carousel owl-theme">
                                    <?php $__currentLoopData = $blogs->getMedia('blogs'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item">
                                            <img src="<?php echo e($image->getUrl()); ?>" alt="Slide <?php echo e($index); ?>"  style="width: 375px; height: 300px;">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php else: ?>
                                <!-- Display single image when there is only one image -->
                                <img src="<?php echo e($blogs->getFirstMedia('blogs')->getUrl()); ?>" alt="Single Image" width="100%">
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
                        <!-- <div class="widget  ">-->
                        <!--    <div class="widget-banner">-->
                        <!--        <h4 class="title" data-bg-src="<?php echo e(url('frontend')); ?>/assets/img/bg/widget_banner.jpg">Best Downloadables <br> <span class="text-transparent">Services</span></h4>-->
                        <!--        <div class="content">-->
                        <!--            -->
                        <!--            <button type="button" class="th-btn" data-bs-toggle="modal" data-bs-target="#inquireModal"><span class="line left"></span> INQUIRE NOW <span class="line"></span></button>-->
                                    <!--<button class="th-btn" data-toggle="modal" data-target="#inquireModal"><span class="line left"></span> INQUIRE NOW <span class="line"></span></button>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </aside>
                </div>
            </div>
    <div class="shape-mockup jump" data-top="0" data-right="0"><img src="<?php echo e(url('frontend')); ?>/assets/img/shape/shape_3.png" alt="shape"></div>

        </div>
    </section><!--==============================
Footer Area
==============================-->
<!--owl carousel script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
  $('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 3
      },
      1000: {
        items: 2
      }
    }
  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/frontend/blog_details.blade.php ENDPATH**/ ?>