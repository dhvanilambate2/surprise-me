<?php $__env->startSection('content'); ?>

<!--==============================
    Breadcumb
============================== -->
    <div class="">
        <div class="breadcumb-wrapper mt-4" data-bg-src="<?php echo e(url('frontend')); ?>/assets/img/bg/team-detail.jpeg">
            <h1 class="breadcumb-title">Expert Details</h1>
            <ul class="breadcumb-menu d-none">
                <li><a href="index.html">Home</a></li>
                <li>Expert Details</li>
            </ul>
        </div>
    </div>
    <!--==============================
Team Area  
==============================-->
    <section class="space">
        <div class="container">
            <div class="row mb-40 align-items-center">
                <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="team-details-img">
                        <img class="w-100" src="<?php echo e($team->getFirstMediaUrl('teams')); ?>" alt="team image">
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-about">
                        <h2 class="h3 team-about_title"><?php echo e($team->name); ?> <span class="team-about_desig"><?php echo e($team->post); ?></span></h2>
                        <div class="social-box">
                            <p class="title">Social Network:</p>
                            <div class="th-social">
                        <?php if($team->facebook): ?>
                            <a target="_blank" href="<?php echo e($team->facebook); ?>"><i class="fab fa-facebook-f"></i></a>
                        <?php endif; ?>
                        <?php if($team->skype): ?>
                            <a target="_blank" href="<?php echo e($team->skype); ?>"><i class="fab fa-skype"></i></a>
                        <?php endif; ?>
                        <?php if($team->twitter): ?>
                            <a target="_blank" href="<?php echo e($team->twitter); ?>"><i class="fab fa-twitter"></i></a>
                        <?php endif; ?>
                            </div>
                        </div>
                        <p class="mb-25"><?php echo $team->description; ?></p>
                        
                        <a href="<?php echo e(url('contact')); ?>" class="th-btn"><span class="line left"></span> Quick Contact <span class="line"></span></a>
                    </div>
                </div>
            </div>
            
    <div class="shape-mockup jump" data-top="0" data-right="0"><img src="<?php echo e(url('frontend')); ?>/assets/img/shape/shape_3.png" alt="shape"></div>

        </div>
    </section><!--==============================
Testimonial Area  
==============================-->
    
<!--============================== 
Footer Area
==============================-->   

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u492634275/domains/gaiahomesfl.com/public_html/stage/resources/views/frontend/team-details.blade.php ENDPATH**/ ?>